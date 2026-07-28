<!--- overlap --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-overlap relative -spt -smt -spb bg-blue-light ',
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main relative z-10">
		<div class="__content order2">
			<div class="__txt w-full md:w-1/2 mx-auto">
				<h2 data-gsap-element="header" class="text-center m-header text-white">{{ $g_overlap['header'] }}</h2>
				<div data-gsap-element="header" class="text-center">
					{!! $g_overlap['text'] !!}
				</div>
			</div>
			<div class="grid grid-cols-1 gap-8 mt-14">
				@foreach ($r_overlap as $item)
				<div class="gsap__cards __cards sticky top-20 mt-4">
					<div data-gsap-element="card" class="gsap__card __card p-8 radius" style="background-image:url({{ $item['image']['url'] }}); background-size: cover; background-position: center;">
					           <div class="absolute inset-0 z-10 radius" style="background: linear-gradient(90deg,rgba(0, 51, 84, 0.60) 0.01%, rgba(0, 101, 167, 0.60) 99.99%);"></div>
						<div class="__box relative z-12 text-white w-full  md:mt-80 mt-20 mb-8 md:mb-20 mx-8 md:mx-20 flex flex-col justify-between h-full">
						@if (!empty($item['number']))
							<p class="text-h4 font-semibold">{{ $item['number'] }}</p>
							@endif
							<div>
							<p class="text-h5 ">{{ $item['header'] }}</p>
							<div class="text-lg">{!! $item['text'] !!}</div>
						</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>