<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Invoice {{ $outbound->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        .wrap { padding: 12px 16px; }
        .row { display:flex; justify-content:space-between; gap:12px; }
        .box { padding:6px 0; }
        table { width:100%; border-collapse: collapse; margin-top:12px; }
        th, td { border:1px solid #ddd; padding:6px; }
        th { background:#f5f5f5; }
        .text-right { text-align:right; }
        .header-logo { display:flex; align-items:center; gap:10px; }
        .header-logo img { height:50px; width:auto; }
        .mt-2 { margin-top:12px; }
    </style>
</head>
<body>
<div class="wrap">

    {{-- Header: Logo + Company info + Invoice info --}}
    <div class="row">
        <div class="box header-logo">
            @if($company->logo)
                <img src="{{ public_path($company->logo) }}" alt="{{ $company->name }}" style="height:40px; margin-right:10px;">
            @endif
            <div>
                <h3 style="margin:0;">{{ $company->name }}</h3>
                <div>{{ $company->address }}</div>
                <div>{{ $company->email }}{{ $company->mobile ? ' | '.$company->mobile : '' }}</div>
            </div>
        </div>
        <div class="box" style="text-align:right;">
            <div><strong>Invoice #</strong> {{ $outbound->invoice_number }}</div>
            <div><strong>Date</strong> {{ $outbound->created_at->format('d M Y') }}</div>
        </div>
    </div>

    {{-- Bill To --}}
    <div class="mt-2">
        <strong>Bill To:</strong><br>
        {{ $outbound->customer_name }}<br>
        {{ $outbound->customer_address }}
    </div>

    {{-- Products Table --}}
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Batch</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($outbound->items as $item)
                <tr>
                    <td>{{ $item->stock->product->name ?? 'Product' }}</td>
                    <td>{{ $item->stock->batch_number ?? '-' }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">{{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totals --}}
    <table class="mt-2">
        <tr>
            <td class="text-right"><strong>Subtotal</strong></td>
            <td class="text-right" style="width:120px">{{ number_format($outbound->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="text-right"><strong>Tax ({{ rtrim(rtrim(number_format($outbound->tax_rate,2), '0'), '.') }}%)</strong></td>
            <td class="text-right">{{ number_format($outbound->tax_amount, 2) }}</td>
        </tr>
        <tr>
            <td class="text-right"><strong>Delivery Fee</strong></td>
            <td class="text-right">{{ number_format($outbound->delivery_fee, 2) }}</td>
        </tr>
        <tr>
            <td class="text-right"><strong>Total</strong></td>
            <td class="text-right"><strong>{{ number_format($outbound->total_amount, 2) }}</strong></td>
        </tr>
    </table>

    <div class="mt-2">Thank you for your business.</div>
</div>
</body>
</html>
