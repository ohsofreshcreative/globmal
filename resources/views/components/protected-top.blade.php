@props([
'label' => null,
'meta' => [],
])

@php
$icons = [
'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/>',
'truck' => '<path d="M1 4h14v12H1zM15 9h4l4 4v3h-8V9Z"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/>',
'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
'refresh' => '<path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/>',
];
@endphp

{{-- Nagłówek stron chronionych (zamówienia / dashboard) --}}
<section class="b-protected-top relative overflow-hidden bg-blue-light pt-32 md:pt-40 pb-28 md:pb-36">
	<div class="absolute -left-60 -top-40 w-[520px] h-[520px] rounded-full bg-primary opacity-60 blur-[120px] pointer-events-none"></div>
	<div class="absolute -right-40 bottom-[-220px] w-[480px] h-[480px] rounded-full bg-third opacity-40 blur-[140px] pointer-events-none"></div>
	<div class="absolute inset-0 opacity-[0.06] pointer-events-none"
		style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 56px 56px; mask-image: radial-gradient(ellipse at 30% 40%, #000 20%, transparent 75%);"></div>
	<img class="absolute pointer-events-none w-240 h-auto top-0 -right-50 opacity-70" src="/wp-content/uploads/2026/07/shape.svg" alt="" />

	<div class="c-main relative z-10">
		@if (filled($label))
		<span class="inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/5 backdrop-blur px-4 py-2 text-xs md:text-sm font-semibold uppercase tracking-[0.18em] text-primary-100">
			<span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_0_4px_rgba(52,211,153,0.2)]"></span>
			{{ $label }}
		</span>
		@endif

		<h1 class="text-white text-h1 !mt-6 !mb-0">{!! get_the_title() !!}</h1>

		@if (!empty($meta))
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-10 md:mt-12 max-w-5xl">
			@foreach ($meta as $item)
			<div class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/[0.06] backdrop-blur-md p-5">
				<span class="flex items-center justify-center w-11 h-11 rounded-xl bg-white/10 text-white shrink-0">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">{!! $icons[$item['icon'] ?? 'calendar'] ?? $icons['calendar'] !!}</svg>
				</span>
				<div class="min-w-0">
					<span class="block text-xs font-semibold uppercase tracking-wider text-primary-100/80">{{ $item['label'] }}</span>
					<span class="block mt-1 text-white font-semibold text-lg leading-snug">{{ $item['value'] }}</span>
				</div>
			</div>
			@endforeach
		</div>
		@endif

		{{ $slot }}
	</div>
</section>
