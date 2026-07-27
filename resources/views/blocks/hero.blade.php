<!-- hero --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-hero relative -spt  overflow-visible md:h-200' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	'has-video-bg' => !empty($g_hero['video']),
	])>

    @if (!empty($g_hero['video']))
        <div class="absolute inset-0 overflow-hidden z-0 pointer-events-none ">
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
                <source src="{{ $g_hero['video'] }}" type="video/mp4">
                Twoja przeglądarka nie obsługuje odtwarzania wideo.
            </video>
            <div class="absolute inset-0 z-10" style="background: linear-gradient(90deg,rgba(0, 51, 84, 0.60) 0.01%, rgba(0, 101, 167, 0.60) 99.99%);"></div>
        </div>
    @endif
	<div class=" __wrapper c-main  items-center ">
		<div class="__content relative flex flex-col justify-center z-20 pt-10 pb-10 md:py-30 md:w-1/2 w-full md:mt-24 mt-10">
			<h1 data-gsap-element="header" class="m-header text-white text-h3">
				{{ $g_hero['title'] }}
			</h1>
			<div data-gsap-element="text" class="text-white text-xl">
				{!! $g_hero['text'] !!}
			</div>

			<div class="inline-buttons m-btn">
				@if (!empty($g_hero['button1']))
				<x-button
					:href="$g_hero['button1']['url']"
					variant="primary"
					class=""
					data-gsap-element="btn">
					{{ $g_hero['button1']['title'] }}
				</x-button>
				@endif

				@if (!empty($g_hero['button2']))
				<x-button
					:href="$g_hero['button2']['url']"
					variant="white"
					class=""
					data-gsap-element="btn">
					{{ $g_hero['button2']['title'] }}200
				</x-button>
				@endif
			</div>
		</div>

	</div>
<!-- <div
    class="a w-full h-[105px] pointer-events-none"
    style="background: linear-gradient(0deg, #003354 0%, rgba(0, 51, 84, 0.00) 100%);">
</div> -->
</section>