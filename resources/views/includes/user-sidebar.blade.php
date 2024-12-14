<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="index.html">
                        Nama-Toko
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('user.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('product.dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('product.dashboard') }}" class='sidebar-link'>
                        <i class="fa-solid fa-box"></i>
                        <span>Product</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('user.dashboard') }}" class='sidebar-link'>
                        <i class="fa-solid fa-truck"></i>
                        <span>Order</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('user.dashboard') }}" class='sidebar-link'>
                        <i class="fa-solid fa-desktop"></i>
                        <span>Page</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('user.dashboard') }}" class='sidebar-link'>
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Statistic</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
