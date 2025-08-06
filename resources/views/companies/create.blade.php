<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Company</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h3 class="fw-bold mb-4">Create Company</h3>

        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Company Name</label>
            <input type="text" class="form-control" name="name" id="name" required />
          </div>

          <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <input type="text" class="form-control" name="address" id="address" />
          </div>

          <div class="mb-3">
            <label for="logo" class="form-label fw-semibold">Company Logo</label>
            <input type="file" class="form-control" name="logo" id="logo" />
          </div>

          <button type="submit" class="btn btn-primary w-100 fw-semibold">Save Company</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
