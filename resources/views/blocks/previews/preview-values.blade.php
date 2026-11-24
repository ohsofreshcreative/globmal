<!--- values preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tekst, zdjęcie oraz kafelki</div>
			<span class="acf-preview__slug">acf/values</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_values['title'] ?? null,
			'header' => $g_values['header'] ?? null,
			'image' => $g_values['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_values ?? [],
			'previewLabel' => 'Kafelki',
		])
	</div>
</div>
