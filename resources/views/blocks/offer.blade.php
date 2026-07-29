<!-- offer -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-offer relative' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="c-main">
		@if(!empty($posts))
		<div class="content">
			@if(!empty($subtitle))
			<div data-gsap-element="subtitle" class="text-lg text-light-100 mb-2">
				{{ $subtitle }}
			</div>
			@endif
			@if(!empty($title))
			<h2 data-gsap-element="header" class="text-white m-header">
				{{ $title }}
			</h2>
			@endif
		</div>
		@php
		$serialized_posts = array_slice($posts, 0, 3);
		@endphp

		<div 
			x-data="{ active: null }"
			class="offer-grid-container"
		>
			@foreach($serialized_posts as $post)
			@php
			$index = $loop->index;
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : null;
			$raw_excerpt = get_the_excerpt($post->ID);
			@endphp

	<a
    href="{{ get_permalink($post->ID) }}"
    @mouseenter="active = {{ $index }}"
    @mouseleave="active = null"
    class="offer-card block"
    :class="{ 'is-active': active === {{ $index }} }"
>
				<div 
					class="offer-card-image-wrap"
					:class="{ 'is-active': active === {{ $index }} }"
				>
					@if($image_url)
					<img
						src="{{ $image_url }}"
						alt="{{ get_the_title($post->ID) }}"
					>
					@endif
				</div>
				<div 
					class="offer-card-content-wrap"
					:class="{ 'is-active': active === {{ $index }} }"
				>
					<div class="flex">
						<div class="text-h3 text-blue-light shrink-0">
							{{ sprintf('%02d', $index + 1) }}
						</div>
					</div>
					<div class="mt-auto flex flex-col gap-4">
						<h3 class="text-h4 text-brand">
							{{ get_the_title($post->ID) }}
						</h3>

						@if(!empty($raw_excerpt))
						<div class="offer-excerpt-list text-brand text-lg">
							{!! $raw_excerpt !!}
						</div>
						@endif
					</div>
				</div>
			</a>
			@endforeach
		</div>

		@else

		<div class="no-posts bg-white p-6 radius text-center text-gray-400 shadow-sm">
			Brak postów do wyświetlenia.
		</div>

		@endif
	</div>

</section>