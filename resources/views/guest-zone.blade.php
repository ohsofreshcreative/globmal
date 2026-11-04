<!doctype html>
<html @php(language_attributes())>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<title>Strefa gości – {{ $siteName }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Bai+Jamjuree:wght@400;500;600;700&display=swap" rel="stylesheet">
	@vite(['resources/css/app.css'])
</head>

<body class="!bg-blue-light">
	<main class="relative min-h-screen overflow-hidden flex flex-col">
		{{-- Tło --}}
		<div class="absolute -left-60 -top-40 w-[560px] h-[560px] rounded-full bg-primary opacity-60 blur-[130px] pointer-events-none"></div>
		<div class="absolute -right-40 -bottom-60 w-[520px] h-[520px] rounded-full bg-third opacity-40 blur-[140px] pointer-events-none"></div>
		<div class="absolute inset-0 opacity-[0.06] pointer-events-none"
			style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 56px 56px; mask-image: radial-gradient(ellipse at center, #000 15%, transparent 70%);"></div>
		<img class="absolute pointer-events-none w-240 h-auto top-0 -right-50 opacity-60" src="/wp-content/uploads/2026/07/shape.svg" alt="" />

		{{-- Góra: logo + zamknij --}}
		<div class="relative z-10 flex items-center justify-between px-6 md:px-12 pt-6 md:pt-8">
			<a href="{{ home_url('/') }}" class="shrink-0">
				@if (is_array($logo) && !empty($logo['url']))
				<img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?: $siteName }}" class="h-10 md:h-12 w-auto">
				@else
				<span class="text-white text-xl font-bold">{{ $siteName }}</span>
				@endif
			</a>
			<a href="{{ home_url('/') }}" aria-label="Zamknij"
				class="flex items-center justify-center w-12 h-12 rounded-full border border-white/15 bg-white/5 text-white hover:bg-white/15 transition">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" viewBox="0 0 24 24"><path d="M5 5l14 14M19 5 5 19"/></svg>
			</a>
		</div>

		{{-- Karta logowania --}}
		<div class="relative z-10 flex-1 flex items-center justify-center px-6 py-12">
			<form method="post" action="{{ $action }}"
				class="w-full max-w-md bg-white rounded-3xl shadow-[0_30px_80px_-20px_rgba(0,0,0,0.5)] p-8 md:p-12 text-center">

				<span class="mx-auto flex items-center justify-center w-16 h-16 rounded-2xl bg-soft text-third">
					<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 1 1 8 0v3"/><circle cx="12" cy="15.5" r="1.3"/></svg>
				</span>

				<h1 class="text-h3 text-brand !mt-6 !mb-2">Strefa gości</h1>
				<p class="text-secondary-500 !mb-8">Ta strona jest chroniona. Wpisz hasło dostępu, aby zobaczyć zawartość.</p>

				<label for="gm_access_password" class="sr-only">Hasło</label>
				<div class="relative text-left">
					<span class="absolute left-4 top-1/2 -translate-y-1/2 text-secondary-300 pointer-events-none">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" viewBox="0 0 24 24"><circle cx="8" cy="15" r="4"/><path d="m10.8 12.2 8.7-8.7M16 7l3 3M14 9l2 2"/></svg>
					</span>
					<input
						type="password"
						id="gm_access_password"
						name="gm_access_password"
						placeholder="Hasło"
						autocomplete="current-password"
						required
						autofocus
						@class([
							'w-full rounded-xl border-2 bg-page pl-12 pr-4 py-4 text-base text-body outline-none transition focus:bg-white focus:border-third focus:ring-4 focus:ring-third/15',
							'border-red-400' => filled($error),
							'border-transparent' => !filled($error),
						])>
				</div>

				@if (filled($error))
				<p class="flex items-center gap-2 text-red-600 text-sm !mt-3 !mb-0 text-left" role="alert">
					<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
					{{ $error }}
				</p>
				@endif

				<button type="submit" class="btn btn-primary !w-full mt-6 !inline-flex items-center justify-center gap-2">
					Wejdź
					<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</button>

				<p class="text-xs text-secondary-400 !mt-6 !mb-0">Dostęp zostanie zapamiętany na tym urządzeniu przez 30 dni.</p>
			</form>
		</div>
	</main>
</body>

</html>
