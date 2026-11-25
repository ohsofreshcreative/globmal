/**
 * Szklany efekt (WebGL) dla górnego menu — na bazie glass-webgl.js z projektu ogwent.
 *
 * Canvas `.masthead__glass` leży pod treścią nagłówka. Shader:
 *  - nad hero z wideo (element z [data-glass-source]) załamuje i rozmywa obraz wideo,
 *    z tym samym gradientem co nakładka w hero — szkło "widzi" to, co pod nim,
 *  - poza hero (albo gdy brak źródła) rysuje tylko połysk i jasny rant szkła,
 *    a matowienie robi CSS (backdrop-filter na .masthead).
 *
 * Bez WebGL canvas zostaje pusty — menu wygląda jak dotąd.
 */

function init(canvas) {
	const gl = canvas.getContext('webgl', { alpha: true, premultipliedAlpha: false, antialias: false });
	if (!gl) return;

	const header = canvas.closest('.masthead') || canvas.parentElement;
	const source = document.querySelector('[data-glass-source]');
	const isVideo = source instanceof HTMLVideoElement;

	const program = createProgram(gl, VERTEX, FRAGMENT);
	if (!program) return;
	gl.useProgram(program);

	const buffer = gl.createBuffer();
	gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
	gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, -1, 1, 1, -1, 1, 1]), gl.STATIC_DRAW);
	const pos = gl.getAttribLocation(program, 'position');
	gl.enableVertexAttribArray(pos);
	gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);

	const u = {};
	['uTex', 'uHasTex', 'uCanvasPos', 'uCanvasSize', 'uSrcRect', 'uSrcSize', 'uRadius'].forEach((name) => {
		u[name] = gl.getUniformLocation(program, name);
	});

	const texture = gl.createTexture();
	gl.bindTexture(gl.TEXTURE_2D, texture);
	gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
	gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
	gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
	gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
	gl.uniform1i(u.uTex, 0);

	let hasTexture = false;
	let lastKey = '';

	const sourceReady = () => {
		if (!source) return false;
		if (isVideo) return source.readyState >= 2 && source.videoWidth > 0;
		return source.complete && source.naturalWidth > 0;
	};

	const sourceSize = () => (isVideo
		? [source.videoWidth, source.videoHeight]
		: [source.naturalWidth, source.naturalHeight]);

	function frame() {
		requestAnimationFrame(frame);

		// Canvas ukryty (mobile) albo karta w tle — nic nie liczymy.
		if (document.hidden || canvas.offsetParent === null) return;

		const rect = canvas.getBoundingClientRect();
		if (rect.width < 1 || rect.height < 1) return;

		const dpr = Math.min(window.devicePixelRatio || 1, 2);
		const w = Math.round(rect.width * dpr);
		const h = Math.round(rect.height * dpr);

		const src = source && sourceReady() ? source.getBoundingClientRect() : null;
		const overSource = !!src
			&& rect.bottom > src.top && rect.top < src.bottom
			&& rect.right > src.left && rect.left < src.right;

		// Rysujemy ponownie tylko gdy coś się zmieniło (pozycja, rozmiar, klatka wideo).
		const key = [w, h, rect.left, rect.top, overSource ? src.top : '-', overSource && isVideo ? source.currentTime : ''].join('|');
		if (key === lastKey) return;
		lastKey = key;

		if (canvas.width !== w || canvas.height !== h) {
			canvas.width = w;
			canvas.height = h;
		}

		gl.viewport(0, 0, w, h);
		gl.clearColor(0, 0, 0, 0);
		gl.clear(gl.COLOR_BUFFER_BIT);

		if (overSource) {
			gl.bindTexture(gl.TEXTURE_2D, texture);
			if (isVideo || !hasTexture) {
				gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, source);
				hasTexture = true;
			}
			const [sw, sh] = sourceSize();
			gl.uniform4f(u.uSrcRect, src.left, src.top, src.width, src.height);
			gl.uniform2f(u.uSrcSize, sw, sh);
		}

		const radius = parseFloat(getComputedStyle(header).borderTopLeftRadius) || 0;

		gl.uniform1f(u.uHasTex, overSource && hasTexture ? 1 : 0);
		gl.uniform2f(u.uCanvasPos, rect.left, rect.top);
		gl.uniform2f(u.uCanvasSize, rect.width, rect.height);
		gl.uniform1f(u.uRadius, Math.min(radius, rect.height / 2));

		gl.drawArrays(gl.TRIANGLES, 0, 6);
	}

	requestAnimationFrame(frame);
}

const VERTEX = `
	attribute vec2 position;
	varying vec2 vUv;
	void main() {
		vUv = position * 0.5 + 0.5;
		gl_Position = vec4(position, 0.0, 1.0);
	}
`;

const FRAGMENT = `
	precision mediump float;

	uniform sampler2D uTex;
	uniform float uHasTex;
	uniform vec2 uCanvasPos;   // pozycja canvasa w viewporcie (px CSS)
	uniform vec2 uCanvasSize;  // rozmiar canvasa (px CSS)
	uniform vec4 uSrcRect;     // prostokąt źródła (wideo hero) w viewporcie: x, y, w, h
	uniform vec2 uSrcSize;     // naturalny rozmiar wideo / obrazka
	uniform float uRadius;     // promień zaokrąglenia nagłówka (px)

	varying vec2 vUv;

	// Odległość od krawędzi zaokrąglonego prostokąta (ujemna w środku).
	float roundedBox(vec2 p, vec2 halfSize, float r) {
		vec2 q = abs(p) - halfSize + r;
		return length(max(q, 0.0)) + min(max(q.x, q.y), 0.0) - r;
	}

	// Piksel ekranu -> UV tekstury, z uwzględnieniem object-fit: cover.
	vec2 toSourceUv(vec2 screen) {
		vec2 local = (screen - uSrcRect.xy) / uSrcRect.zw;
		float rectA = uSrcRect.z / uSrcRect.w;
		float texA = uSrcSize.x / uSrcSize.y;
		vec2 scale = rectA > texA ? vec2(1.0, texA / rectA) : vec2(rectA / texA, 1.0);
		return (local - 0.5) * scale + 0.5;
	}

	void main() {
		// Piksel w układzie ekranu (oś Y w dół, jak w DOM).
		vec2 uvDom = vec2(vUv.x, 1.0 - vUv.y);
		vec2 p = (uvDom - 0.5) * uCanvasSize;
		vec2 hs = uCanvasSize * 0.5;

		float d = roundedBox(p, hs, uRadius);
		float inside = clamp(0.5 - d, 0.0, 1.0);          // antyaliasing krawędzi
		float bevel = 1.0 - clamp(-d / 24.0, 0.0, 1.0);    // 1 przy krawędzi, 0 głębiej niż 24px

		// Kierunek "na zewnątrz" — do załamania przy rancie.
		vec2 q = abs(p) - hs + uRadius;
		vec2 outward = (q.x > 0.0 && q.y > 0.0)
			? normalize(q) * sign(p)
			: (q.x > q.y ? vec2(sign(p.x), 0.0) : vec2(0.0, sign(p.y)));

		vec3 glass = vec3(0.0);
		float glassAlpha = 0.0;

		if (uHasTex > 0.5) {
			vec2 screen = uCanvasPos + uvDom * uCanvasSize;
			// Soczewka: lekkie powiększenie + mocniejsze załamanie przy rancie.
			screen = uCanvasPos + hs + (screen - uCanvasPos - hs) * 0.96;
			screen -= outward * bevel * bevel * 36.0;

			// Matowienie: 9 próbek w promieniu ~5px.
			vec2 px = 5.0 / uSrcRect.zw;
			vec2 tuv = toSourceUv(screen);
			vec3 bg = vec3(0.0);
			for (int x = -1; x <= 1; x++) {
				for (int y = -1; y <= 1; y++) {
					bg += texture2D(uTex, tuv + vec2(float(x), float(y)) * px).rgb;
				}
			}
			bg /= 9.0;

			// Ta sama nakładka co w hero: gradient #003354 -> #0065A7, 60%.
			float gx = clamp((screen.x - uSrcRect.x) / uSrcRect.z, 0.0, 1.0);
			vec3 heroTint = mix(vec3(0.0, 0.2, 0.329), vec3(0.0, 0.396, 0.655), gx);
			bg = mix(bg, heroTint, 0.6);

			// Mroźna, chłodna poświata szkła.
			glass = mix(bg, vec3(0.93, 0.96, 1.0), 0.10);

			// Poza obszarem wideo — szkło znika i zostaje CSS.
			vec2 local = (screen - uSrcRect.xy) / uSrcRect.zw;
			float inSrc = step(0.0, local.x) * step(local.x, 1.0) * step(0.0, local.y) * step(local.y, 1.0);
			glassAlpha = 0.55 * inSrc;
		}

		// Połysk w lewym górnym rogu, jasny rant i cienka linia światła u góry.
		float highlight = smoothstep(0.9, 0.0, length((uvDom - vec2(0.18, 0.0)) * vec2(1.0, 3.0))) * 0.16;
		float rim = pow(bevel, 3.0) * 0.38;
		float topLine = smoothstep(4.0, 0.0, p.y + hs.y) * 0.18;
		float shine = clamp(highlight + rim + topLine, 0.0, 1.0);

		// Połysk (biały) nakładany na szkło.
		float a = shine + glassAlpha * (1.0 - shine);
		vec3 rgb = a > 0.0 ? (vec3(1.0) * shine + glass * glassAlpha * (1.0 - shine)) / a : vec3(0.0);

		gl_FragColor = vec4(rgb, a * inside);
	}
`;

function createProgram(gl, vs, fs) {
	const program = gl.createProgram();
	const v = createShader(gl, gl.VERTEX_SHADER, vs);
	const f = createShader(gl, gl.FRAGMENT_SHADER, fs);
	if (!v || !f) return null;
	gl.attachShader(program, v);
	gl.attachShader(program, f);
	gl.linkProgram(program);
	if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
		console.warn('header-glass: link error', gl.getProgramInfoLog(program));
		return null;
	}
	return program;
}

function createShader(gl, type, source) {
	const shader = gl.createShader(type);
	gl.shaderSource(shader, source);
	gl.compileShader(shader);
	if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
		console.warn('header-glass: shader error', gl.getShaderInfoLog(shader));
		return null;
	}
	return shader;
}

// Start na końcu pliku — VERTEX/FRAGMENT (const) muszą być już zainicjalizowane.
const canvas = document.querySelector('.masthead__glass');
if (canvas) init(canvas);
