<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - finovo</title>

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
    @include('partials.success-message')

    <div class="container-fluid">
        <div class="row">
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
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-5 bg-white border rounded">
                        <p>Company Information / Widgets will go here...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
