<!-- Sidebar untuk layar besar -->
<aside class="sidebar d-none d-lg-block">
    <h5 class="navbar-brand">Toko Online</h5>
    <ul class="navbar-nav flex-column px-2 gap-2">
        <li class="navbar-item rounded {{ Request::path() == 'admin/dashboard' ? 'bg-info' : '' }}">
            <a href="dashboard" class="nav-link ps-3">
                <div class="d-flex gap-3">
                    <span class="material-icons">dashboard</span>
                    <p class="m-0 p0"> Dashboard</p>
                </div>
            </a>
        </li>
        <li class="navbar-item rounded {{ Request::path() == 'admin/product' ? 'bg-info' : '' }}">
            <a href="product" class="nav-link ps-3">
                <div class="d-flex gap-3">
                    <span class="material-icons">inventory</span>
                    <p class="m-0 p0"> Product</p>
                </div>
            </a>
        </li>
        <li class="navbar-item rounded {{ Request::path() == 'admin/user_management' ? 'bg-info' : '' }}">
            <a href="user_management" class="nav-link ps-3">
                <div class="d-flex gap-3">
                    <span class="material-icons">people_alt</span>
                    <p class="m-0 p0"> User Management</p>
                </div>
            </a>
        </li>
        <li class="navbar-item rounded {{ Request::path() == 'admin/report' ? 'bg-info' : '' }}">
            <a href="report" class="nav-link ps-3">
                <div class="d-flex gap-3">
                    <span class="material-icons">analytics</span>
                    <p class="m-0 p0"> Report</p>
                </div>
            </a>
        </li>
        <li class="navbar-item">
            <a href="logout" class="nav-link ps-3">
                <div class="d-flex gap-3">
                    <span class="material-icons">logout</span>
                    <p class="m-0 p0"> Logout</p>
                </div>
            </a>
        </li>
    </ul>
</aside>

<!-- Offcanvas Sidebar untuk layar kecil -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarOffcanvas"
    aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Toko Online</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav flex-column px-2 gap-2">
            <li class="navbar-item rounded {{ Request::path() == 'admin/dashboard' ? 'bg-info' : '' }}">
                <a href="dashboard" class="nav-link text-white">
                    <div class="d-flex gap-3">
                        <span class="material-icons">dashboard</span>
                        <p class="m-0 p0"> Dashboard</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item rounded {{ Request::path() == 'admin/product' ? 'bg-info' : '' }}">
                <a href="product" class="nav-link text-white">
                    <div class="d-flex gap-3">
                        <span class="material-icons">inventory</span>
                        <p class="m-0 p0"> Product</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item rounded {{ Request::path() == 'admin/user_management' ? 'bg-info' : '' }}">
                <a href="user_management" class="nav-link text-white">
                    <div class="d-flex gap-3">
                        <span class="material-icons">people_alt</span>
                        <p class="m-0 p0"> User Management</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item rounded {{ Request::path() == 'admin/report' ? 'bg-info' : '' }}">
                <a href="report" class="nav-link text-white">
                    <div class="d-flex gap-3">
                        <span class="material-icons">analytics</span>
                        <p class="m-0 p0"> Report</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item">
                <a href="logout" class="nav-link text-white">
                    <div class="d-flex gap-3">
                        <span class="material-icons">logout</span>
                        <p class="m-0 p0"> Logout</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
