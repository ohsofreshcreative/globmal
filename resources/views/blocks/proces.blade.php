<!--- proces --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-proces relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		<div class="">
			<div class="__top">
				@if (!empty($g_proces['header']))
				<h3 data-gsap-element="header" class=" m-header text-h5 text-center">{{ strip_tags($g_proces['header']) }}</h3>
				@endif
				@if (!empty($g_proces['txt']))
				<div data-gsap-element="txt">{{ strip_tags($g_proces['txt']) }}</div>
				@endif
			</div>
		</div>

		@if (!empty($r_proces))
		<ol class="__repeater mt-16" style="--process-count: {{ count($r_proces) }}">

			@foreach ($r_proces as $item)
			<li data-gsap-element="stagger" class="__step">
				@if (!empty($item['image']['url']))
				<img class="__image w-14 h-14" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" loading="lazy" />
				@endif
				<p class="__title text-h7">{{ $item['title'] ?? '' }}</p>
				@if (!$loop->last)
				<svg class="__arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
					<path d="M4 12h16m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				@endif
			</li>
			@endforeach
		</ol>
		@endif
	</div>

</section>
