<?php

namespace App\Options;

/**
 * Angielska wersja strony opcji "Opinie".
 *
 * Te same pola co wersja polska, zapisywane do osobnego post_id (options_en).
 * Odczyt: \App\option_field() — wybiera wersję wg języka strony (Polylang).
 */
class OReviewsEn extends Oreviews
{
	public $name = 'Wersja EN';
	public $slug = 'oreviews-en';
	public $title = 'Opinie (EN)';
	public $parent = 'oreviews';
	public $post = 'options_en';
}
