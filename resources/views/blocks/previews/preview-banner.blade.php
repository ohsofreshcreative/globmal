<!--- banner preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Hero - Z tłem</div>
			<span class="acf-preview__slug">acf/banner</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_banner['header'] ?? null,
			'html' => $g_banner['text'] ?? null,
			'buttons' => [$g_banner['button1'] ?? null, $g_banner['button2'] ?? null],
			'image' => $g_banner['image'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
