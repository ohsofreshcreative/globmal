<?php

/**
 * Edytor pozycji "Dashboard operacyjny" w panelu WP.
 *
 * Trzy listy (Stany magazynowe / W produkcji / W transporcie) z przeciąganiem
 * pozycji między nimi (jQuery UI Sortable z WP). Dane zapisywane jako JSON
 * w meta "_gm_dashboard_items" – kolejność w tablicy = kolejność na stronie.
 */

namespace App;

const DASHBOARD_META = '_gm_dashboard_items';
const DASHBOARD_SECTIONS = ['magazyn', 'produkcja', 'transport'];

/**
 * Pobiera pozycje dashboardu (używane też w View Composerze).
 */
function dashboard_items(int $post_id): array
{
    $items = json_decode((string) get_post_meta($post_id, DASHBOARD_META, true), true);

    return is_array($items) ? $items : [];
}

add_action('add_meta_boxes_dashboard', function () {
    add_meta_box(
        'gm-dashboard-items',
        'Pozycje dashboardu',
        __NAMESPACE__ . '\\render_dashboard_editor',
        'dashboard',
        'normal',
        'high'
    );
});

function render_dashboard_editor(\WP_Post $post): void
{
    wp_nonce_field('gm_dashboard_save', 'gm_dashboard_nonce');

    $sections = [
        'magazyn' => ['title' => 'Stany magazynowe', 'color' => '#059669'],
        'produkcja' => ['title' => 'W produkcji', 'color' => '#d97706'],
        'transport' => ['title' => 'W transporcie', 'color' => '#2a54c8'],
    ];
    ?>
    <div id="gm-dash">
        <p class="gm-dash-help">
            Przeciągnij pozycję za uchwyt <span class="dashicons dashicons-menu"></span> do innej listy albo użyj przycisków
            <strong>→ Magazyn / → Produkcja / → Transport</strong>. Kolejność na liście = kolejność na stronie.
            Pamiętaj, aby na końcu kliknąć <strong>Zaktualizuj</strong>.
        </p>

        <?php $i = 1; foreach ($sections as $key => $section) : ?>
            <div class="gm-dash-section" style="--gm-color: <?php echo esc_attr($section['color']); ?>">
                <div class="gm-dash-section__head">
                    <h3><?php echo $i++ . '. ' . esc_html($section['title']); ?> <span class="gm-dash-count">0</span></h3>
                    <button type="button" class="button gm-dash-add" data-section="<?php echo esc_attr($key); ?>">
                        <span class="dashicons dashicons-plus-alt2"></span> Dodaj pozycję
                    </button>
                </div>
                <div class="gm-dash-cols" data-section="<?php echo esc_attr($key); ?>">
                    <span></span>
                    <span>Nr zamówienia</span>
                    <span>Produkt / nazwa</span>
                    <span>Ilość (szt.)</span>
                    <span class="only-magazyn">Status</span>
                    <span class="only-produkcja">Status</span>
                    <span class="only-produkcja">Zaawansowanie</span>
                    <span class="only-transport">Przewoźnik</span>
                    <span class="only-produkcja">Termin</span>
                    <span class="only-transport">Dostawa</span>
                    <span>Przenieś</span>
                    <span></span>
                </div>
                <ul class="gm-dash-list" data-section="<?php echo esc_attr($key); ?>"></ul>
            </div>
        <?php endforeach; ?>

        <input type="hidden" name="gm_dashboard_items" id="gm-dash-data"
            value="<?php echo esc_attr(wp_json_encode(dashboard_items($post->ID))); ?>">
    </div>
    <?php
}

add_action('save_post_dashboard', function (int $post_id) {
    if (
        ! isset($_POST['gm_dashboard_nonce'], $_POST['gm_dashboard_items'])
        || ! wp_verify_nonce($_POST['gm_dashboard_nonce'], 'gm_dashboard_save')
        || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        || wp_is_post_revision($post_id)
        || ! current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    $raw = json_decode(wp_unslash($_POST['gm_dashboard_items']), true);
    if (! is_array($raw)) {
        return; // uszkodzone dane – nie nadpisujemy
    }

    $items = [];
    foreach ($raw as $row) {
        if (! is_array($row)) {
            continue;
        }

        $item = [
            'section' => in_array($row['section'] ?? '', DASHBOARD_SECTIONS, true) ? $row['section'] : 'produkcja',
            'order_no' => sanitize_textarea_field($row['order_no'] ?? ''),
            'product' => sanitize_text_field($row['product'] ?? ''),
            'qty' => max(0, (int) ($row['qty'] ?? 0)),
            'stock_status' => sanitize_key($row['stock_status'] ?? 'dostepne'),
            'production_status' => sanitize_key($row['production_status'] ?? 'produkcja'),
            'progress' => max(0, min(100, (int) ($row['progress'] ?? 0))),
            'carrier' => sanitize_text_field($row['carrier'] ?? ''),
            'date' => preg_match('/^\d{4}-\d{2}-\d{2}$/', $row['date'] ?? '') ? $row['date'] : '',
        ];

        if ($item['order_no'] === '' && $item['product'] === '') {
            continue; // pusty wiersz
        }

        $items[] = $item;
    }

    update_post_meta($post_id, DASHBOARD_META, wp_slash(wp_json_encode($items, JSON_UNESCAPED_UNICODE)));
});

add_action('admin_enqueue_scripts', function (string $hook) {
    if (! in_array($hook, ['post.php', 'post-new.php'], true) || get_current_screen()?->post_type !== 'dashboard') {
        return;
    }

    $dir = get_theme_file_path('resources/admin');

    wp_register_style('gm-dashboard-editor', false);
    wp_enqueue_style('gm-dashboard-editor');
    wp_add_inline_style('gm-dashboard-editor', (string) file_get_contents($dir . '/dashboard-editor.css'));

    wp_register_script('gm-dashboard-editor', false, ['jquery', 'jquery-ui-sortable'], null, true);
    wp_enqueue_script('gm-dashboard-editor');
    wp_add_inline_script('gm-dashboard-editor', (string) file_get_contents($dir . '/dashboard-editor.js'));
});
