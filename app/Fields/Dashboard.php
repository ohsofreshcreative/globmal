<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Dashboard extends Field
{
    /**
     * Pola dla CPT "Dashboard operacyjny".
     *
     * Same pozycje (Magazyn / Produkcja / Transport) edytowane są w osobnym
     * metaboxie z przeciąganiem – zob. app/dashboard-editor.php.
     */
    public function fields(): array
    {
        $fields = new FieldsBuilder('dashboard_fields', [
            'title' => 'Data aktualizacji',
            'style' => 'default',
            'position' => 'side',
            'menu_order' => 1,
        ]);

        $fields->setLocation('post_type', '==', 'dashboard');

        $fields
            ->addDatePicker('updated_at', [
                'label' => 'Aktualizacja danych',
                'instructions' => 'Numer tygodnia wylicza się z tej daty. Puste = data ostatniego zapisu.',
                'display_format' => 'd.m.Y',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
            ]);

        return [$fields];
    }
}
