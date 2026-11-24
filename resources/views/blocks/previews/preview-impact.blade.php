<!--- impact preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Tekst oraz zdjęcie</div>
			<span class="acf-preview__slug">acf/impact</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_impact['header'] ?? null,
			'html' => $g_impact['text'] ?? null,
			'image' => $g_impact['image'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
