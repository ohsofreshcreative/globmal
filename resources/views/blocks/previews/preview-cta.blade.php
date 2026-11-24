<!--- cta preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Wezwanie do działania</div>
			<span class="acf-preview__slug">acf/cta</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_octa['title'] ?? null,
			'header' => $g_octa['header'] ?? null,
			'html' => $g_octa['txt'] ?? null,
			'lines' => [$g_octa['address'] ?? null, $g_octa['phone'] ?? null, $g_octa['mail'] ?? null, !empty($form) ? 'Formularz kontaktowy' : null],
			'image' => $g_octa['image'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
