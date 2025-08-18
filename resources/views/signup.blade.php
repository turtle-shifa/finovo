<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - finovo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Kumbh Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
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
        .alert-success-custom {
            background-color: #C8EE44;
            color: black;
            border: none;
        }
    </style>
</head>
<body>
<div class="container-fluid h-100">
    <div class="row h-100">
        <!-- Left Part -->
        <div class="col-md-7 d-flex flex-column justify-content-between" style="padding-left:140px;">

            <!-- finovo Logo -->
            <div class="pt-4">
                <img src="/logo.png" alt="Logo" style="height:40px;">
            </div>

            <!-- Form -->
            <div class="my-auto" style="max-width: 400px;">
                <h3 class="fw-semi">Create new account</h3>
                <p class="text-muted mb-4">Join finovo and simplify your invoicing, sales tracking, and cash flow management—all in one place.</p>

                <form method="POST" action="/users">
                    @csrf

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success-custom py-2 px-3 mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3 mb-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semi">Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Your name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semi">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semi">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="••••••••">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary-custom fw-semi py-2">Create Account</button>
                    </div>
                </form>

                <p class="mt-3">Already have an account?
                    <a href="/signin" class="fw-semi text-decoration-none">Sign in</a>
                </p>
            </div>

            <!-- Empty Space in Bottom -->
            <div></div>
        </div>

        <!-- Right Part -->
        <div class="col-md-5 p-0">
            <img src="/signup_image.png" class="w-100 h-100 object-fit-cover" alt="Signup Illustration">
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
