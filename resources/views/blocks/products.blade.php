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

$grouped_products = [];
if (!empty($r_products)) {
foreach ($r_products as $item) {
$tabName = !empty($item['tab']) ? trim($item['tab']) : 'Inne';
if (!isset($grouped_products[$tabName])) {
$grouped_products[$tabName] = [];
}
$grouped_products[$tabName][] = $item;
}
}
$is_admin = is_admin();
@endphp

<!--- products --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-products relative -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main relative">
		@if (!empty($g_products['title']))
		<div class="title !text-secondary" data-gsap-element="title">{{ $g_products['title'] }}</div>
		@endif
		<div class="mb-10 flex justify-between items-center gap-6">
			@if (!empty($g_products['header']))
			<h2 class="text-brand">{{ $g_products['header'] }}</h2>
			@endif
		</div>

		@if(!empty($grouped_products))
		<div x-data="{ activeTab: 'all' }" class="mt-12">
			<div class="products-swiper swiper mb-10">
				<div class="swiper-wrapper gap-4">

					<div class="swiper-slide">
						<button
							@click="activeTab = 'all'"
							:class="{ 'bg-third text-white': activeTab === 'all', 'bg-white shadow-md text-black hover:bg-gray-100': activeTab !== 'all' }"
							class=" font-semibold whitespace-nowrap py-3 px-6  flex justify-center items-center radius transition-colors duration-200 focus:outline-none cursor-pointer">
							Wszystkie
						</button>
					</div>

					@foreach ($grouped_products as $name => $items)
					<div class="swiper-slide">
						<button
							@click="activeTab = '{{ esc_attr($name) }}'"
							:class="{ 'bg-third text-white': activeTab === '{{ esc_attr($name) }}', 'bg-white shadow-md text-black hover:bg-gray-100': activeTab !== '{{ esc_attr($name) }}' }"
							class=" font-semibold whitespace-nowrap py-3 px-6  flex justify-center items-center radius transition-colors duration-200 focus:outline-none cursor-pointer">
							{{ $name }}
						</button>
					</div>
					@endforeach

				</div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
				@foreach ($r_products as $item)
				@php
				$tabName = !empty($item['tab']) ? trim($item['tab']) : 'Inne';
				@endphp
				<a href="#zapytaj"
					@if(!$is_admin)
					x-show="activeTab === 'all' || activeTab === '{{ esc_attr($tabName) }}'"
					x-cloak
					x-transition:enter="transition ease-out duration-300 transform"
					x-transition:enter-start="opacity-0 translate-y-4 scale-97"
					x-transition:enter-end="opacity-100 translate-y-0 scale-100"
					@endif
					class="group bg-white p-6 radius shadow-md  flex flex-col justify-between transition-all duration-300 hover:shadow-lg [text-decoration:none] focus:outline-none">

					<div>
						@if(!empty($item['image']))
						<div class="relative w-full aspect-[4/3] radius overflow-hidden mb-6">
							<div class="absolute inset-0 z-10 pointer-events-none" style="background: linear-gradient(178deg, rgba(0, 0, 0, 0.00) 18.82%, var(--colors-bg-black, rgba(0, 20, 33, 0.80)) 138.28%)"></div>
							<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
						</div>
						@endif
						@if(!empty($tabName))
						<div class="mb-3">
							<span class="inline-block bg-third text-white text-[10px]  font-medium uppercase tracking-wider py-1 px-3 rounded-[4px] shadow-sm">
								{{ $tabName }}
							</span>
						</div>
						@endif
						@if (!empty($item['title']))
						<h3 class="text-brand text-h6 group-hover:text-third transition-colors duration-200 ">
							{{ $item['title'] }}
						</h3>
						@endif
						<div class="mt-8 ">
							<p class="text-base text-primary">Zapytaj o produkt</p>
						</div>
					</div>
				</a>
				@endforeach
			</div>
		</div>
		@endif

		<!-- @if (!empty($g_products['button']))
		<div class="mt-10 text-center">
			<a href="{{ $g_products['button']['url'] }}" class="main-btn m-btn" target="{{ $g_products['button']['target'] ?? '_self' }}">
				{{ $g_products['button']['title'] }}
			</a>
		</div>
		@endif -->
	</div>
</section>
