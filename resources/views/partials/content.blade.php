<article @php(post_class('__card'))>

	<div class="__content relative bg-white radius p-6">

		@if (has_post_thumbnail())
		<a href="{{ get_permalink() }}" class="block rounded-lg overflow-hidden">
			<img src="{{ get_the_post_thumbnail_url(null, 'large') }}" alt="{{ get_the_title() }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-103">
		</a>
		@endif

@php($post_categories = get_the_category(get_the_ID()))

@php($post_categories = array_slice(array_filter($post_categories, fn($category) => $category->slug !== 'aktualnosci-blog'), 0, 2))
		<h6 class="mt-6">
			<a href="{{ get_permalink() }}">
				{!! get_the_title() !!}
			</a>
		</h6>

		<a href="{{ get_permalink() }}" class="mt-4 flex items-center gap-2 text-primary">
			Dowiedz się więcej
			<span>
				<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
					<path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24944 1.27664 6.61036 1.65367L9.84486 5.03226H0.921985C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774H9.84482L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96656 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#57606C"/>
				</svg>
			</span>
		</a>

	</div>

</article>