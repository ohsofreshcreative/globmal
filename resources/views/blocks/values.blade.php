<!--- values -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-values relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
		<div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(181deg, #0065A7 -105.34%, #002238 98.92%) "></div>
<div class="c-main relative z-20 text-center">
	@if (!empty($g_values['title']))
		<div data-gsap-element="txt" class="text-light-100 m-title">{!! $g_values['title'] !!}</div>
	@endif
		@if (!empty($g_values['header']))
		<h2 data-gsap-element="header" class="text-h3 text-white mb-8 md:mb-14">{{ $g_values['header'] }}</h2>
		@endif
	
	<div class="__wrapper  relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_values['image']))
			<div data-gsap-element="img" class="__img  order1 ">
				<img class="w-full" src="{{ $g_values['image']['url'] }}" alt="{{ $g_values['image']['alt'] ?? '' }}">
			</div>
			@endif
			<div class="__values order2 text-white">
					<!-- repeater  -->
				@if (!empty($r_values))
				<div class="grid grid-cols-1 md:gap-8 gap-4">
					@foreach ($r_values as $item)
					<div data-gsap-element="card" class="__card relative border-b border-white text-left pb-8">
						
						@if (!empty($item['title']))
						<p class="text-h6 m-title">{{ $item['title'] }}</p>
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
			</div>
		</div>
	</div>
</section>
