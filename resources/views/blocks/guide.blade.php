@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- guide --->
<section
	data-gsap-anim="section"
	class="b-guide relative my-14 bg-white radius {{ $sectionClass }} {{ $section_class }}">
	<div
		class="__wrapper relative  items-center flex">
		<div class="__inside  relative">
			<div class="__content w-full  md:px-12 px-0 py-12">
				<h3 data-gsap-element="header" class="!text-h4 !text-black">
					{!! $g_guide['header'] !!}
				</h3>
<div class="grid grid-cols-1 md:grid-cols-[4fr_1fr] items-end">
				<div data-gsap-element="txt" class="__txt mt-2 text-xl">
					{!! $g_guide['text'] !!}
				</div>
			<img data-gsap-element="image" class="w-42 mt-6 md:mt-0" src="{{ $g_guide['image']['url'] }}" />
			</div>
			</div>
		</div>
	</div>
</section>