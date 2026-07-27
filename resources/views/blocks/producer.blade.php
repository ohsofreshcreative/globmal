<!--- producer -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-producer relative -smt flex flex-col' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="c-main">
		<div class="__wrapper  relative">
			<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
				@if (!empty($g_producer['image']))
				<div data-gsap-element="img" class="__img h-full order1 h-auto md:min-h-140">
					<img class="radius h-full w-full object-cover" src="{{ $g_producer['image']['url'] }}" alt="{{ $g_producer['image']['alt'] ?? '' }}">
				</div>
				@endif 
				<div class="__producer order2">
						@if (!empty($g_producer['logo']))
				<div data-gsap-element="img" class="__img w-42 border border-primary px-6 py-4 rounded-[6px] mb-6 ">
					<img class="radius h-full w-full object-cover" src="{{ $g_producer['logo']['url'] }}" alt="{{ $g_producer['logo']['alt'] ?? '' }}">
				</div>
				@endif
					<h2 data-gsap-element="header" class="text-brand text-h3 m-header">{{ $g_producer['header'] }}</h2>
					<div data-gsap-element="txt" class="__txt mb-8 text-brand">
						{!! $g_producer['text'] !!}
					</div>
					<div class="inline-buttons m-btn">
						@if (!empty($g_producer['button']))
						<x-button
							:href="$g_producer['button']['url']"
							variant="primary"
							class=""
							data-gsap-element="btn">
							{{ $g_producer['button']['title'] }}
						</x-button>
						@endif
						
					</div>


				</div>
			</div>
		</div>
	</div>
	
</section>