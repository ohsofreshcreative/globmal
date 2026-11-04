<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Zamowienia extends Composer
{
    protected static $views = [
        'single-zamowienia',
    ];

    public function with(): array
    {
        $post_id = get_the_ID();

        $orders = collect(get_field('orders', $post_id) ?: [])
            ->filter(fn ($row) => filled($row['number'] ?? null) || filled($row['name'] ?? null))
            ->map(fn ($row) => [
                'number' => $row['number'] ?? '',
                'name' => $row['name'] ?? '',
                'qty_ordered' => (int) ($row['qty_ordered'] ?? 0),
                'qty_left' => (int) ($row['qty_left'] ?? 0),
                'deadline' => self::formatDate($row['deadline'] ?? ''),
            ])
            ->values();

        $summary = $orders
            ->groupBy(fn ($row) => trim($row['name']))
            ->map(fn ($rows, $name) => [
                'name' => $name,
                'qty_left' => $rows->sum('qty_left'),
            ])
            ->values();

        return [
            'updatedAt' => self::formatDate(get_field('updated_at', $post_id)) ?: get_the_modified_date('d.m.Y', $post_id),
            'lastDelivery' => get_field('last_delivery', $post_id),
            'nextDelivery' => self::formatDate(get_field('next_delivery', $post_id)),
            'nextDeliveryNote' => get_field('next_delivery_note', $post_id),
            'orders' => $orders,
            'summary' => $summary,
            'ordersCount' => $orders->count(),
            'totalLeft' => $orders->sum('qty_left'),
        ];
    }

    public static function formatDate($value): string
    {
        if (empty($value)) {
            return '';
        }

        $time = strtotime((string) $value);

        return $time ? date('d.m.Y', $time) : (string) $value;
    }
}
