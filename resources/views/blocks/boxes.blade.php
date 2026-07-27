<!--- boxes --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-boxes relative -smt -spb' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		@if (!empty($g_boxes['header']))
		<h2 data-gsap-element="header" class="mb-8 md:mb-12 text-h3">{{ strip_tags($g_boxes['header']) }}</h2>
		@endif
		@if (!empty($r_boxes))
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
			@foreach ($r_boxes as $item)
			<div
				data-gsap-element="card"
				class="__card relative overflow-hidden md:min-h-120 min-h-70 p-8 md:p-12 radius bg-cover bg-center flex items-end"
				@if(!empty($item['image']['url']))
				style="background-image: url('{{ $item['image']['url'] }}')"
				@endif>
				<div class="absolute inset-0 bg-black/30"></div>
				<div class="relative z-10">
					@if (!empty($item['title']))
					<p class="text-h4 font-semibold text-white">
						{{ $item['title'] }}
					</p>
					@endif
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>
</section>