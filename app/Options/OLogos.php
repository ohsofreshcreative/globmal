<?php

namespace App\Options;

use Log1x\AcfComposer\Options;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OLogos extends Options
{
    public $name = 'Logotypy partnerów';
    public $slug = 'ologos';
    public $title = 'Logotypy partnerów';
    public $position = 102;
    public $capability = 'edit_posts';
    public $redirect = false;

    public function fields(): FieldsBuilder
    {
        $logos = new FieldsBuilder('ologos');

        $logos
            ->addGroup('g_logos', ['label' => ''])
            ->addText('header', ['label' => 'Tytuł'])
            ->addRepeater('r_logos', [
				'label' => 'Kafelki',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'button_label' => 'Dodaj kafelek'
			])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->endRepeater()
			->addLink('button', [
				'label' => 'Przycisk',
			])
            ->endGroup();

        return $logos;
    }
}