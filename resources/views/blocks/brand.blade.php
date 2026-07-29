<!--- brand -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-brand relative -smt flex flex-col overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative w-full">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-12 lg:gap-20">
			<div class="flex flex-col gap-6 order1 w-full relative z-10">
				@if (!empty($g_brand['image']))
				<div data-gsap-element="img" class="__logo-card radius p-8 md:p-12 flex items-center justify-center w-full aspect-[2/1]">
					<img class="max-h-full max-w-full object-contain " src="{{ $g_brand['image']['url'] }}" alt="{{ $g_brand['image']['alt'] ?? '' }}">
				</div>
				@endif

				@if (!empty($g_brand['r_stats']))
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
					@foreach ($g_brand['r_stats'] as $stat)
					<div data-gsap-element="card" class="__stat-card  radius p-6  flex flex-col justify-center min-h-[120px]">
						@if (!empty($stat['title']))
						<div class="text-h4  mb-1">
							{{ $stat['title'] }}
						</div>
						@endif
						@if (!empty($stat['text']))
						<div class=" ">
							{!! nl2br(e($stat['text'])) !!}
						</div>
						@endif
					</div>
					@endforeach
				</div>
				@endif
			</div>
			<div class="__brand order2 relative z-10 py-4">
				@if (!empty($g_brand['map']))
				<div class="__map-wrapper absolute pointer-events-none  flex items-center justify-center overflow-visible">
					<img class="w-full h-auto object-contain" src="{{ $g_brand['map']['url'] }}" alt="">
				</div>
				@endif

				<h2 data-gsap-element="header" class=" text-h3 m-header relative z-10">{{ $g_brand['header'] }}</h2>
				<div data-gsap-element="txt" class="__txt mb-8 relative z-10">
					{!! $g_brand['text'] !!}
				</div>
				<div class="inline-buttons m-btn relative z-10">
					@if (!empty($g_brand['button1']))
					<x-button
						:href="$g_brand['button1']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_brand['button1']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_brand['button2']))
					<x-button
						:href="$g_brand['button2']['url']"
						variant="white"
						class=""
						data-gsap-element="btn ">
						{{ $g_brand['button2']['title'] }}
					</x-button>
					@endif
				</div>
			</div>
		</div>
	</div>
<div class="absolute blur"></div>
</section>