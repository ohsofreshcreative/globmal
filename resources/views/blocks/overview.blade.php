<!--- overview -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-overview relative -smt flex flex-col' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="c-main">
		<div class="__wrapper  relative">
			<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
				@if (!empty($g_overview['image']))
				<div data-gsap-element="img" class="__img h-full order1 md:max-h-120 max-h-80">
					<img class="radius h-full w-full object-cover max-h-120" src="{{ $g_overview['image']['url'] }}" alt="{{ $g_overview['image']['alt'] ?? '' }}">
				</div>
				@endif
				<div class="__overview order2">
					@if (!empty($g_overview['title']))
					<div data-gsap-element="txt" class="title">
						{!! $g_overview['title'] !!}
					</div>
					@endif
					<h2 data-gsap-element="header" class="text-brand text-h3 m-header">{{ $g_overview['header'] }}</h2>
					<div data-gsap-element="txt" class="__txt mb-8 text-brand">
						{!! $g_overview['text'] !!}
					</div>
					<div class="inline-buttons m-btn">
						@if (!empty($g_overview['button1']))
						<x-button
							:href="$g_overview['button1']['url']"
							variant="primary"
							class=""
							data-gsap-element="btn">
							{{ $g_overview['button1']['title'] }}
						</x-button>
						@endif
						@if (!empty($g_overview['button2']))
						<x-button
							:href="$g_overview['button2']['url']"
							variant="secondary"
							class=""
							data-gsap-element="btn">
							{{ $g_overview['button2']['title'] }}
						</x-button>
						@endif
					</div>


				</div>
			</div>
		</div>
	</div>
	<div class=" c-main relative w-full md:pt-20 pt-10">
		<!-- repeater  -->
		@if (!empty($r_overview))
		@php
		$itemCount = count($r_overview);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp

		<div class="grid {{ $gridClass }} md:gap-8 gap-4">
			@foreach ($r_overview as $item)
			<div data-gsap-element="card" class="__card relative  p-8 border border-primary radius text-center">

				@if (!empty($item['image']['url']))
				<img class="mb-6 mx-auto" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				@endif
				@if (!empty($item['title']))
				<p class="mb-2 text-h7 font-semibold">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p>{{ $item['text'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif
		<!-- repeater end -->
	</div>
</section>