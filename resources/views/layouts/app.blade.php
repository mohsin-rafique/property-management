<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Property Manager') }} - @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563EB;
            --primary-hover: #1D4ED8;
            --primary-light: #EFF6FF;
            --secondary: #334155;
            --accent: #16A34A;
            --sidebar-bg: #1E293B;
            --sidebar-text: #94A3B8;
            --sidebar-active: #2563EB;
            --sidebar-hover: rgba(255, 255, 255, .06);
            --sidebar-section: rgba(148, 163, 184, .4);
            --body-bg: #F8FAFC;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, .08), 0 4px 6px -4px rgba(0, 0, 0, .04);
            --border-color: #E2E8F0;
            --text-primary: #1E293B;
            --text-secondary: #475569;
            --text-muted: #64748B;
            --accent: #16A34A;
            --accent-hover: #15803D;
            --accent-light: #DCFCE7;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--body-bg);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .sidebar-brand small {
            color: var(--sidebar-text);
            font-size: .75rem;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-section {
            padding: .5rem 1.5rem;
            font-size: .65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--sidebar-section);
            margin-top: .5rem;
        }

        .sidebar-nav .nav-link {
            color: var(--sidebar-text);
            padding: .6rem 1.5rem;
            font-size: .875rem;
            font-weight: 400;
            display: flex;
            align-items: center;
            gap: .75rem;
            border-radius: 0;
            transition: all .15s ease;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
            font-weight: 500;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 1.25rem;
            text-align: center;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: .75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-bar h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .content-area {
            padding: 2rem;
            flex: 1;
        }

        /* Cards */
        .card {
            border: 1px solid var(--border-color);
            border-radius: .75rem;
            box-shadow: var(--card-shadow);
            transition: box-shadow .2s ease;
        }

        .card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
            font-weight: 600;
            border-radius: .75rem .75rem 0 0 !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Responsive Tables */
        .card-body.p-0 {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 992px) {
            .card-body.p-0 .table {
                white-space: nowrap;
            }
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            border-radius: .5rem;
            font-weight: 500;
            padding: .5rem 1.25rem;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            border-radius: .5rem;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Tables */
        .table {
            font-size: .875rem;
        }

        .table thead th {
            background: var(--body-bg);
            font-weight: 600;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border-color);
            padding: .75rem 1rem;
        }

        .table td {
            padding: .75rem 1rem;
            vertical-align: middle;
            color: var(--secondary);
        }

        .table tbody tr:hover {
            background: var(--body-bg);
        }

        /* Forms */
        .form-control,
        .form-select {
            border-radius: .5rem;
            border-color: #CBD5E1;
            padding: .6rem .875rem;
            font-size: .875rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .15);
        }

        .form-label {
            font-weight: 500;
            font-size: .875rem;
            color: var(--text-secondary);
        }

        /* Badges */
        .badge-success {
            background: var(--accent-light);
            color: var(--accent);
            font-weight: 500;
        }

        .badge-warning {
            background: #FEF3C7;
            color: #92400E;
            font-weight: 500;
        }

        .badge-danger {
            background: #FEE2E2;
            color: #991B1B;
            font-weight: 500;
        }

        .badge-info {
            background: var(--primary-light);
            color: #1E40AF;
            font-weight: 500;
        }

        /* Stats cards */
        .stat-card {
            border-radius: .75rem;
            padding: 1.5rem;
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: .75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-card .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-card .stat-label {
            font-size: .8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Alert */
        .alert {
            border-radius: .5rem;
            font-size: .875rem;
            border: none;
        }

        .alert-success {
            background: var(--accent-light);
            color: #166534;
            border-left: 4px solid var(--accent);
        }

        .alert-danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* Auth pages (no sidebar) */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 50%, #1E40AF 100%);
        }

        .auth-card {
            background: #fff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25);
            width: 100%;
            max-width: 440px;
        }

        .auth-card .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-card .auth-logo h3 {
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: .25rem;
        }

        .auth-card .auth-logo p {
            color: var(--text-muted);
            font-size: .875rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            z-index: 999;
        }

        .sidebar.show+.sidebar-overlay {
            display: block;
        }

        /* User dropdown */
        .user-menu .dropdown-toggle::after {
            display: none;
        }

        .user-menu .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: .5rem;
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: .875rem;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: .8rem;
        }

        /* Accent Button (for money/payment actions) */
        .btn-accent {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            border-radius: .5rem;
            font-weight: 500;
            padding: .5rem 1.25rem;
        }

        .btn-accent:hover {
            background: var(--accent-hover);
            border-color: var(--accent-hover);
            color: #fff;
        }

        .btn-outline-accent {
            color: var(--accent);
            border-color: var(--accent);
            border-radius: .5rem;
        }

        .btn-outline-accent:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
    </style>
    @stack('styles')
</head>

<body>
    @auth
    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand d-flex justify-content-between align-items-start">
            <div>
                <h4><i class="bi bi-building"></i> Property Manager</h4>
                <small>Receipt Management System</small>
            </div>
            <button class="btn btn-link d-md-none p-0 text-white" onclick="document.getElementById('sidebar').classList.remove('show')" style="font-size: 1.25rem; opacity: .7;">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <nav class="sidebar-nav">
            @if(auth()->user()->isTenant())
            {{-- TENANT SIDEBAR --}}
            <a href="{{ route('tenant.dashboard') }}" class="nav-link {{ request()->is('my/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> My Dashboard
            </a>

            <div class="nav-section">My Receipts</div>
            <a href="{{ route('tenant.rent-receipts') }}" class="nav-link {{ request()->is('my/rent-receipts*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Rent Receipts
            </a>
            <a href="{{ route('tenant.maintenance-receipts') }}" class="nav-link {{ request()->is('my/maintenance-receipts*') ? 'active' : '' }}">
                <i class="bi bi-tools"></i> Maintenance Bills
            </a>
            <a href="{{ route('tenant.electricity-receipts') }}" class="nav-link {{ request()->is('my/electricity-receipts*') ? 'active' : '' }}">
                <i class="bi bi-lightning-charge"></i> Electricity Bills
            </a>
            <a href="{{ route('tenant.security-deposit') }}" class="nav-link {{ request()->is('my/security-deposit*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i> Security Deposit
            </a>
            @else
            {{-- ADMIN / OWNER SIDEBAR --}}
            <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            @if(auth()->user()->isAdmin())
            <div class="nav-section">Management</div>
            <a href="{{ route('owners.index') }}" class="nav-link {{ request()->is('owners*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Owners
            </a>
            <a href="{{ route('tenants.index') }}" class="nav-link {{ request()->is('tenants*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Tenants
            </a>
            <a href="{{ route('properties.index') }}" class="nav-link {{ request()->is('properties*') ? 'active' : '' }}">
                <i class="bi bi-houses"></i> Properties
            </a>

            <div class="nav-section">Administration</div>
            <a href="{{ route('register') }}" class="nav-link {{ request()->is('register') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i> Register Admin
            </a>
            @endif

            <div class="nav-section">Receipts</div>
            <a href="{{ route('rent-receipts.index') }}" class="nav-link {{ request()->is('rent-receipts*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Rent Receipts
            </a>
            <a href="{{ route('maintenance-receipts.index') }}" class="nav-link {{ request()->is('maintenance-receipts*') ? 'active' : '' }}">
                <i class="bi bi-tools"></i> Maintenance Bills
            </a>
            <a href="{{ route('electricity-receipts.index') }}" class="nav-link {{ request()->is('electricity-receipts*') ? 'active' : '' }}">
                <i class="bi bi-lightning-charge"></i> Electricity Bills
            </a>
            <a href="{{ route('security-deposits.index') }}" class="nav-link {{ request()->is('security-deposits*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i> Security Deposits
            </a>
            @endif
        </nav>
    </aside>

    {{-- Mobile Sidebar Overlay --}}
    <div class="sidebar-overlay d-md-none" id="sidebarOverlay" onclick="document.getElementById('sidebar').classList.remove('show'); this.classList.remove('show');"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <div class="top-bar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link d-md-none p-0 text-dark" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h5>@yield('title', 'Dashboard')</h5>
            </div>
            <div class="dropdown user-menu">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    {{ auth()->user()->name }}
                    <i class="bi bi-chevron-down" style="font-size:.7rem"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->email }}</span></li>
                    <li><span class="dropdown-item-text"><span class="badge badge-info">{{ ucfirst(auth()->user()->role ?? 'user') }}</span></span></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="bi bi-person-gear me-2"></i>Profile Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-area">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>

        {{-- Footer --}}
        <footer style="background: #fff; border-top: 1px solid #e2e8f0; padding: 1rem 2rem;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2" style="font-size: .8rem; color: #94a3b8;">
                <div>
                    &copy; {{ date('Y') }} <strong style="color: #475569;">{{ config('app.name', 'Property Manager') }}</strong>.
                    Open Source under
                    <a href="https://github.com/mohsin-rafique/property-management/blob/main/LICENSE" target="_blank" style="color: #2563EB; text-decoration: none;">MIT License</a>.
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="https://github.com/mohsin-rafique/property-management" target="_blank" style="color: #475569; text-decoration: none; font-weight: 500;">
                        <i class="bi bi-github me-1"></i>GitHub
                    </a>
                    <a href="{{ route('about') }}" style="color: #475569; text-decoration: none; font-weight: 500;">
                        <i class="bi bi-info-circle me-1"></i>About
                    </a>
                </div>
            </div>
        </footer>
    </div>
    @else
    @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
