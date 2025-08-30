<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .btn-primary {
      background-color: #5347A1;
      border-color: #5347A1;
    }
    .btn-primary:hover {
      background-color: #3f357d;
      border-color: #3f357d;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2 class="fw-bold mb-4">Add Product</h2>
    <form method="POST" action="{{ route('products.store') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-semibold">Product Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">SKU</label>
        <input type="text" name="sku" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">MRP</label>
        <input type="number" name="mrp" class="form-control" step="0.01" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Purchase Price</label>
        <input type="number" name="purchase_price" class="form-control" step="0.01" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Selling Price</label>
        <input type="number" name="selling_price" class="form-control" step="0.01" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Stock Level</label>
        <input type="number" name="stock_level" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 fw-semibold">Add Product</button>
    </form>
  </div>
</body>
</html>
