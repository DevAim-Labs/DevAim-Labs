{{-- "vanaf € 1.234" from the pricing config, or "Prijs op aanvraag" when the price is null. --}}
@php $pr = $t['pricing']; @endphp
@if ($s['price_from'] !== null)
    <span class="svc-price-value"><span class="svc-price-value__from">{{ $pr['from'] }}</span> {{ $pr['currency'] }} {{ number_format($s['price_from'], 0, ',', '.') }}</span>
@else
    <span class="svc-price-value">{{ $pr['on_request'] }}</span>
@endif
