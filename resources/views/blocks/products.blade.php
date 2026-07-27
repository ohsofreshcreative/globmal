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
			<div class="flex justify-center flex-wrap gap-4 mb-10">
				<button
					@click="activeTab = 'all'"
					:class="{ 'bg-third text-white': activeTab === 'all', 'bg-white shadow-md text-black hover:bg-gray-100': activeTab !== 'all' }"
					class="text-h6 whitespace-nowrap py-4 px-6 min-w-[260px] md:min-w-[320px] flex justify-center items-center radius transition-colors duration-200 focus:outline-none cursor-pointer">
					Wszystkie
				</button>
				@foreach ($grouped_products as $name => $items)
				<button
					@click="activeTab = '{{ esc_attr($name) }}'"
					:class="{ 'bg-third text-white': activeTab === '{{ esc_attr($name) }}', 'bg-white shadow-md text-black hover:bg-gray-100': activeTab !== '{{ esc_attr($name) }}' }"
					class="text-h6 whitespace-nowrap py-4 px-6 min-w-[260px] md:min-w-[320px] flex justify-center items-center radius transition-colors duration-200 focus:outline-none cursor-pointer">
					{{ $name }}
				</button>
				@endforeach
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
				@foreach ($r_products as $item)
				@php
				$tabName = !empty($item['tab']) ? trim($item['tab']) : 'Inne';
				$hasButton = !empty($item['button']['url']);
				$tag = $hasButton ? 'a' : 'div';
				$href = $hasButton ? 'href="' . esc_url($item['button']['url']) . '"' : '';
				$target = $hasButton ? 'target="' . esc_attr($item['button']['target'] ?? '_self') . '"' : '';
				@endphp
				<{!! $tag !!}
					{!! $href !!}
					{!! $target !!}
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
					</div>
					<div class="mt-8 ">
						<div class="text-third  flex items-center gap-2 transition-transform duration-200">
							<span class="text-base text-primary">{{ !empty($item['button']['title']) ? $item['button']['title'] : 'Zobacz produkty' }}</span>
							<span class="inline-block transition-transform duration-200 group-hover:translate-x-1 text-lg leading-none"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
									<path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24944 1.27664 6.61036 1.65367L9.84486 5.03226H0.921985C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774H9.84482L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96656 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#57606C" />
								</svg></span>
						</div>
					</div>
				</{!! $tag !!}>
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