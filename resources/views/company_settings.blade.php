<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Settings - finovo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <div class="col-10 p-0">
                <!-- Topbar -->
                @include('partials.topbar')

                <div class="p-4">
                    <h3 class="fw-semibold mb-4">Edit Company Profile</h3>

                    <!-- Success Message -->
                    @include('partials.success-message')

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/settings') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mobile</label>
                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $company->mobile) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address', $company->address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Website / Social Page</label>
                            <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            <small class="text-muted">Allowed formats: JPG, PNG. Max size: 2MB</small>
                            @if($company->logo)
                                <div class="mt-2">
                                    <img src="{{ asset($company->logo) }}" alt="Company Logo" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $company->description) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary-custom fw-semibold py-2">Update Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
