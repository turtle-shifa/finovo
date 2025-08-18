<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - finovo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">

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
    </style>
</head>
<body>
    @include('partials.success-message')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <div class="col-10 p-0">
                <!-- Topbar -->
                @include('partials.topbar')

                <div class="p-4">
                    <h4 class="mb-4">Edit Product</h4>

                    <form method="POST" action="{{ url('/products/'.$product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" 
                                   value="{{ old('product_name', $product->name) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                                     style="height:60px; width:60px; object-fit:cover; margin-top:10px;">
                            @endif
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="category">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted"><a href="/category-add">+ Add New Category</a></small>
                        </div>

                        <!-- SKU / Product Code -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="sku">SKU / Product Code</label>
                            <input type="text" class="form-control" id="sku" name="sku" 
                                   value="{{ old('sku', $product->sku) }}">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="quantity">Quantity (Qty)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" 
                                   value="{{ old('quantity', $product->quantity) }}" required>
                        </div>

                        <!-- Unit of Measurement -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="unit">Unit of Measurement</label>
                            <input type="text" class="form-control" id="unit" name="unit" 
                                   value="{{ old('unit', $product->unit) }}" required>
                        </div>

                        <!-- Purchase Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="purchase_price">Purchase Price</label>
                            <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price" 
                                   value="{{ old('purchase_price', $product->purchase_price) }}" required>
                        </div>

                        <!-- Selling Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="selling_price">Selling Price</label>
                            <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" 
                                   value="{{ old('selling_price', $product->selling_price) }}" required>
                        </div>

                        <!-- Tax / VAT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="tax">Tax / VAT</label>
                            <input type="number" step="0.01" class="form-control" id="tax" name="tax" 
                                   value="{{ old('tax', $product->tax) }}">
                        </div>

                        <!-- Batch / Lot Number -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="batch_number">Batch / Lot Number</label>
                            <input type="text" class="form-control" id="batch_number" name="batch_number" 
                                   value="{{ old('batch_number', $product->batch_number) }}">
                        </div>

                        <!-- Expiration Date -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="expiration_date">Expiration Date</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date" 
                                   value="{{ old('expiration_date', $product->expiration_date) }}">
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   value="{{ old('location', $product->location) }}">
                        </div>

                        <!-- Supplier -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="supplier">Supplier</label>
                            <input type="text" class="form-control" id="supplier" name="supplier" 
                                   value="{{ old('supplier', $product->supplier) }}">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Select status</option>
                                <option value="in_stock" {{ $product->status == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="low_stock" {{ $product->status == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                                <option value="discontinued" {{ $product->status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary-custom fw-semibold py-2">Update Product</button>
                        <a href="{{ url('/products') }}" class="btn btn-secondary py-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
