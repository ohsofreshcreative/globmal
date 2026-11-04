<?php

/**
 * Strony chronione hasłem (ACF "access_password"):
 * CPT "zamowienia" (Otwarte zamówienia) i "dashboard" (Dashboard operacyjny).
 *
 * Hasło wpisane raz zapamiętywane jest w ciasteczku na 30 dni.
 * Ciasteczko zawiera podpis (HMAC) z ID wpisu i aktualnego hasła,
 * więc zmiana hasła w panelu unieważnia wszystkie stare dostępy.
 */

namespace App;

use function Roots\view;

const PROTECTED_POST_TYPES = ['zamowienia', 'dashboard'];
const ACCESS_COOKIE_DAYS = 30;
const ACCESS_MAX_ATTEMPTS = 10; // na 15 minut z jednego IP

function access_cookie_name(int $post_id): string
{
    return 'gm_access_' . $post_id;
}

function access_token(int $post_id, string $password): string
{
    return hash_hmac('sha256', $post_id . '|' . $password, wp_salt('auth'));
}

function has_access(int $post_id): bool
{
    if (current_user_can('edit_post', $post_id)) {
        return true;
    }

    $password = (string) get_field('access_password', $post_id);
    if ($password === '') {
        return false;
    }

    $cookie = $_COOKIE[access_cookie_name($post_id)] ?? '';

    return is_string($cookie) && hash_equals(access_token($post_id, $password), $cookie);
}

/**
 * Brak cache i indeksowania dla chronionych stron.
 */
add_action('template_redirect', function () {
    if (! is_singular(PROTECTED_POST_TYPES)) {
        return;
    }

    nocache_headers();
    header('X-Robots-Tag: noindex, nofollow', true);
    do_action('litespeed_control_set_nocache', 'protected page');

    $post_id = get_queried_object_id();
    $error = null;

    // Obsługa formularza hasła
    if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['gm_access_password'])) {
        $ip_key = 'gm_access_attempts_' . md5($_SERVER['REMOTE_ADDR'] ?? '');
        $attempts = (int) get_transient($ip_key);

        $password = (string) get_field('access_password', $post_id);
        $typed = trim((string) wp_unslash($_POST['gm_access_password']));

        if ($attempts >= ACCESS_MAX_ATTEMPTS) {
            $error = 'Zbyt wiele prób. Spróbuj ponownie za kilkanaście minut.';
        } elseif ($password !== '' && hash_equals($password, $typed)) {
            delete_transient($ip_key);

            setcookie(access_cookie_name($post_id), access_token($post_id, $password), [
                'expires' => time() + ACCESS_COOKIE_DAYS * DAY_IN_SECONDS,
                'path' => COOKIEPATH ?: '/',
                'domain' => COOKIE_DOMAIN ?: '',
                'secure' => is_ssl(),
                'httponly' => true,
                'samesite' => 'Lax',
            ]);

            wp_safe_redirect(get_permalink($post_id));
            exit;
        } else {
            set_transient($ip_key, $attempts + 1, 15 * MINUTE_IN_SECONDS);
            $error = 'Nieprawidłowe hasło.';
        }
    }

    if (has_access($post_id)) {
        return;
    }

    status_header(200);
    echo view('guest-zone', [
        'error' => $error,
        'action' => get_permalink($post_id),
    ])->render();
    exit;
});

/**
 * noindex w <head> (na wypadek gdyby nagłówek HTTP został pominięty).
 */
add_filter('wp_robots', function ($robots) {
    if (is_singular(PROTECTED_POST_TYPES)) {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }

    return $robots;
});

/**
 * Wyłączenie z sitemapy WordPressa i Yoasta.
 */
add_filter('wp_sitemaps_post_types', function ($types) {
    foreach (PROTECTED_POST_TYPES as $type) {
        unset($types[$type]);
    }

    return $types;
});

add_filter('wpseo_sitemap_exclude_post_type', function ($excluded, $post_type) {
    return in_array($post_type, PROTECTED_POST_TYPES, true) ? true : $excluded;
}, 10, 2);
