<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-utensils"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pujas Delivery</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen
    </div>

    <!-- Nav Item - Tenant -->
    <li class="nav-item {{ Request::routeIs('tenant.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tenant.index') }}">
            <i class="fas fa-fw fa-store"></i>
            <span>Tenant</span></a>
    </li>

    <!-- Nav Item - Menu -->
    <li class="nav-item {{ Request::routeIs('menu.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('menu.index') }}">
            <i class="fas fa-fw fa-hamburger"></i>
            <span>Menu</span>
        </a>
    </li>

    <!-- Nav Item - Orders -->
    <li class="nav-item {{ Request::routeIs('transaction.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('transaction.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item {{ Request::routeIs('users.*') ? 'active' : '' }}">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Sales Report -->
    <li class="nav-item {{ Request::routeIs('reports.*') ? 'active' : '' }}">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan Penjualan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>