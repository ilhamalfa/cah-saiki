<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Logo -->
    <a href="/dashboard" class="brand-link">
        <span class="brand-text font-weight-bold" ><img src="{{asset('style2/docs/assets/img/Logo.png')}}" class="d-inline-block align-text-top" style="height: 35px; margin-left: 15px"></span>
        
    {{-- <img src="{{asset('style/img/Logo.png')}}  " alt="" width="115" height="34" class="d-inline-block align-text-top "> --}}
    {{-- <span class="brand-text font-weight-bold" > Cahsaiki</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        {{-- <img src="{{asset('style2/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info font-weight-bold">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" >
                    <i class="nav-icon fas fa-tachometer-alt" ></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item {{ Request::is('dashboard/pesanan*')||Request::is('dashboard/menu*')  ? 'menu-open' : '' }}" >

                <a href="#" class="nav-link {{ Request::is('dashboard/pesanan*')||Request::is('dashboard/menu*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Menu<i class="right fas fa-angle-left"></i></p>
                </a>

                <ul class="nav nav-treeview">
                    {{-- Daftar Pesanan --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/pesanan*') ? 'active' : '' }}" href="/dashboard/pesanan">
                            <i class="nav-icon fas fa-book" data-feather="layers"></i>
                            <p>Daftar Pesanan</p>
                        </a>
                    </li>
                    {{-- Daftar Menu --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/menu*') ? 'active' : '' }}" href="/dashboard/menu">
                            <i class="nav-icon fas fa-book" data-feather="columns"></i>
                            <p>Daftar Menu</p>
                        </a>
                    </li>
                </ul>
            </li>

            @can('admin')
            {{-- Batas ADMIN --}}
            <li class="nav-item {{ Request::is('dashboard/users*')||Request::is('dashboard/riwayat*')  ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('dashboard/users*')||Request::is('dashboard/riwayat*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p> Administrator <i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">

                    {{-- Daftar Users --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                            <i class="far fa-circle nav-icon" data-feather="users"></i>
                            <p>Daftar Users</p>
                            </a>
                    </li>

                    {{-- Riwayat Transaksi --}}
                    <li class="nav-item">
                        <a href="/dashboard/riwayat" class="nav-link {{ Request::is('dashboard/riwayat*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon" data-feather="file-text"></i>
                            <p>Riwayat Transaksi</p>
                        </a>
                    </li>

                    {{-- Laporan Penjualan --}}
                    {{-- <li class="nav-item">
                        <a href="/dashboard/laporan" class="nav-link {{ Request::is('dashboard/laporan*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon" data-feather="file-text"></i>
                            <p>Laporan Penjualan</p>
                        </a>
                    </li> --}}
                    
                </ul>
            </li>
            @endcan

            {{-- Profile --}}
            <li class="nav-item {{ Request::is('dashboard/user') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p> Profile <i class="fas fa-angle-left right"></i> </p>
                </a>
                
                <ul class="nav nav-treeview">

                    {{-- Update --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}" href="/dashboard/user">
                            <i class="far fa-circle nav-icon" data-feather="user"></i>
                            <p>Update Profil</p>
                        </a>
                    </li>

                    {{-- Log out --}}
                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-dark col-xs-11 text-left">
                                <i class="far fa-circle nav-icon" data-feather="log-out"></i>
                                <p>Log-out</p>
                            </button>
                        </form>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
    </div>
</aside>