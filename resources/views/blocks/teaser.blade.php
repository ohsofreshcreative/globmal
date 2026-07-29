@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- teaser --->

<section
	data-gsap-anim="section"
	class="b-teaser relative md:mt-14 mt-8 -smb {{ $sectionClass }} {{ $section_class }}">

	<div
		class="__wrapper relative  items-center flex radius"
		style="
background:
    linear-gradient(90deg, rgba(0, 51, 84, 1) 49.02%, rgba(0, 51, 84, 0) 100%),
    url('{{ $g_teaser['image']['url'] }}') center / cover no-repeat;
">

		<div class="__inside c-main relative">
			<div class="__content w-full md:max-w-3xl md:px-16 py-6 md:py-12 px-0">
				<p data-gsap-element="header" class="text-2xl !text-white m-header font-header">
					{!! $g_teaser['header'] !!}
				</p>

				<div data-gsap-element="txt" class="__txt mt-2 text-white">
					{!! $g_teaser['text'] !!}
				</div>

				<div class="m-btn">
					@if (!empty($g_teaser['button']))
						<x-button
							:href="$g_teaser['button']['url']"
							variant="primary"
							data-gsap-element="btn">
							{{ $g_teaser['button']['title'] }}
						</x-button>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>