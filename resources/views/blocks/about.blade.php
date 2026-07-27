<!--- about -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-about relative -smt flex flex-col' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
<div class="c-main">
	<div class="__wrapper  relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_about['image']))
			<div data-gsap-element="img" class="__img h-full order1 aspect-[542/633]">
				<img class="radius h-full w-full object-cover" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
			</div>
			@endif
			<div class="__about order2">
				@if (!empty($g_about['title']))
				<div data-gsap-element="txt" class="title">
					{!! $g_about['title'] !!}
				</div>
				@endif
				<h2 data-gsap-element="header" class="text-brand text-h3 m-header">{{ $g_about['header'] }}</h2>
				<div data-gsap-element="txt" class="__txt mb-8 text-brand">
					{!! $g_about['text'] !!}
				</div>
				<div class="inline-buttons m-btn">
					@if (!empty($g_about['button1']))
					<x-button
						:href="$g_about['button1']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_about['button1']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_about['button2']))
					<x-button
						:href="$g_about['button2']['url']"
						variant="secondary"
						class=""
						data-gsap-element="btn">
						{{ $g_about['button2']['title'] }}
					</x-button>
					@endif
				</div>


			</div>
			</div>
		</div>
	</div>
	<div class=" c-main relative w-full md:pt-20 pt-10">
				<!-- repeater  -->
				@if (!empty($r_about))
				@php
				$itemCount = count($r_about);
				$gridCols = 1;
				if ($itemCount == 2) $gridCols = 2;
				if ($itemCount == 3) $gridCols = 3;
				if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
				$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
				@endphp

				<div class="grid {{ $gridClass }} md:gap-8 gap-4">
					@foreach ($r_about as $item)
					<div data-gsap-element="card" class="__card relative bg-[#E7F1FF] p-8 border border-primary radius">
						
						@if (!empty($item['title']))
						<p class="text-h3">{{ $item['title'] }}</p>
						@endif
						@if (!empty($item['text']))
						<p class="text-lg">{{ $item['text'] }}</p>
						@endif
					</div>
					@endforeach
				</div>
				@endif
				<!-- repeater end -->
				</div>
</section>
