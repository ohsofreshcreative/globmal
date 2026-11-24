<?php

namespace App\Options;

/**
 * Angielska wersja strony opcji "Logotypy partnerów".
 *
 * Te same pola co wersja polska, zapisywane do osobnego post_id (options_en).
 * Odczyt: \App\option_field() — wybiera wersję wg języka strony (Polylang).
 */
class OLogosEn extends OLogos
{
	public $name = 'Wersja EN';
	public $slug = 'ologos-en';
	public $title = 'Logotypy partnerów (EN)';
	public $parent = 'ologos';
	public $post = 'options_en';
}
