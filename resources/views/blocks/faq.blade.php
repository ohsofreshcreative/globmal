<!--- faq --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-faq relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	<div class="__wrapper c-main grid grid-cols-1">
		<div data-gsap-element="tabs" class="tabs-wrapper flex flex-col mt-4">
			@foreach ($r_faq as $item)
			<div class="tabs rounded-2xl bg-white border border-[#728CA1] h-max">
				<input class="tab-check" type="checkbox" name="radio-a" id="check{{ $loop->index }}" {{ $loop->first ? 'checked' : '' }}>
				<label class="tabs-label flex items-center justify-between" for="check{{ $loop->index }}">
					<div class="flex items-center gap-4">
						<p class="text-2xl font-semibold font-header">{{ $item['title'] }}</p>
					</div>
					<x-icon.arrow-up class="__arrow text-black w-3 h-4" />
				</label>
				<div class="tabs-content">
					{!! $item['txt'] !!}

					@if (!empty($item['files']))
					<div class="files-wrapper flex flex-col gap-6 mt-4 pt-4">
						@foreach ($item['files'] as $file_item)
						@if (!empty($file_item['file']))
						@php
						$isPdf = str_contains($file_item['file']['mime_type'] ?? '', 'pdf') || str_ends_with(strtolower($file_item['file']['filename'] ?? ''), '.pdf');
						@endphp
						<div class="flex flex-col sm:flex-row sm:items-center justify-between rounded-xl gap-4">
							<div class="flex items-center gap-4 min-w-0 w-full sm:w-auto">
								<!-- Document Icon -->
								<div class="flex-shrink-0 w-6 h-auto">
									<img class="" src="/wp-content/uploads/2026/07/pdf.png" />
								</div>
								<!-- tytul pliku -->
								<span class="text-black text-sm md:text-base font-semibold break-words">
									{{ $file_item['file_title'] ?: ($file_item['file']['title'] ?: $file_item['file']['filename']) }}
								</span>
							</div>
							<!-- pobierz btn -->
							<a href="{{ $file_item['file']['url'] }}" download class="w-full sm:w-auto px-8 py-4 border border-[#2281BE] !text-[#2281BE] hover:bg-[#2281BE] hover:!text-white radius transition-colors flex items-center justify-center flex-shrink-0">
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
</section>