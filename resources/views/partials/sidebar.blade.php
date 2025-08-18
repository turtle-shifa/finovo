<style>
    body {
        font-family: 'Kumbh Sans', sans-serif;
        background-color: #f8f9fa;
    }

    /* Sidebar container */
    .sidebar {
        background-color: white;
        min-height: 100vh;
        border-right: 1px solid #e9ecef;
        position: sticky;
        top: 0;
    }

    /* Sidebar links */
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

    /* Hover effect for all sidebar links */
    .sidebar .nav-link:hover,
    .sidebar .dropdown-item:hover {
        background-color: #C8EE44;
        color: black;
    }

    /* Active state for sidebar links */
    .sidebar .nav-link.active,
    .sidebar .dropdown-item.active {
        background-color: #C8EE44;
        color: black;
        font-weight: 600;
    }

    /* Dropdown menu - accordion style */
    .sidebar .dropdown-menu {
        position: static;      /* part of normal flow */
        display: none;         /* hidden by default */
        padding-left: 0.5rem;  /* optional indent */
        margin-bottom: 4px;    /* spacing below */
        border: none;
        box-shadow: none;
    }

    .sidebar .dropdown-menu.show {
        display: block;        /* visible when active */
    }

    .sidebar .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        color: #333;
        font-weight: 500;
    }

    /* arrow spacing */
    .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    .fw-semi {
        font-weight: 600;
    }
</style>

<div class="col-2 sidebar d-flex flex-column p-3">
    <!-- Logo -->
    <div class="mb-4 text-center">
        <img src="/logo.png" alt="Logo" style="height: 40px;">
    </div>

    <!-- Menu -->
    <nav class="nav flex-column">
        <!-- Dashboard -->
        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active text-success' : '' }}">
            Dashboard
        </a>

        <!-- Inventory Dropdown -->
        @php
            $inventoryActive = request()->is('inbound') || request()->is('inventory/outbound') || request()->is('product*') || request()->is('category*') || request()->is('stock*');
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
                    <a class="dropdown-item {{ request()->is('inventory/outbound') ? 'active text-success' : '' }}" href="{{ url('/inventory/outbound') }}">
                        Outbound
                    </a>
                </li>
            </ul>
        </div>

        <!-- Generate Invoice -->
        <a href="{{ url('/generate-invoice') }}" class="nav-link {{ request()->is('generate-invoice') ? 'active text-success' : '' }}">
            Generate Invoice
        </a>

        <!-- Transactions -->
        <a href="{{ url('/transactions') }}" class="nav-link {{ request()->is('transactions') ? 'active text-success' : '' }}">
            Transactions
        </a>

        <!-- Settings -->
        <a href="{{ url('/settings') }}" class="nav-link {{ request()->is('settings') ? 'active text-success' : '' }}">
            Settings
        </a>

        <!-- Help -->
        <a href="{{ url('/help') }}" class="nav-link {{ request()->is('help') ? 'active text-success' : '' }}">
            Help
        </a>

        <!-- Logout -->
        <a href="{{ url('/logout') }}" class="nav-link text-danger">
            Logout
        </a>
    </nav>
</div>