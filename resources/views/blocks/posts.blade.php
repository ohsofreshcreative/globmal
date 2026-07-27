@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<div data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-posts  -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main ">
		<div class="__content mb-14 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
    <h2 data-gsap-element="title" class="header">
        {{ $posts_settings['title'] }}
    </h2>

    @if (!empty($posts_settings['button']))
        <a
            data-gsap-element="btn"
            href="{{ $posts_settings['button']['url'] }}"
            class="inline-flex items-center justify-center px-10 py-4 border border-secondary text-secondary hover:bg-secondary hover:!text-white transition-all duration-300 shrink-0 radius"
        >
            {{ $posts_settings['button']['title'] }}
        </a>
    @endif
</div>
<div data-gsap-element="grid-layout" class="__posts-grid relative w-full">
    @if(!empty($posts)) 
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <a
                    href="{{ get_permalink($post->ID) }}"
                    class="group relative flex flex-col bg-blue-50 p-6 rounded-xs "
                >
                    @if($show_image && has_post_thumbnail($post->ID))
                        <div class="w-auto overflow-hidden ">
                            <img
                                src="{{ get_the_post_thumbnail_url($post->ID, 'large') }}"
                                alt="{{ get_the_title($post->ID) }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-103 rounded-xs"
                            />
                        </div>
                    @endif

                    <h6 class="mt-4">
                        {{ get_the_title($post->ID) }}
                    </h6>
				<p class="mt-4 text-primary items-center gap-2 flex">Przeczytaj artykuł 
				<span>
				<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
  <path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24944 1.27664 6.61036 1.65367L9.84486 5.03226H0.921985C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774H9.84482L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96656 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#57606C"/>
</svg>
</span>
				</p>
                </a>
            @endforeach
        </div>
    @else
        <div class="no-posts bg-white p-6 rounded-xs text-center text-gray-400 shadow-sm">
            Brak postów do wyświetlenia.
        </div>
    @endif
</div>
	</div>
</div>