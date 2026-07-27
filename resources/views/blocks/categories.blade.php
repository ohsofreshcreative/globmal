<!--- categories --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-categories relative -smt -spb' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		<div class="__top text-center">
			<div>
				@if (!empty($g_categories['title']))
				<div data-gsap-element="txt" class="title">
					{!! $g_categories['title'] !!}
				</div>
				@endif
			
			<h2 data-gsap-element="header" class="m-header">{{ strip_tags($g_categories['header']) }}</h2>
			</div>
			
		</div>

		@if (!empty($posts))
			@php
			$itemCount = count($posts);
			$gridCols = min($itemCount, 4);
			$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
			@endphp

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 auto-rows-[350px]">
    @foreach($posts as $index => $post)
        <a
            href="{{ get_permalink($post->ID) }}"
            @class([
                '__card relative overflow-hidden radius group block',
                'lg:row-span-2' => $index === 0,
            ])
        >
            {!! get_the_post_thumbnail($post->ID, 'large', [
                'class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-102 transition-transform duration-500'
            ]) !!}

            <div class="absolute inset-0 bg-gradient-to-t from-[#002238]/90 via-[#002238]/40 to-transparent"></div>

            <div class="absolute bottom-6 left-6 right-6 z-10">
                <h3 class="text-white text-h5 mb-4">
                    {{ get_the_title($post->ID) }}
                </h3>

                <span class="btn btn-primary">
                    Sprawdź szczegóły
                </span>
            </div>
        </a>
    @endforeach
</div>
@endif

	</div>

</section>