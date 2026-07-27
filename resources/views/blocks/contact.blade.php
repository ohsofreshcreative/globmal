<!--- contact --->
@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<section
    data-gsap-anim="section"
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    @class([
        'b-contact relative',
        $sectionClass => filled($sectionClass),
        $section_class => filled($section_class),
        $background => filled($background) && $background !== 'none',
    ])>
    <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(181deg, #0065A7 -105.34%, #002238 98.92%) "></div>
    <div class="__wrapper  c-main  -spt -spb">
        <div class="absolute inset-0 z-10 " style="background: linear-gradient(90deg,rgba(0, 51, 84, 0.60) 0.01%, rgba(0, 101, 167, 0.60) 99.99%);"></div>
        @if (!empty($g_contact['image']))
        <x-picture
            :image="$g_contact['image']"
            figure-class="absolute inset-0 m-0 z-0"
            class="w-full h-full object-cover" />
        @endif
        <div class="absolute inset-0 z-1 pointer-events-none" style="background: linear-gradient(90deg, rgba(40, 101, 162, 0.80) 0%, rgba(40, 101, 162, 0.80) 100%);"></div>
        <div class="__inside  grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-16 relative z-20 md:pt-12">
            <div class="__content w-full mt-14 md:mt-0">
                @if (!empty($g_contact['header']))
                <p data-gsap-element="header" class=" text-h3 text-white m-title">{{ $g_contact['header'] }}</p>
                @endif
                @if (!empty($g_contact['txt']))
                <div data-gsap-element="txt" class="text-white mb-4 text-lg">{!! $g_contact['txt'] !!}</div>
                @endif
                @if (!empty($g_contact['phone']))
                <p data-gsap-element="header" class="_phone text-white mb-4 text-2xl">{{ $g_contact['phone'] }}</p>
                @endif
                @if (!empty($g_contact['mail']))
                <p data-gsap-element="header" class="_mail text-white mb-4 text-2xl">{{ $g_contact['mail'] }}</p>
                @endif
            </div>
            @if ($form)
            <div data-gsap-element="form" class="bg-white radius md:p-10 p-6">
                <h4 class="text-brand mb-4">{!! $g_contact_2['title'] !!}</h4>
                {!! do_shortcode($g_contact_2['shortcode']) !!}
            </div>
            @endif
        </div>
    </div>
</section>