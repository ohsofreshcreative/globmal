@php
// --- Budowanie klas sekcji ---
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}

$grouped_tabs = [];
if (!empty($r_tabs)) {
foreach ($r_tabs as $item) {
$tabName = $item['tab'] ?: 'Inne';
if (!isset($grouped_tabs[$tabName])) {
$grouped_tabs[$tabName] = [];
}
$grouped_tabs[$tabName][] = $item;
}
}
@endphp

<!--- tabs --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-tabs relative -spt overflow-hidden {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main relative z-20">
		@if (!empty($g_tabs['title']))
		<div class="title !text-secondary" data-gsap-element="title">{{ $g_tabs['title'] }}</div>
		@endif
		<div class="mb-10 flex grid grid-cols-1 md:grid-cols-2 items-start md:items-center gap-6">
			<h2 class="text-brand text-h3">
				{{ $g_tabs['header'] }}
			</h2>

			<div class="__txt  text-black">
				{!! $g_tabs['text'] !!}
			</div>
		</div>
		@if(!empty($grouped_tabs))
		<div x-data="{ activeTab: 0 }" class="mt-12">
			<div class="tabs-swiper swiper mb-10 py-2">
				<div class="swiper-wrapper gap-4">
					@foreach ($grouped_tabs as $name => $items)
					<div class="swiper-slide">
						<button
							@click="activeTab = {{ $loop->index }}"
							:class="{ 
                    'bg-third text-white': activeTab === {{ $loop->index }}, 
                    'bg-white shadow-md text-black hover:bg-gray-100': activeTab !== {{ $loop->index }} 
                }"
							class=" font-semibold whitespace-nowrap py-3 px-6 radius transition-colors duration-200 focus:outline-none">
							{{ $name }}
						</button>
					</div>
					@endforeach
				</div>
			</div>
			<div class="">
				@foreach ($grouped_tabs as $name => $items)
				<div x-show="activeTab === {{ $loop->index }}" x-cloak class="transition-opacity duration-300">
					@foreach ($items as $item)
					<div class="__card bg-white radius grid grid-cols-1 md:grid-cols-2 section-gap items-center md:py-8 md:px-12 py-6 px-6">

						<div class="__content relative ">
							@if (!empty($item['title']))
							<h4 class="text-primary mb-4">{{ $item['title'] }}</h4>
							@endif
							@if (!empty($item['text']))
							<div class="__txt text-sm">
								{!! $item['text'] !!}
							</div>
							@endif

						</div>
						@if(!empty($item['image']))
						<div class="relative overflow-hidden rounded-xs">
							<div class="absolute inset-0 z-10 rounded-xs" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, #001421) 100%)"></div>
							<img class="w-full img-xl object-cover" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
						</div>
						@endif
					</div>
					@endforeach
				</div>
				@endforeach
			</div>
		</div>
		@endif

		@if (!empty($g_tabs['button']))
		<div class="mt-10 text-center">
			<a href="{{ $g_tabs['button']['url'] }}" class="main-btn m-btn" target="{{ $g_tabs['button']['target'] ?? '_self' }}">
				{{ $g_tabs['button']['title'] }}
			</a>
		</div>
		@endif
	</div>

				<img class="absolute z-0 hidden xl:block pointer-events-none w-220 xl:w-280 h-auto  -top-42 -right-200 " src="/wp-content/uploads/2026/07/circle-mask.svg" />
</section>