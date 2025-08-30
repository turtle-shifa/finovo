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
<<<<<<< HEAD

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

                    <form  method="POST" enctype="multipart/form-data" action="/product-create">
=======
                    <form  method="POST" enctype="multipart/form-data">
>>>>>>> origin/main
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="category_id">Category</label>
                            <div class="d-flex align-items-center">
                                <select class="form-select me-2" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ url('/category') }}" class="btn btn-outline-success btn-sm">Add New</a>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
                            <small class="text-muted">Allowed formats: JPG, PNG. Max size: 2MB</small>
                        </div>

                        <!-- Variants -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Variants</label>
                            <div id="variant-container">
                                <div class="input-group mb-2">
                                    <input type="text" name="variants[]" class="form-control" placeholder="e.g. 30ml, XXL">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeVariant(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addVariant()">Add Variant</button>
                        </div>

                        <!-- Active / Inactive -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="is_active">Status</label>
                            <select class="form-select" name="is_active" required>
                                <option value="1" selected>Yes (Active)</option>
                                <option value="0">No (Inactive)</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary-custom fw-semibold py-2">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS for Dynamic Variants --> 
    <!-- Here I use chatgpt, as I don't know javascript -->
    <script>
        function addVariant() {
            const container = document.getElementById('variant-container');
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2');
            newField.innerHTML = `
                <input type="text" name="variants[]" class="form-control" placeholder="e.g. 30ml, XXL" required>
                <button type="button" class="btn btn-outline-danger" onclick="removeVariant(this)">Remove</button>
            `;
            container.appendChild(newField);
        }

        function removeVariant(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
