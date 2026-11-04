@php
$contact = get_field('g_contact_info', 'option');
$socials = get_field('social_media', 'option');
$logo_footer = get_field('logo_footer', 'option');
$footer_background = get_field('footer_background', 'option');
@endphp

<footer
	class="footer relative overflow-hidden  text-white bg-brand">
	<div class="relative z-10 c-main px-6 ">
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 footer-py">
			<div class="flex flex-col gap-3">
				<div>
					@if(!empty($logo_footer))
					<a href="{{ home_url('/') }}" class="inline-block">
						<img
							src="{{ $logo_footer['url'] }}"
							alt="{{ get_bloginfo('name') }}"
							class="max-w-[240px] h-auto">
					</a>
					@endif
				</div>
				@if(!empty($contact['address']))
				<div class="text-base text-white mb-3 _address border-b border-t border-white/15 py-4 max-w-[280px]">
					{!! $contact['address'] !!}
				</div>
				@endif
				@if(!empty($contact['phone']))
				<a
					href="tel:{{ str_replace(' ', '', $contact['phone']) }}"
					class="text-white/85 hover:text-white transition-colors __phone">
					{{ $contact['phone'] }}
				</a>
				@endif
				@if(!empty($contact['mail']))
				<a
					href="mailto:{{ $contact['mail'] }}"
					class="text-white/85 hover:text-white transition-colors __mail">
					{{ $contact['mail'] }}
				</a>
				@endif
				@if(!empty($socials))
				<div class="flex items-center gap-3 mt-4">
					@foreach($socials as $social)
					<a
						href="{{ $social['link'] }}"
						target="_blank"
						class="flex items-center justify-center w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 transition-colors">

						<img
							src="{{ get_template_directory_uri() }}/resources/images/{{ $social['icon'] }}.svg"
							alt="{{ $social['icon'] }}"
							class="w-5 h-5">
					</a>
					@endforeach
				</div>
				@endif
			</div>
			@for ($i = 1; $i <= 3; $i++)
				@if (is_active_sidebar('sidebar-footer-' . $i))
				<div class="footer-widget-container flex flex-col gap-3">
				@php(dynamic_sidebar('sidebar-footer-' . $i))
		</div>
		@endif
		@endfor
	</div>
	<div class="footer-bottom border-t border-white/10 w-full ">
		<div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-6 py-8 text-sm text-white/60 text-center md:text-left">
			<p>
				Copyright ©{{ date('Y') }}
				{{ get_bloginfo('name') }}.
				All Rights Reserved.
			</p>
			<p class="flex items-center gap-2">
				Designed &amp; Developed by
				<a
					target="_blank"
					rel="nofollow"
					href="https://www.ohsofresh.pl"
					title="OhSoFresh">
					<img
						class="oh"
						src="{{ get_template_directory_uri() }}/resources/images/ohsofresh.svg"
						alt="OhSoFresh">
				</a>
			</p>
		</div>
	</div>
	</div>
</footer>