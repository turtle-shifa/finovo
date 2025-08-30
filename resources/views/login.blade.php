<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>

  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }
    .left-side {
      height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .logo {
      padding: 1rem;
    }
    .left-img {
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .left-img img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .form-container {
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 0 3rem;
    }
    .form-control {
      height: 45px;
      font-size: 1rem;
    }
    .signin-link {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .btn-primary {
        background-color: #5347A1;
        border-color: #5347A1;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #3f357d;
        border-color: #3f357d;
        box-shadow: none;
    }
  </style>
</head>
<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <!-- Left side with logo and image -->
      <div class="col-md-6 d-none d-md-flex flex-column left-side">
        <div class="logo">
          <img src="/images/logo.png" alt="Logo" height="60px" width="180">
        </div>
        <div class="left-img">
          <img src="/images/signup.jpg" alt="Illustration">
        </div>
      </div>

      <!-- Right side form -->
      <div class="col-12 col-md-6 d-flex align-items-center">
        <div class="form-container w-100">
          <h2 class="mb-2 fw-bold">Welcome back!</h2>
          <p class="mb-4 fw-semibold">Log in to continue managing your finances.</p>
          <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label fw-semibold">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required />
            </div>

            <div class="mb-3">
              <label for="password" class="form-label fw-semibold">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required />
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>

            <p class="signin-link text-center">
              Don't have an account? <a href="{{ route('register.form') }}">Sign up</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
