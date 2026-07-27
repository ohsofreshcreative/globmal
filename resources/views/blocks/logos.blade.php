<!--- logos --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-logos relative -spt -spb overflow-hidden bg-[#E7F1FF]' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if(!empty($g_logos['header']))
	<div class="__wrapper c-main relative text-center">
		<h2 data-gsap-element="header" class="w-full text-brand md:mb-16 mb-8">{{ $g_logos['header'] }}</h2>
	</div>
	@endif

	@if (!empty($g_logos['r_logos']))
	<div class="relative w-full overflow-hidden c-main">

				@if (!empty($g_logos['r_logos']))
		@php
		$itemCount = count($g_logos['r_logos']);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp

		<div class="grid {{ $gridClass }} gap-6 md:gap-8 mt-10">
			@foreach ($g_logos['r_logos'] as $item)
			<div data-gsap-element="card" class="__card relative p-8 items-center justify-center flex h-38 md:h-48 w-auto">
				@if (!empty($item['image']['url']))
				<img class=" h-full w-full object-contain" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				@endif
			</div>
			@endforeach
		</div>
		@endif
<div class="mt-8  text-center">
					@if (!empty($g_logos['button']))
					<x-button
						:href="$g_logos['button']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_logos['button']['title'] }}
					</x-button>
					@endif
						</div>
	</div>
	@endif
</section>