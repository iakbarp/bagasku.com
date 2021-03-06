<ul class="sidebar-menu">
    <li class="menu-header">General</li>
    <li class="dropdown {{\Illuminate\Support\Facades\Request::is('sys-admin/dashboard*') ? 'active' : ''}}">
        <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
        </a>
    </li>

    <li class="menu-header">Data Pembayaran</li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-money-bill"></i><span>Jenis Pembayaran</span></a>
        <ul class="dropdown-menu">
            <li class=""><a href="{{route('admin.project.show')}}" class="nav-link">Proyek</a></li>
            <li class=""><a href="{{route('admin.service.show')}}" class="nav-link">Layanan</a></li>
        </ul>
    </li>

    <li class="menu-header">Data Master</li>

    <li class="dropdown">
        <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-briefcase"></i><span>Proyek & Layanan</span></a>
        <ul class="dropdown-menu">
            <li class=""><a href="{{route('admin.show.project')}}" class="nav-link">Proyek</a></li>
            <li class=""><a href="{{route('admin.show.service')}}" class="nav-link">Layanan</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-users"></i><span>Akun</span></a>
        <ul class="dropdown-menu">
            <li class=""><a href="{{route('admin.show.admin')}}" class="nav-link">Admin</a></li>
            <li class=""><a href="{{route('admin.show.user')}}" class="nav-link">User</a></li>
            <li class=""><a href="{{route('admin.settings')}}" class="nav-link">Pengaturan</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-database"></i><span>Lokasi</span></a>
        <ul class="dropdown-menu">
            <li class=""><a href="{{route('admin.show.negara')}}" class="nav-link">Negara & Provinsi</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-database"></i><span>Master Kategori</span></a>
        <ul class="dropdown-menu">
            <li class=""><a href="{{route('admin.show.kategori')}}" class="nav-link">Kategori & Sub-kategori</a></li>
        </ul>
    </li>
</ul>

<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="{{route('beranda')}}" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> GO TO MAIN SITE</a>
</div>
