<!--- offer preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Oferta</div>
			<span class="acf-preview__slug">acf/offer</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $subtitle ?? null,
			'header' => $title ?? null,
			'buttons' => [$posts_settings['button'] ?? null],
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => array_map(fn ($p) => ['title' => get_the_title($p), 'image_url' => get_the_post_thumbnail_url($p, 'thumbnail')], (array) ($posts ?? [])),
			'previewLabel' => 'Wpisy',
		])
	</div>
</div>
