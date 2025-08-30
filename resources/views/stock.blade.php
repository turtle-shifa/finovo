<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks - finovo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .btn-primary-custom {
            background-color: #C8EE44;
            border-color: #C8EE44;
            color: black;
        }
        .btn-primary-custom:hover {
            background-color: #b3d83e;
            border-color: #b3d83e;
            color: black;
        }
        .select2-container .select2-selection--single {
            height: 38px; 
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
        .custom-pagination .page-item .page-link {
            background-color: #C8EE44;
            border-color: #C8EE44;
            color: black;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            min-width: 30px;
            text-align: center;
        }
        .custom-pagination .page-item.active .page-link {
            background-color: #b3d83e;
            border-color: #b3d83e;
            color: black;
        }
        .custom-pagination .page-item .page-link:hover {
            background-color: #a0c836;
            border-color: #a0c836;
            color: black;
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

                <!-- FILTER FORM (Category → Product → Variant) -->
                <form method="GET" action="{{ url('/stocks') }}">
                    <div class="row">
                        <!-- Category -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold" for="category">Category</label>
                            <select class="form-select searchable-dropdown" name="category_id" onchange="this.form.submit()" required>
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold" for="product">Product</label>
                            <select class="form-select searchable-dropdown" name="product_id" onchange="this.form.submit()" {{ isset($selectedCategory) ? '' : 'disabled' }} required>
                                <option value="">Select product</option>
                                @if(isset($products))
                                    @foreach($products as $prod)
                                        <option value="{{ $prod->id }}" {{ (isset($selectedProduct) && $selectedProduct == $prod->id) ? 'selected' : '' }}>
                                            {{ $prod->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Variant -->
                        @if(isset($variants) && count($variants) > 0)
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold" for="variant">Variant</label>
                            <select class="form-select searchable-dropdown" name="variant" onchange="this.form.submit()">
                                <option value="">All Variants</option>
                                @foreach($variants as $v)
                                    <option value="{{ $v }}" {{ (isset($selectedVariant) && $selectedVariant == $v) ? 'selected' : '' }}>
                                        {{ $v }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                </form>

            </div>

            @if(isset($allStocks) && $allStocks->count() > 0)
            <div class="p-4 mt-4">
                <h5 class="fw-semibold mb-3">All Stocks</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
<<<<<<< HEAD
                            <th>Product Name</th>
                            <th>Batch</th>
                            <th>Variant</th>
                            <th>Quantity</th>
                            <th>Purchase PPU</th>
                            <th>Selling PPU</th>
=======
                            <th>Batch Number</th>
                            <th>Variant</th>
                            <th>Quantity</th>
                            <th>Purchase Price per Unit</th>
                            <th>Selling Price per Unit</th>
>>>>>>> origin/main
                            <th>Purchase Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allStocks as $stock)
                        <tr>
<<<<<<< HEAD
                            <td>{{ $stock->product->name }}</td>
=======
>>>>>>> origin/main
                            <td>{{ $stock->batch_number }}</td>
                            <td>{{ $stock->variant ?? '-' }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->purchase_price }}</td>
                            <td>{{ $stock->selling_price }}</td>
                            <td>{{ $stock->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-4 mt-4">
                <p class="text-center">No stocks found.</p>
            </div>
            @endif

            <div class="d-flex justify-content-center mt-2 custom-pagination">
                {{ $allStocks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.searchable-dropdown').select2({
            placeholder: "Search...",
            allowClear: true,
            width: '100%'
        });
    });
</script>
</body>
</html>
