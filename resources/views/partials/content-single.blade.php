@php
$categories = get_the_category();
$category = !empty($categories) ? $categories[0] : null;
$g_octa = get_field('g_octa', 'option');
@endphp

<section data-gsap-anim="section" class="hero-blog relative bg-blue-light overflow-hidden">
	<div class="absolute -left-66 -top-26 w-[474px] h-[492px] rounded-full bg-primary opacity-70 blur-[111px]"></div>
	<div class="__wrapper c-main relative z-10 -spt">
		<div class="__content w-full mx-auto pb-30">
			<div class="__top mt-16 text-center">
				<div data-gsap-element="bread" class="__breadcrumb flex justify-center mb-12">
					@if (function_exists('yoast_breadcrumb'))
					{!! yoast_breadcrumb('<p id="breadcrumbs">','</p>') !!}
					@endif
				</div>
				<h1 data-gsap-element="header" class="text-h2 text-white m-header">{{ get_the_title() }}</h1>
				@if ($category)
				<a data-gsap-element="header" href="{{ get_category_link($category->term_id) }}" class="bg-[#2052D0] rounded-xs !text-white text-lg px-4 py-3">{{ $category->name }}</a>
				@endif
			</div>
		</div>
	</div>
	<img class="absolute pointer-events-none w-240 h-auto z-20 top-0 -right-50" src="/wp-content/uploads/2026/07/shape.svg" />
</section>

<section data-gsap-anim="section">
	<div id="tresc" class="__entry relative z-10 -smt">
		<div class="c-small">

			@if(has_post_thumbnail())
			<div data-gsap-element="image" class="w-full img-2xl rounded-xl overflow-hidden mb-8">
				{!! get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full object-cover']) !!}
			</div>
			@endif

			<div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 text-[#002238]">
				<div class="flex items-center gap-3">
					<div class="shrink-0">
						{!! get_avatar(get_the_author_meta('ID'), 48, '', get_the_author(), ['class' => 'rounded-full w-8 h-8 md:w-12 md:h-12']) !!}
					</div>
					<div class="font-semibold">
						{{ get_the_author() }}
					</div>
				</div>
				<div class="hidden md:block w-2 h-2 shrink-0">
					<img src="/wp-content/uploads/2026/07/vector.svg" alt="" />
				</div>
				<div class="flex items-center gap-2 text-sm md:text-base">
					<div>
						Opublikowano {{ get_the_date('d.m.Y') }}
					</div>
					@php
					$readingTime = get_field('reading_time');
					@endphp
					@if($readingTime && !empty($readingTime['time']))
					<div class="w-2 h-2 shrink-0">
						<img src="/wp-content/uploads/2026/07/vector.svg" alt="" />
					</div>
					<div>
						{{ $readingTime['time'] }}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@php
$content = apply_filters('the_content', get_the_content());
@endphp

<div class="__content c-small __entry md:pt-18 pt-10">
	<div id="tresc" class="__entry">
		{!! $content !!}
	</div>
</div>
@php
$current_id = get_the_ID();
$categories = wp_get_post_categories($current_id);
$related_args = [
'category__in' => $categories,
'post__not_in' => [$current_id],
'posts_per_page' => 3,
'ignore_sticky_posts' => 1,
];
$related_query = new WP_Query($related_args);
@endphp

<!--- cta -->
<section
	data-gsap-anim="section"
	class="b-cta relative  -spt -smt">
	<div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(181deg, #0065A7 -105.34%, #002238 98.92%) "></div>
	<div class="__wrapper relative overflow-hidden c-main radius py-12 md:py-24">
		<div class="absolute inset-0 z-10 radius" style="background: linear-gradient(90deg,rgba(0, 51, 84, 0.60) 0.01%, rgba(0, 101, 167, 0.60) 99.99%);"></div>
		@if (!empty($g_octa['image']))
		<x-picture
			:image="$g_octa['image']"
			figure-class="absolute inset-0 m-0 z-0"
			class="w-full h-full object-cover" />
		@endif
		<div class="absolute inset-0 z-1 pointer-events-none" style="background: linear-gradient(90deg, rgba(40, 101, 162, 0.80) 0%, rgba(40, 101, 162, 0.80) 100%);"></div>
		<div class="__inside  grid grid-cols-1 md:grid-cols-2 items-center gap-6 relative z-20">
			<div class="__content w-full ">
				@if (!empty($g_octa['header']))
				<p data-gsap-element="header" class=" text-h3 text-white m-header">{{ $g_octa['header'] }}</p>
				@endif
				@if (!empty($g_octa['txt']))
				<div data-gsap-element="txt" class="text-white mb-4">{!! $g_octa['txt'] !!}</div>
				@endif
				@if (!empty($g_octa['phone']))
				<p data-gsap-element="header" class="_phone text-white mb-4">{{ $g_octa['phone'] }}</p>
				@endif
				@if (!empty($g_octa['mail']))
				<p data-gsap-element="header" class="_mail text-white mb-4">{{ $g_octa['mail'] }}</p>
				@endif
				@if (!empty($g_octa['address']))
				<p data-gsap-element="header" class="_address text-white">{{ $g_octa['address'] }}</p>
				@endif
			</div>

			<div data-gsap-element="form" class="bg-white radius p-6 md:p-10 mt-6 md:mt-0">
				<h4 class="text-brand mb-4">{!! $g_octa['title'] !!}</h4>
				{!! do_shortcode($g_octa['shortcode']) !!}
			</div>

		</div>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const headings = document.querySelectorAll('h1[id], h2[id], h3[id], h4[id]'); // Select all headings with IDs
		const tocLinks = document.querySelectorAll('.toc ul li a'); // Select all links in the TOC

		function updateActiveLink() {
			headings.forEach((heading) => {
				const headingTop = heading.getBoundingClientRect().top;
				const windowHeight = window.innerHeight;

				if (headingTop < windowHeight - 300) {
					// Remove the 'active' class from all TOC links
					tocLinks.forEach((link) => {
						link.parentNode.classList.remove('active');
					});

					// Add the 'active' class to the corresponding TOC link
					const id = heading.id;
					const activeLink = document.querySelector(`.toc ul li a[href="#${id}"]`);
					if (activeLink) {
						activeLink.parentNode.classList.add('active');
					}
				}
			});
		}
		updateActiveLink();

		window.addEventListener('scroll', updateActiveLink);
	});
</script>