<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            {{-- Tombol Home --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="home" class="align-text-bottom"></span>
                Home
                </a>
            </li>
            {{-- Tombol Daftar Menu --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/menu*') ? 'active' : '' }}" href="/dashboard/menu">
                <span data-feather="layers" class="align-text-bottom"></span>
                Daftar Menu Makanan
                </a>
            </li>
            {{-- Tombol Daftar Pesaanan --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/pesanan*') ? 'active' : '' }}" href="/dashboard/pesanan">
                <span data-feather="columns" class="align-text-bottom"></span>
                Daftar Pesanan
                </a>
            </li>
            @can('admin')
                {{-- Batas Administrator--}}
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-0 text-muted">
                    <span>Adminstrator</span>
                </h6>
                {{-- Users (Just Admin) --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Daftar Users
                    </a>
                </li>
                {{-- Riwayat Transaksi (Just Admin) --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/transaksi*') ? 'active' : '' }}" href="/dashboard/transaksi">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Riwayat Transaksi
                    </a>
                </li>
            @endcan
            {{-- Batas --}}
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-0 text-muted">
                <span>Akun</span>
            </h6>
            {{-- Ubah Detail User --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}" href="/dashboard/user">
                <span data-feather="user" class="align-text-bottom"></span>
                Update Profil
                </a>
            </li>
            {{-- Tombol Logout --}}
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-light text-start" style="width: 99%">
                        <span data-feather="log-out" class="align-text-bottom"></span> Log-out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>