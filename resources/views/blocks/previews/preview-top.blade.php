<!--- top preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero - Z tłem</div>
			<span class="acf-preview__slug">acf/top</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_top['header'] ?? null,
			'html' => $g_top['text'] ?? null,
			'buttons' => [$g_top['button'] ?? null, $g_top['button_2'] ?? null],
			'flip' => $flip ?? false,
		]])
	</div>
</div>
