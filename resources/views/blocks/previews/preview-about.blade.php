<!--- about preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tekst, zdjęcie oraz kafelki</div>
			<span class="acf-preview__slug">acf/about</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_about['title'] ?? null,
			'header' => $g_about['header'] ?? null,
			'html' => $g_about['text'] ?? null,
			'buttons' => [$g_about['button1'] ?? null, $g_about['button2'] ?? null],
			'image' => $g_about['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_about ?? [],
			'previewLabel' => 'Kafelki',
		])
	</div>
</div>
