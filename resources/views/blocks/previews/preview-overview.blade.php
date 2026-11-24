<!--- overview preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tekst, zdjęcie oraz kafelki</div>
			<span class="acf-preview__slug">acf/overview</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_overview['title'] ?? null,
			'header' => $g_overview['header'] ?? null,
			'html' => $g_overview['text'] ?? null,
			'buttons' => [$g_overview['button1'] ?? null, $g_overview['button2'] ?? null],
			'image' => $g_overview['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_overview ?? [],
			'previewLabel' => 'Kafelki',
		])
	</div>
</div>
