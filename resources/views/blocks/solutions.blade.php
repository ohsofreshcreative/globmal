<!--- solutions --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-solutions relative -smt -spb' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main">
		<div class="__top text-center">
			<div>
				@if (!empty($g_solutions['title']))
				<div data-gsap-element="txt" class="title">
					{!! $g_solutions['title'] !!}
				</div>
				@endif

				<h2 data-gsap-element="header" class="m-header">{{ strip_tags($g_solutions['header']) }}</h2>
			</div>

		</div>
		@if (!empty($posts))
		@php
		$itemCount = count($posts);
		$gridCols = min($itemCount, 4);
		$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
		@endphp
		<div class="grid {{ $gridClass }} gap-8 mt-10">
			@foreach($posts as $post)
			<a href="{{ get_permalink($post->ID) }}" class="__card relative overflow-hidden radius group block md:h-130 h-90">
				{!! get_the_post_thumbnail($post->ID, 'large', [
				'class' => 'w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500 h-full w-auto'
				]) !!}

				<div class="absolute inset-0 bg-gradient-to-t from-[#002238]/90 via-[#002238]/40 to-transparent z-10"></div>

				<div class="absolute inset-x-0 bottom-0 p-6 z-20">
					<h3 class="text-white text-h5 font-bold">
						{{ get_the_title($post->ID) }}
					</h3>
				</div>
			</a>
			@endforeach
		</div>
		@endif
		@if (!empty($g_solutions['button']['url']))
		<div class="__btn mt-10 mx-auto text-center">
			<a href="{{ $g_solutions['button']['url'] }}" class="btn btn-primary" target="{{ $g_solutions['button']['target'] ?? '_self' }}">
				{{ $g_solutions['button']['title'] }}
			</a>
		</div>
		@endif
	</div>
</section>