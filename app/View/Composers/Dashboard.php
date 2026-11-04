<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Dashboard extends Composer
{
    protected static $views = [
        'single-dashboard',
    ];

    public function with(): array
    {
        $post_id = get_the_ID();

        $updated = get_field('updated_at', $post_id) ?: get_the_modified_date('Y-m-d', $post_id);
        $time = strtotime((string) $updated) ?: time();

        $items = collect(\App\dashboard_items($post_id))
            ->filter(fn ($row) => filled($row['product'] ?? null) || filled($row['order_no'] ?? null))
            ->map(fn ($row) => [
                'section' => $row['section'] ?? 'produkcja',
                'orders' => collect(preg_split('/[\r\n,]+/', (string) ($row['order_no'] ?? '')))
                    ->map(fn ($no) => trim($no, " \t&_"))
                    ->filter()
                    ->values()
                    ->all(),
                'product' => $row['product'] ?? '',
                'qty' => (int) ($row['qty'] ?? 0),
                'stock_status' => $row['stock_status'] ?? 'dostepne',
                'production_status' => $row['production_status'] ?? 'produkcja',
                'progress' => max(0, min(100, (int) ($row['progress'] ?? 0))),
                'carrier' => $row['carrier'] ?? '',
                'date' => Zamowienia::formatDate($row['date'] ?? ''),
            ]);

        return [
            'updatedAt' => date('d.m.Y', $time),
            'week' => (int) date('W', $time),
            'weekYear' => date('o', $time),
            'stock' => $items->where('section', 'magazyn')->values(),
            'production' => $items->where('section', 'produkcja')->values(),
            'transport' => $items->where('section', 'transport')->values(),
            'stockStatuses' => [
                'dostepne' => ['label' => 'Dostępne', 'class' => 'bg-emerald-50 text-emerald-700'],
                'zarezerwowane' => ['label' => 'Zarezerwowane', 'class' => 'bg-amber-50 text-amber-700'],
                'niedostepne' => ['label' => 'Niedostępne', 'class' => 'bg-red-50 text-red-700'],
            ],
            'productionStatuses' => [
                'produkcja' => ['label' => 'Produkcja', 'class' => 'text-secondary-500', 'bar' => 'bg-[rgb(var(--blue))]'],
                'opoznione' => ['label' => 'Opóźnione', 'class' => 'text-red-600', 'bar' => 'bg-red-500'],
                'gotowe' => ['label' => 'Gotowe', 'class' => 'text-emerald-700', 'bar' => 'bg-emerald-500'],
            ],
        ];
    }
}
