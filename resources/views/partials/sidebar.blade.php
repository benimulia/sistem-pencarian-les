<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-10">
            <i class="fa fa-book-reader me-3"></i>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ request()->is('admin/home*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @can('kategori-list')
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item {{ request()->is('kategori*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-window-restore"></i>
            <span>Kategori</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Kategori:</h6>
                <a class="collapse-item" href="{{ route('kategoriutama.index') }}">Kategori Utama</a>
                <a class="collapse-item" href="{{ route('kategoribesar.index') }}">Kategori Besar</a>
                <a class="collapse-item" href="{{ route('kategori.index') }}">Kategori</a>
            </div>
        </div>
    </li>
    @endcan


    @can('tempat-kursus-list')
    <li class="nav-item {{ request()->is('admin/tempatkursus*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tempatkursus.index') }}">
            <i class="fas fa-fw fa-school"></i>
            <span>Tempat Kursus</span>
        </a>
    </li>
    @endcan

    @can('program-list')
    <li class="nav-item {{ request()->is('admin/program*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('program.index') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Program Kursus</span>
        </a>
    </li>
    @endcan



    {{-- @can(['role-list', 'user-list', 'cabang-list']) --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item {{ request()->is('setting*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kelola Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengaturan Menu</h6>
                @can('role-list')
                <a class="collapse-item" href="{{ route('roles.index') }}">Kelola Role</a>
                @endcan
                @can('user-list')
                <a class="collapse-item" href="{{ route('users.index') }}">Kelola Pengguna</a>
                @endcan
                @can('cabang-list')
                <a class="collapse-item" href="{{ route('cabang.index') }}">Cabang</a>
                @endcan
                {{--
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a> --}}
            </div>
        </div>
    </li>
    {{-- @endcan --}}
    <!-- Logout Modal-->
    {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </div>
    </div>
    </div>
    </div> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->