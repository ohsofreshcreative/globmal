<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AccessPassword extends Field
{
    /**
     * Hasło dostępu do stron "Otwarte zamówienia" i "Dashboard operacyjny".
     */
    public function fields(): array
    {
        $access = new FieldsBuilder('access_password_fields', [
            'title' => 'Hasło dostępu',
            'style' => 'default',
            'position' => 'side',
            'menu_order' => 0,
        ]);

        $access
            ->setLocation('post_type', '==', 'zamowienia')
            ->or('post_type', '==', 'dashboard');

        $access
            ->addText('access_password', [
                'label' => 'Hasło',
                'instructions' => 'Hasło, które klient wpisze w „Strefie gości”. Zmiana hasła wyloguje wszystkich, którzy wpisali stare.',
                'required' => 1,
            ]);

        return [$access];
    }
}
