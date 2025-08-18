<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbound - finovo</title>

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

                <!-- FILTER FORM (Category → Product) -->
                <form method="GET" action="{{ url('/inbound') }}">
                    <div class="row">
                        <!-- Category -->
                        <div class="col-md-6 mb-3">
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
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold" for="product">Product</label>
                            <select class="form-select searchable-dropdown" name="product_id" onchange="this.form.submit()" 
                                {{ isset($selectedCategory) ? '' : 'disabled' }} required>
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
                    </div>
                </form>

                <!-- INBOUND SAVE FORM -->
                @if(isset($selectedProduct))
                <form method="POST" action="{{ url('/stocks-store') }}">
                    @csrf

                    <input type="hidden" name="category_id" value="{{ $selectedCategory }}">
                    <input type="hidden" name="product_id" value="{{ $selectedProduct }}">

                    <!-- Variant -->
                    @if(isset($variants) && count($variants) > 0)
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="variant">Variant</label>
                        <select class="form-select searchable-dropdown" name="variant">
                            <option value="">Select variant</option>
                            @foreach($variants as $v)
                                <option value="{{ $v }}" {{ request('variant') == $v ? 'selected' : '' }}>
                                    {{ $v }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Enter quantity" required>
                    </div>

                    <!-- Purchase Price per Unit -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="purchase_price">Purchase Price per Unit</label>
                        <input type="number" step="0.01" class="form-control" name="purchase_price" placeholder="Enter purchase price per unit" required>
                    </div>

                    <!-- Selling Price per Unit -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="selling_price">Selling Price per Unit</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price" placeholder="Enter selling price per unit" required>
                    </div>

                    <!-- Batch Number -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="batch_number">Batch Number</label>
                        <input type="text" class="form-control" name="batch_number" placeholder="Enter batch number">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary-custom fw-semibold py-2">Add Inbound</button>
                </form>
                @endif

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
