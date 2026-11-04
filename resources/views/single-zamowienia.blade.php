@extends('layouts.app')

@php
$meta = [['icon' => 'refresh', 'label' => 'Ostatnia aktualizacja', 'value' => $updatedAt]];
if (filled($lastDelivery)) {
	$meta[] = ['icon' => 'truck', 'label' => 'Ostatnia dostawa', 'value' => $lastDelivery];
}
if (filled($nextDelivery) || filled($nextDeliveryNote)) {
	$meta[] = ['icon' => 'calendar', 'label' => 'Następna dostawa planowana', 'value' => trim($nextDelivery . ' ' . $nextDeliveryNote)];
}
@endphp

@section('content')
<x-protected-top label="Otwarte zamówienia" :meta="$meta" />

<section class="b-orders relative -spb">
	<div class="c-main">

		{{-- Liczniki --}}
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6 -mt-14 md:-mt-20 relative z-30">
			<div class="bg-white radius b-shadow-static p-8 text-center">
				<p class="text-secondary-500 text-lg !mb-2">Łączna liczba zamówień</p>
				<p class="text-h2 text-third !mb-0">{{ $ordersCount }}</p>
			</div>
			<div class="bg-white radius b-shadow-static p-8 text-center">
				<p class="text-secondary-500 text-lg !mb-2">Łączna liczba produktów (pozostało)</p>
				<p class="text-h2 text-third !mb-0">{{ number_format($totalLeft, 0, ',', ' ') }}</p>
			</div>
		</div>

		{{-- Lista zamówień --}}
		<div class="mt-16">
			<h2 class="text-h4 text-brand m-title">Lista zamówień</h2>
			<div class="bg-white radius b-shadow-static overflow-x-auto">
				<table class="w-full text-left min-w-[720px]">
					<thead class="bg-soft">
						<tr class="text-sm uppercase tracking-wide text-secondary-600">
							<th class="px-6 py-5 font-semibold">Nr zamówienia</th>
							<th class="px-6 py-5 font-semibold">Nazwa</th>
							<th class="px-6 py-5 font-semibold whitespace-nowrap">Ilość zamówiona</th>
							<th class="px-6 py-5 font-semibold">Pozostało</th>
							<th class="px-6 py-5 font-semibold whitespace-nowrap">Termin dostarczenia</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-secondary-100/60">
						@forelse ($orders as $order)
						<tr>
							<td class="px-6 py-5 font-semibold text-third whitespace-nowrap">{{ $order['number'] }}</td>
							<td class="px-6 py-5 text-body">{{ $order['name'] }}</td>
							<td class="px-6 py-5 text-body whitespace-nowrap">{{ $order['qty_ordered'] }}</td>
							<td class="px-6 py-5 font-semibold text-body whitespace-nowrap">{{ $order['qty_left'] }}</td>
							<td class="px-6 py-5 text-body whitespace-nowrap">{{ $order['deadline'] }}</td>
						</tr>
						@empty
						<tr>
							<td colspan="5" class="px-6 py-8 text-center text-secondary-400">Brak otwartych zamówień.</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>

		{{-- Podsumowanie produktów --}}
		@if ($summary->isNotEmpty())
		<div class="mt-16">
			<h2 class="text-h4 text-brand m-title">Podsumowanie produktów</h2>
			<div class="bg-white radius b-shadow-static overflow-x-auto">
				<table class="w-full text-left min-w-[560px]">
					<thead class="bg-soft">
						<tr class="text-sm uppercase tracking-wide text-secondary-600">
							<th class="px-6 py-5 font-semibold">Produkt</th>
							<th class="px-6 py-5 font-semibold whitespace-nowrap">Ilość łącznie (pozostało)</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-secondary-100/60">
						@foreach ($summary as $row)
						<tr>
							<td class="px-6 py-5 text-body">{{ $row['name'] }}</td>
							<td class="px-6 py-5 font-semibold text-body">{{ $row['qty_left'] }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif

	</div>
</section>
@endsection
