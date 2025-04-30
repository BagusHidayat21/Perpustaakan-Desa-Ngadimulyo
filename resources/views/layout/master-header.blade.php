<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Features</div>

    <!-- Buku Digital -->
    <li class="nav-item {{ Request::is('admin/buku-digital/*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDigitalBooks"
            aria-expanded="true" aria-controls="collapseDigitalBooks">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Buku Digital</span>
        </a>
        <div id="collapseDigitalBooks" class="collapse {{ Request::is('admin/buku-digital/*') ? 'show' : '' }}" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Buku Digital</h6>
                <a class="collapse-item {{ Request::is('admin/buku-digital/tambah') ? 'active' : '' }}" href="{{ route('buku.digital.tambah') }}">Tambah Buku Digital</a>
                <a class="collapse-item {{ Request::is('admin/buku-digital/daftar') ? 'active' : '' }}" href="{{ route('buku.digital.daftar') }}">Daftar Buku Digital</a>
                {{-- <a class="collapse-item {{ Request::is('admin/buku-digital/dibaca') ? 'active' : '' }}" href="{{ route('buku.digital.dibaca') }}">Daftar Sering Dibaca</a> --}}
                <a class="collapse-item {{ Request::is('admin/buku-digital/terfavorit') ? 'active' : '' }}" href="{{ route('buku.digital.terfavorit') }}">Daftar Terfavorit</a>
            </div>
        </div>
    </li>

    <!-- Buku Fisik -->
    <li class="nav-item {{ Request::is('admin/buku-fisik/*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePhysicBooks"
            aria-expanded="true" aria-controls="collapsePhysicBooks">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Buku Fisik</span>
        </a>
        <div id="collapsePhysicBooks" class="collapse {{ Request::is('admin/buku-fisik/*') ? 'show' : '' }}" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Buku Fisik</h6>
                <a class="collapse-item {{ Request::is('admin/buku-fisik/tambah') ? 'active' : '' }}" href="{{ route('buku.fisik.tambah') }}">Tambah Buku Fisik</a>
                <a class="collapse-item {{ Request::is('admin/buku-fisik/daftar') ? 'active' : '' }}" href="{{ route('buku.fisik.daftar') }}">Daftar Buku Fisik</a>
            </div>
        </div>
    </li>

    <!-- Agenda -->
    <li class="nav-item {{ Request::is('admin/agenda/*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgenda"
            aria-expanded="true" aria-controls="collapseAgenda">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Agenda</span>
        </a>
        <div id="collapseAgenda" class="collapse {{ Request::is('admin/agenda/*') ? 'show' : '' }}" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Agenda</h6>
                <a class="collapse-item {{ Request::is('admin/agenda/tambah') ? 'active' : '' }}" href="{{ route('agenda.tambah') }}">Tambah Agenda</a>
                <a class="collapse-item {{ Request::is('admin/agenda/daftar') ? 'active' : '' }}" href="{{ route('agenda.daftar') }}">Daftar Agenda</a>
            </div>
        </div>
    </li>

    <!-- Jenis Buku -->
    <li class="nav-item {{ Request::is('admin/jenis-buku') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('jenis.buku.daftar') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Daftar Jenis Buku</span>
        </a>
    </li>

    <!-- Saran dan Masukan -->
    <li class="nav-item {{ Request::is('admin/masukan/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('masukan.daftar') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Saran dan Masukan</span>
        </a>
    </li>

    <!-- Pengurs Perpus -->
    <li class="nav-item {{ Request::is('admin/pengurus/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengurus.daftar') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pengurus Perpustakaan</span>
        </a>
    </li>

    <!-- Kelola User -->
    <li class="nav-item {{ Request::is('admin/kelola-user') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kelola.user') }}">
            <i class="fas fa-fw fa-palette"></i>
            <span>Kelola User</span>
        </a>
    </li>
</ul>
<!-- Sidebar -->
