<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SinglePost extends Field
{
    /**
     * Definiuje grupę pól dla pojedynczego wpisu blogowego.
     * Na podstawie tej definicji pola pokażą się automatycznie w kokpicie WordPressa.
     *
     * @return array
     */
    public function fields(): array
    {
        $singlePost = new FieldsBuilder('single_post_fields', [
            'title' => 'Czas czytania we wpisie',
            'style' => 'default',
            'position' => 'side', 
        ]);

        $singlePost
            ->setLocation('post_type', '==', 'post');

        $singlePost
            ->addGroup('reading_time', [
                'label' => 'Czas czytania',
                'layout' => 'block',
            ])

                ->addText('time', [
                    'label' => 'Czas czytania',
                    'instructions' => 'Wpisz czas czytania wyświetlany na boksie.',
                ])

            ->endGroup();

        return [$singlePost];
    }
}
