<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - finovo</title>

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
        .custom-pagination .page-item .page-link {
            background-color: #C8EE44; /* light green */
            border-color: #C8EE44;
            color: black;
            padding: 0.25rem 0.5rem; /* smaller size */
            font-size: 0.875rem; /* smaller font */
            min-width: 30px;
            text-align: center;
        }
        .custom-pagination .page-item.active .page-link {
            background-color: #b3d83e; /* darker green for active */
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
    <!-- Success Message -->
    @include('partials.success-message')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <div class="col-10 p-0">
                <!-- Topbar -->
                @include('partials.topbar')

                <div class="p-4">
                    <!-- Button + Create Product-->
                    <div class="pt-2 pe-4 d-flex justify-content-end">
                        <a href="{{ url('/product-create') }}" class="btn btn-primary-custom fw-semibold py-2">
                            + Create Product
                        </a>
                    </div>

                    <!-- Search Form -->
                    <form action="{{ url('/product') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2 mt-3">

                        <select name="category" class="form-control flex-grow-1" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categoriesList as $cat)
                                <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text"
                            name="name"
                            class="form-control flex-grow-1"
                            placeholder="Search by Product Name"
                            value="{{ request('name') }}"
                            onchange="this.form.submit()">

                        <button type="submit" class="btn btn-primary-custom">Search</button>
                        <a href="{{ url('/product') }}" class="btn btn-secondary">Reset</a>
                    </form>

                </div>

                @if(isset($products) && $products->count() > 0)
                <div class="p-4 mt-4">
                    <h5 class="fw-semibold mb-3">Existing Products</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Variants</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if($product->image && file_exists(public_path($product->image)))
                                        <img src="{{ asset($product->image) }}" alt="Product" style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="Default" style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>
                                    @if(is_array($product->variants))
                                        {{ implode(', ', $product->variants) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('/product/'.$product->id.'/edit') }}" class="btn btn-sm btn-primary-custom">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <a href="{{ url('/product/'.$product->id.'/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-4 mt-4">
                    <p class="text-center">No product found.</p>
                </div>
                @endif

                <div class="d-flex justify-content-center mt-2 custom-pagination">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
