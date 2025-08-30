<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return & OPEX - finovo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        .btn-primary-custom { 
            background:#C8EE44; border-color:#C8EE44; color:black; 
        }
        .btn-primary-custom:hover { 
            background:#b3d83e; border-color:#b3d83e; color:black; 
        }
        .table thead { 
            background:#f8f9fa; 
        }
        .small-muted { 
            color:#6c757d; font-size:.9rem; 
        }
    </style>
</head>
<body>
@include('partials.success-message')

<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-10 p-0">
            @include('partials.topbar')

            <div class="p-4">
                {{-- Error message --}}
                @if(session('error'))
                    <div class="alert alert-danger py-2 px-3 mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Success message --}}
                @if(session('success'))
                    <div class="alert alert-success py-2 px-3 mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Step 1: Enter Invoice Number -->
                <form action="{{ route('return.fetch') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row g-2 align-items-end">
                        <div class="col-md-6">
                            <label for="invoice_number" class="form-label fw-semibold">Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" 
                                   value="{{ old('invoice_number') }}" class="form-control" placeholder="Enter invoice number" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary-custom fw-semibold">Fetch Invoice</button>
                        </div>
                    </div>
                </form>

                <!-- Step 2: Display Invoice Items -->
                @if(isset($outbound))
                    <h5 class="mb-3 fw-semibold">Items Sold in Invoice: {{ $outbound->invoice_number }}</h5>

                    @php $hasReturnableItems = false; @endphp
                    <form action="{{ route('return.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="outbound_id" value="{{ $outbound->id }}">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Batch</th>
                                    <th>Unit Price</th>
                                    <th>Sold Qty</th>
                                    <th>Remaining Qty</th>
                                    <th>Return Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($outbound->items as $item)
                                    @php
                                        $alreadyReturnedQty = $item->stock->returnItems()
                                            ->whereHas('return', fn($q) => $q->where('outbound_id', $outbound->id))
                                            ->sum('quantity');
                                        $remainingQty = $item->quantity - $alreadyReturnedQty;
                                        if($remainingQty > 0) $hasReturnableItems = true;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->stock->product->name }}</td>
                                        <td>{{ $item->stock->batch_number }}</td>
                                        <td>{{ number_format($item->unit_price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $remainingQty }}</td>
                                        <td>
                                            @if($remainingQty <= 0)
                                                Already returned
                                            @else
                                                <input type="number" name="items[{{ $loop->index }}][quantity]" 
                                                       max="{{ $remainingQty }}" min="0" class="form-control" placeholder="0">
                                                <input type="hidden" name="items[{{ $loop->index }}][stock_id]" value="{{ $item->stock_id }}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary-custom fw-semibold" @if(!$hasReturnableItems) disabled @endif>
                            Return Selected Items
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
