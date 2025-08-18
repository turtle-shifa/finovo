<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category - finovo</title>

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

                <!-- Category Form -->
                <div class="p-4">
                    <form action="/category" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="name">Create New Category</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter new category" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom fw-semibold">Create</button>
                    </form>
                </div>
                <!-- Category List -->
                @if(isset($categories) && $categories->count() > 0)
                <div class="p-4 mt-4">
                    <h5 class="fw-semibold mb-3">Existing Categories</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/category/'.$category->id.'/edit') }}" class="btn btn-sm btn-primary-custom">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <a href="{{ url('/category/'.$category->id.'/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
                    <p class="text-center">No category found.</p>
                </div>
                @endif
                <div class="d-flex justify-content-center mt-2 custom-pagination">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
