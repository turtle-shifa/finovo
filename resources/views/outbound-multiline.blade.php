<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outbound - finovo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
            border-radius: .375rem;
            border: 1px solid #ced4da;
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
                {{-- Display error message from controller --}}
                @if(session('error'))
                    <div class="alert alert-danger py-2 px-3 mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Display success message if any --}}
                @if(session('success'))
                    <div class="alert alert-success py-2 px-3 mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Display validation errors --}}
                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- <h4 class="fw-semibold mb-3">Create Outbound</h4> -->

                <form method="POST" action="/outbound">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Customer Address</label>
                            <input type="text" name="customer_address" class="form-control" value="{{ old('customer_address') }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="small-muted mb-2">Add up to {{ $lines }} lines. Leave unused lines empty.</div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th style="width:60%;">Product · Variant · Batch# · Available · Price</th>
                                        <th style="width:20%;">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i=0; $i<$lines; $i++)
                                        <tr>
                                            <td>
                                                <select name="items[{{$i}}][stock_id]" class="form-select select2-dropdown">
                                                    <option value="">Select batch</option>
                                                    @foreach($stocks as $s)
                                                        <option value="{{ $s->id }}"
                                                            {{ old("items.$i.stock_id") == $s->id ? 'selected' : '' }}>
                                                            {{ $s->product->name ?? 'Product' }}
                                                            {{ $s->variant ? '· '.$s->variant : '' }}
                                                            · B#: {{ $s->batch_number ?? '-' }}
                                                            · Avl: {{ $s->quantity }}
                                                            · {{ number_format($s->selling_price,2) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="items[{{$i}}][quantity]" class="form-control"
                                                       min="1" value="{{ old("items.$i.quantity") }}">
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tax (%)</label>
                            <input type="number" step="0.01" name="tax_rate" class="form-control" value="{{ old('tax_rate', 0) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Delivery Fee</label>
                            <input type="number" step="0.01" name="delivery_fee" class="form-control" value="{{ old('delivery_fee', 0) }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary-custom fw-semibold px-4">Generate Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2-dropdown').select2({
            placeholder: "Search product",
            allowClear: true,
            width: '100%'
        });
    });
</script>
</body>
</html>
