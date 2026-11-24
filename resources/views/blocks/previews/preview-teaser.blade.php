<!--- teaser preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Baner - Z tłem i treścią</div>
			<span class="acf-preview__slug">acf/teaser</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_teaser['header'] ?? null,
			'html' => $g_teaser['text'] ?? null,
			'buttons' => [$g_teaser['button'] ?? null],
			'image' => $g_teaser['image'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
