@extends('layouts.app')

@php
$th = 'px-6 py-5 font-semibold';
$td = 'px-6 py-5 text-body';
$orderNos = fn ($item) => implode('<br>', array_map('esc_html', $item['orders']));
$meta = [
	['icon' => 'refresh', 'label' => 'Aktualizacja danych', 'value' => $updatedAt],
	['icon' => 'calendar', 'label' => 'Tydzień', 'value' => $week . ' / ' . $weekYear],
	['icon' => 'truck', 'label' => 'Magazyn · Produkcja · Transport', 'value' => $stock->count() . ' · ' . $production->count() . ' · ' . $transport->count()],
];
@endphp

@section('content')
<x-protected-top label="Dashboard operacyjny" :meta="$meta" />

<section class="b-dashboard relative -spb">
	<div class="c-main">

		{{-- 1. Stany magazynowe --}}
		<div class="pt-16">
			<h2 class="text-h4 text-brand m-title flex items-center gap-4">
				<span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-50 text-emerald-700 shrink-0">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 8 12 3 3 8v8l9 5 9-5V8Z"/><path d="M3 8l9 5 9-5M12 13v8"/></svg>
				</span>
				1. Stany magazynowe
			</h2>
			<div class="bg-white radius b-shadow-static overflow-x-auto">
				<table class="w-full text-left min-w-[720px]">
					<thead class="bg-soft">
						<tr class="text-sm uppercase tracking-wide text-secondary-600">
							<th class="{{ $th }}">Nr zamówienia</th>
							<th class="{{ $th }}">Nazwa</th>
							<th class="{{ $th }} whitespace-nowrap">Ilość dostępna</th>
							<th class="{{ $th }}">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-secondary-100/60">
						@forelse ($stock as $item)
						@php($status = $stockStatuses[$item['stock_status']] ?? $stockStatuses['dostepne'])
						<tr>
							<td class="{{ $td }} font-semibold !text-secondary-500 whitespace-nowrap">{!! $orderNos($item) !!}</td>
							<td class="{{ $td }} font-medium">{{ $item['product'] }}</td>
							<td class="{{ $td }} font-semibold whitespace-nowrap">{{ $item['qty'] }} szt.</td>
							<td class="{{ $td }}">
								<span class="inline-block rounded-lg px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $status['class'] }}">{{ $status['label'] }}</span>
							</td>
						</tr>
						@empty
						<tr><td colspan="4" class="px-6 py-8 text-center text-secondary-400">Brak pozycji.</td></tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>

		{{-- 2. Rzeczy w produkcji --}}
		<div class="pt-16">
			<h2 class="text-h4 text-brand m-title flex items-center gap-4">
				<span class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-50 text-amber-600 shrink-0">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21V10l6 4V10l6 4V6l6-3v18H3Z"/></svg>
				</span>
				2. Rzeczy w produkcji
			</h2>
			<div class="bg-white radius b-shadow-static overflow-x-auto">
				<table class="w-full text-left min-w-[860px]">
					<thead class="bg-soft">
						<tr class="text-sm uppercase tracking-wide text-secondary-600">
							<th class="{{ $th }}">Nr zamówienia</th>
							<th class="{{ $th }}">Produkt</th>
							<th class="{{ $th }} w-[22%]">Zaawansowanie</th>
							<th class="{{ $th }}">Ilość</th>
							<th class="{{ $th }}">Termin</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-secondary-100/60">
						@forelse ($production as $item)
						@php($status = $productionStatuses[$item['production_status']] ?? $productionStatuses['produkcja'])
						<tr>
							<td class="{{ $td }} font-semibold !text-third whitespace-nowrap">{!! $orderNos($item) !!}</td>
							<td class="{{ $td }} font-medium">{{ $item['product'] }}</td>
							<td class="{{ $td }}">
								<div class="h-2 w-full rounded-full bg-secondary-100/50 overflow-hidden">
									<div class="h-full rounded-full {{ $status['bar'] }}" style="width: {{ $item['progress'] }}%"></div>
								</div>
								<div class="flex justify-between mt-2 text-xs font-bold uppercase tracking-wide">
									<span class="{{ $status['class'] }}">{{ $status['label'] }}</span>
									<span class="text-secondary-400">{{ $item['progress'] }}%</span>
								</div>
							</td>
							<td class="{{ $td }} font-semibold whitespace-nowrap">{{ $item['qty'] }} szt.</td>
							<td class="{{ $td }} font-semibold whitespace-nowrap">{{ $item['date'] }}</td>
						</tr>
						@empty
						<tr><td colspan="5" class="px-6 py-8 text-center text-secondary-400">Brak pozycji.</td></tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>

		{{-- 3. Rzeczy w transporcie --}}
		<div class="pt-16">
			<h2 class="text-h4 text-brand m-title flex items-center gap-4">
				<span class="flex items-center justify-center w-12 h-12 rounded-full bg-soft text-third shrink-0">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 4h14v12H1zM15 9h4l4 4v3h-8V9Z"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg>
				</span>
				3. Rzeczy w transporcie
			</h2>
			<div class="bg-white radius b-shadow-static overflow-x-auto">
				<table class="w-full text-left min-w-[760px]">
					<thead class="bg-soft">
						<tr class="text-sm uppercase tracking-wide text-secondary-600">
							<th class="{{ $th }}">Nr zamówienia</th>
							<th class="{{ $th }}">Produkt</th>
							<th class="{{ $th }}">Ilość</th>
							<th class="{{ $th }}">Przewoźnik</th>
							<th class="{{ $th }}">Dostawa</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-secondary-100/60">
						@forelse ($transport as $item)
						<tr>
							<td class="{{ $td }} font-semibold !text-third whitespace-nowrap">{!! $orderNos($item) !!}</td>
							<td class="{{ $td }} font-medium">{{ $item['product'] }}</td>
							<td class="{{ $td }} font-semibold whitespace-nowrap">{{ $item['qty'] }} szt.</td>
							<td class="{{ $td }}">
								@if (filled($item['carrier']))
								<span class="inline-block rounded-lg border border-third-100 bg-soft px-3 py-1 text-xs font-bold uppercase tracking-wide text-third">{{ $item['carrier'] }}</span>
								@endif
							</td>
							<td class="{{ $td }} font-semibold whitespace-nowrap">{{ $item['date'] }}</td>
						</tr>
						@empty
						<tr><td colspan="5" class="px-6 py-8 text-center text-secondary-400">Brak pozycji.</td></tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>

	</div>
</section>
@endsection
