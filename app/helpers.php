<?php

namespace App;

/**
 * Get the path to a versioned Mix file.
 */
// ... istniejący kod w helpers.php ...


/**
 * Generates a thumbnail from the first page of a PDF file and returns its URL.
 *
 * @param int $pdf_attachment_id The attachment ID of the PDF file.
 * @return string The URL to the generated thumbnail or the original PDF URL on failure.
 */
function get_pdf_thumbnail_url($pdf_attachment_id)
{
    // Check if Imagick extension is available
    if (!extension_loaded('imagick')) {
        error_log('Imagick extension is not loaded. PDF thumbnail generation is disabled.');
        return wp_get_attachment_url($pdf_attachment_id);
    }

    $pdf_path = get_attached_file($pdf_attachment_id);
    if (!$pdf_path || !file_exists($pdf_path)) {
        return wp_get_attachment_url($pdf_attachment_id);
    }

    $upload_dir = wp_upload_dir();
    $thumbnail_filename = pathinfo($pdf_path, PATHINFO_FILENAME) . '-pdf-thumb.jpg';
    $thumbnail_path = "{$upload_dir['path']}/{$thumbnail_filename}";
    $thumbnail_url = "{$upload_dir['url']}/{$thumbnail_filename}";

    // If thumbnail already exists, return its URL
    if (file_exists($thumbnail_path)) {
        return $thumbnail_url;
    }

    try {
        $imagick = new \Imagick();
        $imagick->setResolution(72, 72);
        $imagick->readImage("{$pdf_path}[0]");

        // Sprawdź, czy obraz jest w CMYK i tylko wtedy dokonaj transformacji
        if ($imagick->getImageColorspace() == \Imagick::COLORSPACE_CMYK) {
            // Użyj transformImageColorspace dla lepszej konwersji profili
            $imagick->transformImageColorspace(\Imagick::COLORSPACE_SRGB);
        }

        $imagick->setImageFormat('jpeg');
        $imagick->setImageBackgroundColor('white');
        $imagick->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
        $imagick->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
        $imagick->writeImage($thumbnail_path);
        $imagick->clear();
        $imagick->destroy();

        return $thumbnail_url;
    } catch (\Exception $e) {
        error_log('PDF to Image conversion failed: ' . $e->getMessage());
        return wp_get_attachment_url($pdf_attachment_id);
    }
}




/**
 * Pole ze strony opcji w języku bieżącej strony (Polylang).
 *
 * Język domyślny czyta z 'option', pozostałe z 'options_{lang}'
 * (podstrony "Wersja EN" w app/Options/*En.php). Gdy tłumaczenie jest puste,
 * wraca do wersji domyślnej, żeby sekcja nie zniknęła.
 *
 * @param string $name Nazwa pola.
 * @param int|string|null $post_id Wpis, z którego brać język (np. w podglądzie bloku w edytorze).
 * @return mixed
 */
function option_field(string $name, $post_id = null)
{
    $lang = null;

    if (function_exists('pll_get_post_language') && !empty($post_id) && is_numeric($post_id)) {
        $lang = pll_get_post_language((int) $post_id);
    }

    if (!$lang && function_exists('pll_current_language')) {
        $lang = pll_current_language();
    }

    $default = function_exists('pll_default_language') ? pll_default_language() : null;

    if ($lang && $default && $lang !== $default) {
        $value = get_field($name, 'options_' . $lang);
        $filled = is_array($value) ? !empty(array_filter($value, fn ($v) => !empty($v))) : !empty($value);

        if ($filled) {
            return $value;
        }
    }

    return get_field($name, 'option');
}
