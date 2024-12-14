<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="index.html">
                        Dodolan
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs(['admin.store.index', 'admin.store.show', 'admin.product.create', 'admin.product.edit', 'admin.product.show', 'admin.store.edit']) ? 'active' : '' }} ">
                    <a href="{{ route('admin.store.index') }}" class='sidebar-link'>
                        <i class="bi bi-shop"></i>
                        <span>Toko</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
