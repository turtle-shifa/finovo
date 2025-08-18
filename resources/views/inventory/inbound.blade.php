<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory (Inbound) - finovo</title>

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
    <!-- Success Message -->
    @include('partials.success-message')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <div class="col-10 p-0">
                <!-- Topbar -->
                @include('partials.topbar')

                <!-- Product Form -->
                <div class="p-4">
                    <form  method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add a short description of the product for your records."></textarea>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
                            <small class="text-muted">Allowed formats: JPG, PNG. Max size: 2MB</small>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="category">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted"><a href="/category-add">+ Add New Category</a></small>
                        </div>

                        <!-- SKU / Product Code -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="sku">SKU / Product Code</label>
                            <input type="text" class="form-control" id="sku" name="sku" placeholder="A unique identifier for the product.">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="quantity">Quantity (Qty)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="The current number of units in stock." required>
                        </div>

                        <!-- Unit of Measurement -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="unit">Unit of Measurement</label>
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="e.g., pieces, kg, boxes" required>
                        </div>

                        <!-- Purchase Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="purchase_price">Purchase Price</label>
                            <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price" placeholder="How much you paid per unit for the product." required>
                        </div>

                        <!-- Selling Price -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="selling_price">Selling Price</label>
                            <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" placeholder="The price you will sell the product for, per unit." required>
                        </div>

                        <!-- Tax / VAT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="tax">Tax / VAT</label>
                            <input type="number" step="0.01" class="form-control" id="tax" name="tax" placeholder="The tax value (if applicable) that applies to each unit.">
                        </div>

                        <!-- Batch / Lot Number -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="batch_number">Batch / Lot Number</label>
                            <input type="text" class="form-control" id="batch_number" name="batch_number" placeholder="A number to track a specific batch of products.">
                        </div>

                        <!-- Expiration Date -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="expiration_date">Expiration Date</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Where is the product stored?">
                        </div>

                        <!-- Supplier -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="supplier">Supplier</label>
                            <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Supplier name, if applicable.">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Select status</option>
                                <option value="in_stock">In Stock</option>
                                <option value="low_stock">Low Stock</option>
                                <option value="discontinued">Discontinued</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary-custom fw-semibold py-2">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
