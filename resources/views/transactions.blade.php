<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - finovo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        .table thead { background:#f8f9fa; }
        .btn-primary-custom { background:#C8EE44; border-color:#C8EE44; color:black; }
        .btn-primary-custom:hover { background:#b3d83e; border-color:#b3d83e; color:black; }
        .small-muted { color:#6c757d; font-size:.9rem; }

        .custom-pagination .page-item .page-link {
            background-color: #C8EE44; 
            border-color: #C8EE44;
            color: black;
            padding: 0.25rem 0.5rem; 
            font-size: 0.875rem; 
            min-width: 30px;
            text-align: center;
        }
        .custom-pagination .page-item.active .page-link {
            background-color: #b3d83e;
            border-color: #b3d83e;
            color: black;
        }
        .custom-pagination .page-item .page-link:hover {
            background-color: #a0c836;
            border-color: #a0c836;
            color: black;
        }

        .label-inbound { background: #0d6efd; color: white; padding: 0.2rem 0.5rem; border-radius: 0.25rem; }
        .label-outbound { background: #198754; color: white; padding: 0.2rem 0.5rem; border-radius: 0.25rem; }
        .label-return { background: #dc3545; color: white; padding: 0.2rem 0.5rem; border-radius: 0.25rem; }

        .invoice-link { text-decoration: underline; color: #0d6efd; }
        .invoice-link:hover { color: #0b5ed7; text-decoration: none; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <div class="col-10 p-0">
            @include('partials.topbar')

            <div class="p-4">

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Filter Form -->
                <form id="filterForm" method="GET" class="row g-2 mb-3">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label fw-semibold">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control" onchange="document.getElementById('filterForm').submit()">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label fw-semibold">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control" onchange="document.getElementById('filterForm').submit()">
                    </div>
                    <div class="col-md-3">
                        <label for="type" class="form-label fw-semibold">Type</label>
                        <select name="type" id="type" class="form-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="">All</option>
                            <option value="inbound" {{ request('type')=='inbound' ? 'selected' : '' }}>Inbound</option>
                            <option value="outbound" {{ request('type')=='outbound' ? 'selected' : '' }}>Outbound</option>
                            <option value="return" {{ request('type')=='return' ? 'selected' : '' }}>Return</option>
                            <option value="return" {{ request('type')=='opex' ? 'selected' : '' }}>Opex</option>
                        </select>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transactions->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No transactions found.</td>
                            </tr>
                        @else
                            @foreach($transactions as $tx)
                                <tr>
                                    <td>{{ $tx->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if($tx->type==='inbound')
                                            <span class="label-inbound">Inbound</span>
                                        @elseif($tx->type==='outbound')
                                            <span class="label-outbound">Outbound</span>
                                        @elseif($tx->type==='opex')
                                            <span class="label-outbound">Opex</span>
                                        @else
                                            <span class="label-return">Return</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tx->type==='inbound')
                                            {{ $tx->description }}
                                        @elseif($tx->type==='opex')
                                            {{ $tx->description }}
                                        @else
                                            <a href="{{ $tx->description }}" target="_blank" class="invoice-link">View Invoice</a>
                                        @endif
                                    </td>
                                    <td class="text-end">{{ number_format($tx->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-2 custom-pagination">
                    {{ $transactions->appends(request()->all())->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
