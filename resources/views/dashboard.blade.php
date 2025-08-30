<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> origin/main
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - finovo</title>

<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { font-family: 'Kumbh Sans', sans-serif; background: #f8f9fa; }

        .btn-primary-custom { 
            background:#C8EE44; border-color:#C8EE44; color:black; 
        }
        .btn-primary-custom:hover { 
            background:#b3d83e; border-color:#b3d83e; color:black; 
        }

        .finance-card {
            border-radius: 15px;
            height: 120px;
            padding: 0.8rem;
            border: 2px solid #C8EE44;
            background: #fff;
            color: #000;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            align-items: center;
        }
        .finance-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }
        .finance-card i { font-size: 2rem; opacity: 0.85; }
        .card-text { font-size: 1.6rem; font-weight: 800; color: #000; }
        .card-small-text { font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #555; }

        .circular-chart { display: block; margin: 0 auto; max-width: 80%; max-height: 80%; }
        .circle-bg { stroke: #eee; stroke-width: 3.8; }
        .circle { stroke-linecap: round; transition: stroke-dasharray 0.6s ease 0s; }
        .percentage { fill: #666; font-family: 'Kumbh Sans'; font-size: 0.4em; font-weight: 700;}

        .list-group-item { font-weight: 600; }
    </style>

</head>
<body>
=======
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Kumbh Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: white;
            min-height: 100vh;
            border-right: 1px solid #e9ecef;
            position: sticky;
            top: 0;
        }
        .sidebar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 4px;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #C8EE44;
            color: black;
        }
        .fw-semi {
            font-weight: 600;
        }
        .success-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            animation: slideIn 0.5s ease, fadeOut 0.5s ease 3s forwards;
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
    <!-- Success Message -->
>>>>>>> origin/main
    @include('partials.success-message')

    <div class="container-fluid">
        <div class="row">
<<<<<<< HEAD
            @include('partials.sidebar')
            <div class="col-10 p-0">
                @include('partials.topbar')

                <div class="p-4">
                    <div class="row g-3">
                        <!-- Total Cost -->
                        <div class="col-md-4">
                            <div class="card shadow-sm finance-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3"><i class="bi bi-cash"></i></div>
                                    <div>
                                        <small class="card-small-text">Total Cost</small>
                                        <p class="card-text mb-0">${{ number_format($totalCost, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Revenue -->
                        <div class="col-md-4">
                            <div class="card shadow-sm finance-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3"><i class="bi bi-wallet2"></i></div>
                                    <div>
                                        <small class="card-small-text">Total Revenue</small>
                                        <p class="card-text mb-0">${{ number_format($totalRevenue, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Profit -->
                        <div class="col-md-4">
                            <div class="card shadow-sm finance-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3"><i class="bi bi-piggy-bank"></i></div>
                                    <div>
                                        <small class="card-small-text">Total Profit</small>
                                        <p class="card-text mb-0">${{ number_format($totalProfit, 2) }}</p>
                                    </div>
                                </div>
=======
            @include('partials.sidebar') <!-- Sidebar -->

            <div class="col-10 p-0">
                @include('partials.topbar') <!-- Topbar -->

                <div class="content-area p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-white">
                                <h6>Total Balance</h6>
                                <h4 class="fw-semi">$5240.21</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-white">
                                <h6>Total Spending</h6>
                                <h4 class="fw-semi">$250.80</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-white">
                                <h6>Total Saved</h6>
                                <h4 class="fw-semi">$550.25</h4>
>>>>>>> origin/main
                            </div>
                        </div>
                    </div>

<<<<<<< HEAD
                    <!-- Profit Margin & Suggestions Section -->
                    <div class="row g-4 mt-1">
                        <!-- Business Health -->
                        <div class="col-md-4">
                            <div class="card p-4 shadow-sm text-center">
                                <h5 class="mb-1 fw-semibold">Business Current Health</h5>
                                <h5 class="mb-4 fw-semibold">Profit Margin</h5>

                                @php
                                    if($profitMargin >= 20) {
                                        $status = 'Strong'; $color = '#139b33ff';
                                    } elseif($profitMargin >= 10) {
                                        $status = 'Moderate'; $color = '#2990f0ff';
                                    } elseif($profitMargin > 0) {
                                        $status = 'Weak'; $color = '#ff7301ff';
                                    } else {
                                        $status = 'Poor'; $color = '#ff0019ff';
                                    }
                                @endphp

                                <div style="position: relative; width: 200px; height: 200px; margin:0 auto;">
                                    <svg viewBox="0 0 36 36" class="circular-chart">
                                        <circle
                                            cx="18" cy="18" r="15.9155"
                                            fill="none"
                                            stroke="#eee"
                                            stroke-width="3.8"
                                        />
                                        <circle
                                            cx="18" cy="18" r="15.9155"
                                            fill="none"
                                            stroke="{{ $color }}"
                                            stroke-width="3.8"
                                            stroke-dasharray="{{ $profitMargin }}, 100"
                                            stroke-linecap="round"
                                        />
                                        <text x="18" y="20.40" class="percentage" text-anchor="middle" font-size="6">{{ round($profitMargin,2) }}%</text>
                                    </svg>
                                    <h5 class="mt-3 fw-bold" style="color: {{ $color }}">{{ $status }}</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Date Filter & Metrics -->
                        <div class="col-md-4">
                            <div class="card p-4 shadow-sm">
                                <h5 class="mb-3 fw-semibold text-center">Financial Summary</h5>
                                <form id="filterForm" method="GET" class="row g-2">
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                        <input type="date" name="start_date" id="start_date"
                                            value="{{ request('start_date') }}"
                                            class="form-control"
                                            onchange="document.getElementById('filterForm').submit()">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label fw-semibold">End Date</label>
                                        <input type="date" name="end_date" id="end_date"
                                            value="{{ request('end_date') }}"
                                            class="form-control"
                                            onchange="document.getElementById('filterForm').submit()">
                                    </div>
                                </form>

                                <div class="mt-4">
                                    <p class="mb-1 fw-semibold" style="font-size:1.2rem;">
                                        ⤿ Cost: <span class="text-primary fw-bold" style="font-size:1.5rem;">
                                            ${{ number_format($filteredCost, 2) }}
                                        </span>
                                    </p>
                                    <p class="mb-1 fw-semibold" style="font-size:1.2rem;">
                                        ⤿ Revenue: <span class="text-success fw-bold" style="font-size:1.5rem;">
                                            ${{ number_format($filteredRevenue, 2) }}
                                        </span>
                                    </p>
                                    <p class="mb-0 fw-semibold" style="font-size:1.2rem;">
                                        ⤿ Profit: <span class="text-danger fw-bold" style="font-size:1.5rem;">
                                            ${{ number_format($filteredProfit, 2) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                                    
                        <div class="col-md-4">
                            <div class="card p-4 shadow-sm text-center">
                                <h5 class="mb-0 fw-semibold">Inventory Summary</h5>
                                
                                <div class="mt-3 text-start">
                                    <p class="mb-1 fw-semibold" style="font-size:1.2rem;">
                                        ⤿ Products Listed:
                                        <span class="fw-bold text-primary" style="font-size:1.5rem;">
                                            {{ $totalProducts }}
                                        </span>
                                    </p>
                                    <p class="mb-1 fw-semibold" style="font-size:1.2rem;">
                                        ⤿ Products in Stock:
                                        <span class="fw-bold text-success" style="font-size:1.5rem;">
                                            {{ $totalStock }}
                                        </span>
                                    </p>
                                    <p class="mb-1 fw-semibold" style="font-size:1.2rem;">
                                        ⤿ Items Sold:
                                        <span class="fw-bold text-success" style="font-size:1.5rem;">
                                            {{ $totalItemsSold }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Profit Margin & Suggestions -->
                    
                    <!-- Monthly Sales Chart Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card p-4 shadow-sm">
                                <h5 class="fw-semibold mb-3">Monthly Sold Items</h5>
                                <canvas id="monthlySalesChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
        

=======
                    <div class="mt-4 p-5 bg-white border rounded">
                        <p>Company Information / Widgets will go here...</p>
                    </div>
>>>>>>> origin/main
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Items Sold',
                    data: @json($monthlySales),
                    backgroundColor: '#C8EE44',
                    borderColor: '#a1c82b',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Items Sold' }
                    },
                    x: {
                        title: { display: true, text: 'Month' }
                    }
                }
            }
        });
    </script>

=======
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
=======
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
>>>>>>> origin/main
>>>>>>> origin/main
</body>
</html>
