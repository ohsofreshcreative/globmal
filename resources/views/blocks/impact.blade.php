<!--- impact -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-impact relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-10">

			<div class="__impact order2">
				@if (!empty($g_impact['subtitle']))
				<div data-gsap-element="txt" class="mt-4 text-primary">
					{!! $g_impact['subtitle'] !!}
				</div>
				@endif
				<h2 data-gsap-element="header" class="text-brand text-h3 m-header">{{ $g_impact['header'] }}</h2>
				<div data-gsap-element="txt" class="__txt mb-8">
					{!! $g_impact['text'] !!}
				</div>

			</div>
			@if (!empty($g_impact['image']))
			<div data-gsap-element="img" class="__img h-full order1 ">
				<img class="radius h-full w-full object-cover" src="{{ $g_impact['image']['url'] }}" alt="{{ $g_impact['image']['alt'] ?? '' }}">
			</div>
			@endif
		</div>
	</div>
</section>