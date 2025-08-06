<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>

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
    .card-img-top {
      height: 160px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Company Dashboard</h2>
      <a href="{{ route('companies.create') }}" class="btn btn-primary">Create Company Profile</a>
    </div>

    @if ($companies->isEmpty())
      <div class="alert alert-info">No companies listed yet.</div>
    @else
      <div class="row">
        @foreach ($companies as $company)
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
              @if ($company->logo)
                <img src="{{ asset($company->logo) }}" class="card-img-top" alt="Logo">
              @endif
              <div class="card-body">
                <h5 class="card-title fw-semibold">{{ $company->name }}</h5>
                <p class="card-text">{{ $company->address }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</body>
</html>
