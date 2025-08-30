<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPEX - finovo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Kumbh Sans', sans-serif; }
        .btn-primary-custom { 
            background:#C8EE44; border-color:#C8EE44; color:black; 
        }
        .btn-primary-custom:hover { 
            background:#b3d83e; border-color:#b3d83e; color:black; 
        }
    </style>
</head>
<body>
@include('partials.success-message')

<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-10 p-0">
            @include('partials.topbar')

            <div class="p-4">

                @if(session('success'))
                    <div class="alert alert-success py-2 px-3 mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- <h4 class="mb-3 fw-bold">Add Operating Expense (OPEX)</h4> -->

                <form action="{{ route('opex.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label fw-semibold">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" 
                               value="{{ old('amount') }}" placeholder="Enter amount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label fw-semibold">Note</label>
                        <input type="text" name="note" id="note" class="form-control" 
                               value="{{ old('note') }}" placeholder="Enter note (optional)">
                    </div>
                    <button type="submit" class="btn btn-primary-custom fw-semibold">Save Expense</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
