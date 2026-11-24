<!--- producer preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Producent</div>
			<span class="acf-preview__slug">acf/producer</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_producer['header'] ?? null,
			'html' => $g_producer['text'] ?? null,
			'buttons' => [$g_producer['button'] ?? null],
			'image' => $g_producer['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => [$g_producer['logo'] ?? null],
			'previewLabel' => 'Logo',
		])
	</div>
</div>
