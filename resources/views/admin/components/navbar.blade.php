<nav class="bg-white mb-3 d-flex justify-content-between align-items-center p-3 rounded">
    <!-- Tombol toggle offcanvas (mobile only) -->
    <button class="btn btn-outline-dark d-lg-none me-3" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Breadcrumb dan judul -->
    <div class="d-flex flex-column">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active"><a href="#">{{ $name }}</a></li>
        </ol>
        <span>{{ $name }}</span>
    </div>

    <!-- Notifikasi dan user profile -->
    <div class="d-flex align-items-center gap-3">
        <span class="material-icons">notifications</span>
        <div class="d-flex gap-2" >
            <img src="{{ asset('storage/user/' . Auth::user()->foto) }}" class="rounded-circle"
            style="width: 50px; height: 50px; object-fit: cover;" alt="User">
            <div class="d-flex flex-column">
                <p class="m-0 fw-bold" >{{Auth::user()->name}}</p>
                <p class="m-0 fs-7">{{Auth::user()->email}}</p>
            </div>
        </div>
    </div>
</nav>
