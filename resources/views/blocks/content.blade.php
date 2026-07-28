<!--- content -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-content relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
			<img class="hidden md:block absolute pointer-events-none w-180 h-auto z-0 -bottom-80 -left-40" src="/wp-content/uploads/2026/07/shape.svg" />
	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_content['image']))
			<div data-gsap-element="img" class="__img h-full order1 aspect-[542/633]">
				<img class="radius h-full w-full object-cover" src="{{ $g_content['image']['url'] }}" alt="{{ $g_content['image']['alt'] ?? '' }}">
			</div>
			@endif
			<div class="__content order2 relative z-10">
				@if (!empty($g_content['title']))
				<div data-gsap-element="txt" class="mt-4 title">
					{!! $g_content['title'] !!}
				</div>
				@endif
				<h2 data-gsap-element="header" class="text-brand text-h3 m-header">{{ $g_content['header'] }}</h2>
				<div data-gsap-element="txt" class="__txt mb-8">
					{!! $g_content['text'] !!}
				</div>
				<div class="inline-buttons m-btn">
					@if (!empty($g_content['button1']))
					<x-button
						:href="$g_content['button1']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_content['button1']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_content['button2']))
					<x-button
						:href="$g_content['button2']['url']"
						variant="secondary"
						class=""
						data-gsap-element="btn">
						{{ $g_content['button2']['title'] }}
					</x-button>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>