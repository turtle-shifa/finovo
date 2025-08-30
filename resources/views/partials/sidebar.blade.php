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

    .sidebar .nav-link,
    .sidebar .dropdown-toggle {
        color: #333;
        font-weight: 500;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 4px;
        display: flex;
        justify-content: space-between; /* for arrow alignment */
        align-items: center;
        cursor: pointer;
    }

    .sidebar .nav-link:hover,
    .sidebar .dropdown-item:hover {
        background-color: #C8EE44;
        color: black;
    }

    .sidebar .nav-link.active,
    .sidebar .dropdown-item.active {
        background-color: #C8EE44;
        color: black;
        font-weight: 600;
    }

    .sidebar .dropdown-menu {
        position: static;      
        display: none;         
        padding-left: 0.5rem;  
        margin-bottom: 4px;  
        border: none;
        box-shadow: none;
    }

    .sidebar .dropdown-menu.show {
        display: block;
    }

    .sidebar .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        color: #333;
        font-weight: 500;
    }

    .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    .fw-semi {
        font-weight: 600;
    }
</style>

<div class="col-2 sidebar d-flex flex-column p-3">

    <div class="mb-4 text-center">
        <a href="/dashboard">
            <img src="/logo.png" alt="Logo" style="height: 40px;">
        </a>
    </div>

    <!-- Menu -->
    <nav class="nav flex-column">
        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active text-success' : '' }}">
            Dashboard
        </a>

        <!-- Inventory Dropdown -->
        @php
            $inventoryActive = request()->is('inbound') || request()->is('outbound*') || request()->is('product*') || request()->is('category*') || request()->is('stock*') || request()->is('return*');
        @endphp
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ $inventoryActive ? 'active text-success' : '' }}" onclick="this.nextElementSibling.classList.toggle('show')">
                Manage Inventory
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item {{ request()->is('category*') ? 'active text-success' : '' }}" href="{{ url('/category') }}">
                        Category
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->is('product*') ? 'active text-success' : '' }}" href="{{ url('/product') }}">
                        Product
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->is('stock*') ? 'active text-success' : '' }}" href="{{ url('/stocks') }}">
                        Stocks
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->is('inbound') ? 'active text-success' : '' }}" href="{{ url('/inbound') }}">
                        Inbound (Purchase)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->is('outbound*') ? 'active text-success' : '' }}" href="{{ url('/outbound') }}">
                        Outbound
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->is('return*') ? 'active text-success' : '' }}" href="{{ url('/return') }}">
                        Return Logistics
                    </a>
                </li>
            </ul>
        </div>


        <a href="{{ url('/generate-invoice') }}" class="nav-link {{ request()->is('generate-invoice') ? 'active text-success' : '' }}">
            Generate Invoice
        </a>


        <a href="{{ url('/transactions') }}" class="nav-link {{ request()->is('transactions') ? 'active text-success' : '' }}">
            Transactions
        </a>

        <a href="{{ url('/opex/create') }}" class="nav-link {{ request()->is('opex*') ? 'active text-success' : '' }}">
            Add OPEX
        </a>


        <a href="{{ url('/settings') }}" class="nav-link {{ request()->is('settings') ? 'active text-success' : '' }}">
            Settings
        </a>

        <!-- Logout -->
        <a href="{{ url('/logout') }}" class="nav-link text-danger">
            Logout
        </a>
    </nav>
</div>