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
</style>


<div class="topbar d-flex align-items-center justify-content-between px-4" style="height:70px; background-color:white; border-bottom:1px solid #e9ecef;">
    @php
        $pageTitle = 'Dashboard';
        if (request()->is('generate-invoice')) 
            $pageTitle = 'Generate Invoice';
        elseif (request()->is('transactions')) 
            $pageTitle = 'Transactions';
        elseif (request()->is('settings')) 
            $pageTitle = 'Settings';
        elseif (request()->is('help')) 
            $pageTitle = 'Help';
        elseif (request()->is('profile')) 
            $pageTitle = 'Profile';
        elseif (request()->is('inbound')) 
            $pageTitle = 'Inbound (Purchase)';
        elseif (request()->is('product*')) 
            $pageTitle = 'Product';
        elseif (request()->is('outbound')) 
            $pageTitle = 'Outbound';
        elseif (request()->is('category*')) 
            $pageTitle = 'Category';
        elseif (request()->is('stock*')) 
            $pageTitle = 'Stocks';
        elseif (request()->is('return*')) 
            $pageTitle = 'Return Logistics';
        elseif (request()->is('opex*')) 
            $pageTitle = 'Add Operating Expense (OPEX)';
    @endphp

    <h5 class="mb-0 fw-semi">{{ $pageTitle }}</h5>

    <div class="d-flex align-items-center gap-3">

        <!-- User Dropdown -->
        <div class="dropdown">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                @php
                if (session('user_id')){
                    $userID = session('user_id');
                    $user = DB::table('users')->find($userID);
                    $userName = $user->name;
                }
                @endphp
                {{ $userName }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ url('/settings') }}">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
