@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- top --->
<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-top relative overflow-hidden  bg-blue-light pt-24  {{ $sectionClass }} {{ $section_class }}">
	<div class="absolute -left-66 -top-26 w-[474px] h-[492px] rounded-full bg-primary opacity-70 blur-[111px]"></div>
	<div class=" __wrapper relative py-10 md:py-20">
		<div class="__inside c-main relative ">
			<div data-gsap-element="bread" class="__breadcrumb mb-4">
			@if (function_exists('yoast_breadcrumb'))
			{!! yoast_breadcrumb('<p id="breadcrumbs">','</p>') !!}
			@endif
		</div>
			<div class="__content py-8 md:py-20 w-full md:w-1/2">
				<div>
					<h1 data-gsap-element="header" class=" text-white text-h2 m-header">
						{!! $g_top['header'] !!}
					</h1>
					<div data-gsap-element="txt" class="text-lg text-light-100">
						{!! $g_top['text'] !!}
					</div>
					@if (!empty($g_top['button']))
					<div class="inline-buttons m-btn">
						@if (!empty($g_top['button']))
						<x-button
							:href="$g_top['button']['url']"
							variant="primary"
							class=""
							data-gsap-element="btn">
							{{ $g_top['button']['title'] }}
						</x-button>
						@endif

						@if (!empty($g_top['button_2']))
						<x-button
							:href="$g_top['button_2']['url']"
							variant="secondary"
							class=""
							data-gsap-element="btn">
							{{ $g_top['button_2']['title'] }}
						</x-button>
						@endif
					</div>
					@endif
				</div>
			</div>
		</div>
		<img class="absolute pointer-events-none w-240 h-auto z-20 top-0 -right-50" src="/wp-content/uploads/2026/07/shape.svg" />
	</div>
</section>