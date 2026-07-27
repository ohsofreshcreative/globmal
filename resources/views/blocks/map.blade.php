<!-- map  -->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-map relative -smt -smb' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
		@if(!empty($g_map['map']))
		<div data-gsap-element="map" class="__map">
			{!! $g_map['map'] !!}
		</div>
		@endif
		<div class="__content ">
			@if(!empty($g_map['header']))
			<h2 data-gsap-element="header" class="m-header">
				{{ $g_map['header'] }}
			</h2>
			@endif
			@if(!empty($g_map['txt']))
			<div data-gsap-element="txt" class="__txt text-brand">
				{!! $g_map['txt'] !!}
			</div>
			@endif
		</div>
	</div>
</section>