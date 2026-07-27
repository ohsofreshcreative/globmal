@extends('layouts.app')

@section('content')

@php
$term = get_queried_object();
$categories = get_categories();

$category_header = get_field('category_header', $term);
$category_description = get_field('category_description', $term);
$category_image = get_field('category_image', $term);

$g_octa = get_field('g_octa', 'option');


// Wygenerowanie unikalnego ID dla SVG
$unique_id = 'clip_'.uniqid();
@endphp

<div class="hero overflow-hidden category-header relative bg-blue-light">
	<div class="absolute -left-66 -top-26 w-[474px] h-[492px] rounded-full bg-primary opacity-70 blur-[111px]"></div>

	<div class="__wrapper c-main relative z-10 pt-60 pb-26">
		<div data-gsap-element="bread" class="__breadcrumb pb-14">
		@if (function_exists('yoast_breadcrumb'))
		{!! yoast_breadcrumb('<p id="breadcrumbs">','</p>') !!}
		@endif
	</div>
		<div class="__content w-full md:w-2/3">
	
			<h2 class="text-white">
				{!! $category_header ?: 'Centrum wiedzy' !!}
			</h2>
		</div>
	</div>
	<img class="absolute pointer-events-none w-240 h-auto z-20 top-0 -right-50" src="/wp-content/uploads/2026/07/shape.svg" />
</div>
<section class="-spt">
<div class="c-main ">
	<div id="category-tabs" class="category-tabs z-20 relative radius">
		<!-- Swiper -->
		<div id="category-tabs" class="category-tabs z-20 relative radius">
			<!-- Swiper -->
			<div class="swiper category-swiper lg:flex lg:justify-center">
				<div class="swiper-wrapper lg:w-fit gap-3">
					<!-- Slides -->
					<div class="swiper-slide !w-auto">
						<a href="/category/aktualnosci-blog" class="__tab block bg-white w-[210px] justify-center flex radius py-4  text-lg {{ is_category('aktualnosci-blog') ? 'active' : '' }}">Wszystkie</a>
					</div>
					@foreach($categories as $category)
					@if($category->name !== 'Aktualności / Blog')
					<div class="swiper-slide !w-auto">
						<a href="{{ get_category_link($category->term_id) }}" class="__tab block bg-white radius w-[210px] justify-center flex py-4 text-lg {{ $term && $term->term_id === $category->term_id ? 'active' : 'bg-primary' }}">{{ $category->name }}</a>
					</div>
					@endif
					@endforeach
				</div>
			</div>

		</div>
	</div>
</div>

@if (have_posts())
<div class="__posts  c-main !mt-10 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
	@while (have_posts()) @php(the_post())

	@includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
	@endwhile
</div>

{{-- {!! get_the_posts_navigation() !!} --}}
{!! the_posts_pagination() !!}
@else
<div class="mt-20 mb-20">
	<div class="c-main">
		<h3 class="">Brak wpisów w tej kategorii.</h3>
		<a class="main-btn m-btn" href="/wszystkie-wpisy/">Sprawdź wszystkie wpisy</a>
	</div>
</div>
</section>
@endif


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
				<p data-gsap-element="header" class="_address text-white ">{{ $g_octa['address'] }}</p>
				@endif
			</div>

			<div data-gsap-element="form" class="bg-white radius p-6 md:p-10 mt-6 md:mt-0">
				<h4 class="text-brand mb-4">{!! $g_octa['title'] !!}</h4>
				{!! do_shortcode($g_octa['shortcode']) !!}
			</div>

		</div>
	</div>
</section>
@endsection