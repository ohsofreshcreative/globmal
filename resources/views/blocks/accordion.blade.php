<!-- accordion -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-accordion relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="c-main">
		<div class="__wrapper">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-20 my-10">
				@if (!empty($g_accordion['image']))
				<img data-gsap-element="img" class="__img object-cover order1 h-full radius-img" src="{{ $g_accordion['image']['url'] }}" alt="{{ $g_accordion['image']['alt'] ?? '' }}">
				@endif
				<div class="__content order2">
					<h4 data-gsap-element="header" class="m-header">{{ $g_accordion['title'] }}</h4>
					<div data-gsap-element="txt" class="">{!! $g_accordion['text'] !!}</div>
					@if (!empty($g_accordion['button']))
					<a class="main-btn m-btn" href="{{ $g_accordion['button']['url'] }}">{{ $g_accordion['button']['title'] }}</a>
					@endif
					<div data-gsap-element="accordion" class="accordion-wrapper grid mt-10">
						@foreach ($r_accordion as $item)
						<div class="accordion rounded-2xl bg-white border border-secondary h-max">
							<input class="acc-check" type="radio" name="accordion-radio" id="check{{ $loop->index }}" {{ $loop->first ? 'checked' : '' }}>
							<label class="accordion-label flex items-center justify-between font-semibold text-md md:text-h5 gap-4" for="check{{ $loop->index }}">
								{{ $item['title'] }}
								<x-icon.arrow-up class="__arrow text-secondary w-3 h-4" />
							</label>
							<div class="accordion-content">
								{!! $item['text'] !!}

								@if (!empty($item['files']))
									<div class="files-wrapper flex flex-col gap-3 mt-4 pt-4 border-t border-gray-100">
										@foreach ($item['files'] as $file_item)
											@if (!empty($file_item['file']))
												@php
													$isPdf = str_contains($file_item['file']['mime_type'] ?? '', 'pdf') || str_ends_with(strtolower($file_item['file']['filename'] ?? ''), '.pdf');
												@endphp
												<div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-xl border border-gray-100 bg-[#f9fafb] hover:bg-gray-50 transition-colors gap-4">
													<div class="flex items-center gap-4 min-w-0 w-full sm:w-auto">
														<!-- Document Icon -->
														<div class="shrink-0">
															@if($isPdf)
																<svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M4 0C2.9 0 2 .9 2 2V26C2 27.1 2.9 28 4 28H18C19.1 28 20 27.1 20 26V8L12 0H4Z" fill="#1E65B9" />
																	<path d="M12 0V8H20L12 0Z" fill="#114C93" />
																	<text x="11" y="21" font-family="sans-serif" font-size="7" font-weight="bold" fill="white" text-anchor="middle">PDF</text>
																</svg>
															@else
																<svg width="24" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M4 0C2.9 0 2 .9 2 2V26C2 27.1 2.9 28 4 28H18C19.1 28 20 27.1 20 26V8L12 0H4Z" fill="rgb(89, 96, 107)" />
																	<path d="M12 0V8H20L12 0Z" fill="rgb(44, 48, 53)" />
																	<text x="11" y="21" font-family="sans-serif" font-size="7" font-weight="bold" fill="white" text-anchor="middle">FILE</text>
																</svg>
															@endif
														</div>
														
														<!-- File Title / Name -->
														<span class="text-sm md:text-base font-semibold text-gray-900 break-words">
															{{ $file_item['file_title'] ?: ($file_item['file']['title'] ?: $file_item['file']['filename']) }}
														</span>
													</div>
													
													<!-- Pobierz Button -->
													<a href="{{ $file_item['file']['url'] }}" download class="w-full sm:w-auto px-5 py-1.5 border border-[#1E65B9] text-[#1E65B9] hover:bg-[#1E65B9] hover:text-white rounded-full transition-colors text-sm font-semibold flex items-center justify-center shrink-0">
														Pobierz
													</a>
												</div>
											@endif
										@endforeach
									</div>
								@endif
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>