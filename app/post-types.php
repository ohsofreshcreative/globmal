<?php


/*--- CPT - Nasza Oferta ---*/

add_action('init', function () {
    register_post_type('offers', [
        'label'         => 'Nasza Oferta',
        'labels'        => [
            'name'               => 'Nasza Oferta',
            'singular_name'      => 'offer',
            'menu_name'          => 'Nasza Oferta',
            'name_admin_bar'     => 'offer',
            'add_new'            => 'Dodaj nowy',
            'add_new_item'       => 'Dodaj nową ofertę',
            'new_item'           => 'Nowa oferta',
            'edit_item'          => 'Edytuj ofertę',
            'view_item'          => 'Zobacz ofertę',
            'all_items'          => 'Wszystkie oferty',
            'search_items'       => 'Szukaj oferty',
            'parent_item_colon'  => 'Rodzic:',
            'not_found'          => 'Nie znaleziono oferty.',
            'not_found_in_trash' => 'Brak ofert w koszu.'
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-warning',
        'menu_position' => 20,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'taxonomies'    => ['offer_category'],
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'oferty', 'with_front' => false],
    ]); 
});

add_action('init', function () {
    register_taxonomy('offer_category', ['offers'], [
        'label'        => 'Kategorie ofert',
        'labels'       => [
            'name'              => 'Kategorie ofert',
            'singular_name'     => 'Kategoria ofert',
            'search_items'      => 'Szukaj kategorii',
            'all_items'         => 'Wszystkie kategorie',
            'parent_item'       => 'Kategoria nadrzędna',
            'parent_item_colon' => 'Kategoria nadrzędna:',
            'edit_item'         => 'Edytuj kategorię',
            'update_item'       => 'Aktualizuj kategorię',
            'add_new_item'      => 'Dodaj nową kategorię',
            'new_item_name'     => 'Nazwa nowej kategorii',
            'menu_name'         => 'Kategorie',
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'kategoria-ofert', 'with_front' => false],
    ]);
});
