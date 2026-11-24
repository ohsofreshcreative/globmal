<!--- logos preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Logotypy partnerów</div>
			<span class="acf-preview__slug">acf/logos</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_logos['title'] ?? null,
			'header' => $g_logos['header'] ?? null,
			'buttons' => [$g_logos['button'] ?? null],
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $g_logos['r_logos'] ?? [],
			'previewLabel' => 'Logotypy',
			'previewLimit' => 8,
		])
	</div>
</div>
