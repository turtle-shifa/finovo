<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice {{ $outbound->invoice_number }} - finovo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Kumbh Sans', sans-serif; background:#f8f9fa; }
    .invoice-box { background:#fff; border:1px solid #eee; padding:24px; border-radius:8px; }
    .muted { color:#6c757d; }
    .invoice-header { margin-bottom:1rem; }
    .table th, .table td { vertical-align: middle; }
    .btn-success { font-size:0.9rem; }
</style>
</head>
<body>

<div class="container my-4">
    <div class="invoice-box mx-auto">
        <div class="d-flex justify-content-between align-items-center invoice-header">
            <div class="d-flex align-items-center">
                @if($company->logo)
                    <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}" style="height:40px; margin-right:10px;">
                @endif
                <h4 class="fw-semibold m-0">Invoice</h4>
            </div>
            <a href="{{ route('outbound.invoice.pdf', $outbound->id) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-pdf"></i> Download PDF
            </a>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <h5 class="mb-1">{{ $company->name }}</h5>
                <div class="muted">
                    {{ $company->address }}<br>
                    {{ $company->email }}{{ $company->mobile ? ' | '.$company->mobile : '' }}
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div><strong>Invoice #:</strong> {{ $outbound->invoice_number }}</div>
                <div><strong>Date:</strong> {{ $outbound->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <h6 class="fw-semibold">Bill To</h6>
            <div><strong>{{ $outbound->customer_name }}</strong></div>
            <div class="muted">{{ $outbound->customer_address }}</div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Batch</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Unit Price</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outbound->items as $item)
                        <tr>
                            <td>{{ $item->stock->product->name ?? 'Product' }}</td>
                            <td>{{ $item->stock->batch_number ?? '-' }}</td>
                            <td class="text-end">{{ $item->quantity }}</td>
                            <td class="text-end">{{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end">{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-5">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-end"><strong>Subtotal</strong></td>
                        <td class="text-end">{{ number_format($outbound->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Tax ({{ rtrim(rtrim(number_format($outbound->tax_rate,2), '0'), '.') }}%)</strong></td>
                        <td class="text-end">{{ number_format($outbound->tax_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Delivery Fee</strong></td>
                        <td class="text-end">{{ number_format($outbound->delivery_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Total</strong></td>
                        <td class="text-end"><strong>{{ number_format($outbound->total_amount, 2) }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="muted mt-3">Thank you for your business.</div>
    </div>
</div>

</body>
</html>
