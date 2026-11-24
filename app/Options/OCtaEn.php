<?php

namespace App\Options;

/**
 * Angielska wersja strony opcji "Wezwanie do działania".
 *
 * Te same pola co wersja polska, zapisywane do osobnego post_id (options_en).
 * Odczyt: \App\option_field() — wybiera wersję wg języka strony (Polylang).
 */
class OCtaEn extends Octa
{
	public $name = 'Wersja EN';
	public $slug = 'octa-en';
	public $title = 'Wezwanie do działania (EN)';
	public $parent = 'octa';
	public $post = 'options_en';
}
