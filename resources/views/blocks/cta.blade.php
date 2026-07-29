<!--- cta -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-cta relative -smt pb-12 -spt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(181deg, #0065A7 -105%, #002238 98%) "></div>
	<div class="__wrapper c-main relative overflow-hidden c-main radius py-8 mx-4">
		<div class="absolute inset-0 z-10 radius" style="background: linear-gradient(90deg,rgba(0, 51, 84, 0.60) 0.01%, rgba(0, 101, 167, 0.60) 99.99%);"></div>
		@if (!empty($g_octa['image']))
		<x-picture
			:image="$g_octa['image']"
			figure-class="absolute inset-0 m-0 z-0"
			class="w-full h-full object-cover" />
		@endif
	<div class="absolute inset-0 z-10 bg-[#0065A7]/70 pointer-events-none"></div>
		<div class="__inside  grid grid-cols-1 md:grid-cols-2 items-center gap-6 relative z-20">
			<div class="__content w-full ">
				@if (!empty($g_octa['header']))
				<p data-gsap-element="header" class=" text-h3 text-white">{{ $g_octa['header'] }}</p>
				@endif
				@if (!empty($g_octa['txt']))
				<div data-gsap-element="txt" class="text-white my-6">{!! $g_octa['txt'] !!}</div>
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
			@if ($form)
			<div data-gsap-element="form" class="bg-white radius p-6 md:p-10 mt-6 md:mt-0">
				<h4 class="text-brand mb-4">{!! $g_octa['title'] !!}</h4>
				{!! do_shortcode($g_octa['shortcode']) !!}
			</div>
			@endif
		</div>
	</div>
</section>