<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Company - finovo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Kumbh Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .fw-semi {
            font-weight: 600;
        }
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
        .form-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .success-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050; /* make sure it appears above other content */
        padding: 12px 20px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        animation: slideIn 0.5s ease, fadeOut 0.5s ease 3s forwards; /* optional animation */
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(100%); }
        }
    </style>
</head>
<body>
<div class="container py-5">

    <div class="text-center mb-4">
        <img src="/logo.png" alt="Finovo Logo" style="height: 40px;">
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h3 class="fw-semi mb-4">Setup Your Company Profile</h3>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success success-toast ">
                    {{ session('success') }}
                </div>
            @endif

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

            @if(session('error'))
                <div class="alert alert-danger py-2 px-3 mb-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-section">
                <form  method="POST" action="/company-create" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semi">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter company name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semi">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="company@example.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semi">Mobile</label>
                        <input type="text" name="mobile" class="form-control" placeholder="+8801×××××××××" value="{{ old('mobile') }}">
                    </div>

                    <!-- Company Address -->
                    <div class="mb-3">
                        <label class="form-label fw-semi">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter full address">{{ old('address') }}</textarea>
                    </div>

                    <!-- Company Website -->
                    <div class="mb-3">
                        <label class="form-label fw-semi">Website / Social Page</label>
                        <input type="url" name="website" class="form-control" placeholder="https://example.com" value="{{ old('website') }}">
                    </div>

                    <!-- Company Logo -->
                    <div class="mb-3">
                        <label class="form-label fw-semi">Logo</label>
                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted">Allowed formats: JPG, PNG. Max size: 2MB</small>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label fw-semi">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Short description about the company">{{ old('description') }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary-custom fw-semi py-2">Create Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
