<!--- brand preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tekst oraz zdjęcie</div>
			<span class="acf-preview__slug">acf/brand</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_brand['header'] ?? null,
			'html' => $g_brand['text'] ?? null,
			'buttons' => [$g_brand['button1'] ?? null, $g_brand['button2'] ?? null],
			'image' => $g_brand['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $g_brand['r_stats'] ?? [],
			'previewLabel' => 'Statystyki',
		])
	</div>
</div>
