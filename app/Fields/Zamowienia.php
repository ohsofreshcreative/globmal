<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Zamowienia extends Field
{
    /**
     * Pola dla CPT "Otwarte zamówienia".
     */
    public function fields(): array
    {
        $fields = new FieldsBuilder('zamowienia_fields', [
            'title' => 'Otwarte zamówienia',
            'style' => 'default',
            'position' => 'normal',
            'menu_order' => 0,
        ]);

        $fields->setLocation('post_type', '==', 'zamowienia');

        $fields
            ->addTab('tab_info', ['label' => 'Informacje'])
            ->addDatePicker('updated_at', [
                'label' => 'Ostatnia aktualizacja',
                'instructions' => 'Zostaw puste, aby pokazać datę ostatniego zapisu.',
                'display_format' => 'd.m.Y',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
                'wrapper' => ['width' => 33],
            ])
            ->addText('last_delivery', [
                'label' => 'Ostatnia dostawa',
                'placeholder' => 'np. Wiertło Ø65 – 120 szt (27.10.2026)',
                'wrapper' => ['width' => 67],
            ])
            ->addDatePicker('next_delivery', [
                'label' => 'Następna dostawa planowana',
                'display_format' => 'd.m.Y',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
                'wrapper' => ['width' => 33],
            ])
            ->addText('next_delivery_note', [
                'label' => 'Uwagi do następnej dostawy',
                'wrapper' => ['width' => 67],
            ])

            ->addTab('tab_orders', ['label' => 'Zamówienia'])
            ->addRepeater('orders', [
                'label' => 'Lista zamówień',
                'instructions' => 'Podsumowanie i liczniki na stronie wyliczają się automatycznie.',
                'layout' => 'table',
                'button_label' => 'Dodaj zamówienie',
                'collapsed' => 'name',
            ])
                ->addText('number', [
                    'label' => 'Nr zamówienia',
                    'wrapper' => ['width' => 16],
                ])
                ->addText('name', [
                    'label' => 'Nazwa',
                    'wrapper' => ['width' => 40],
                ])
                ->addNumber('qty_ordered', [
                    'label' => 'Ilość zamówiona',
                    'min' => 0,
                    'wrapper' => ['width' => 13],
                ])
                ->addNumber('qty_left', [
                    'label' => 'Pozostało',
                    'min' => 0,
                    'wrapper' => ['width' => 13],
                ])
                ->addDatePicker('deadline', [
                    'label' => 'Termin dostarczenia',
                    'display_format' => 'd.m.Y',
                    'return_format' => 'Y-m-d',
                    'first_day' => 1,
                    'wrapper' => ['width' => 18],
                ])
            ->endRepeater();

        return [$fields];
    }
}
