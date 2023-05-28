<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
    <a href="/" class="navbar-brand">
        <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Kursusku</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <div class="nav-item {{ request()->is('kategori*') ? 'active' : '' }} dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kategori</a>
                <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                    @if (isset($kategoribesar))
                        @foreach ($kategoribesar as $result)
                            <a href="#"
                                class="dropdown-item fw-bold">{{ $result->nama_kategori_besar }}</a>
                            @foreach ($result->kategori as $subCategory)
                            <a href="/kategori/{{ $subCategory->id_kategori }}"
                                class="dropdown-item"><span style="padding-left: 10px;">{{ $subCategory->nama_kategori }}</a>
                            @endforeach
                            
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="{{ route('utama.search') }}"
                class="nav-item nav-link {{ request()->is('search*') ? 'active' : '' }}">Cari Tempat Kursus</a>
            <a href="{{ route('utama.contact') }}"
                class="nav-item nav-link {{ request()->is('kontak*') ? 'active' : '' }}">Contact Us</a>
            <a href="{{ route('utama.about') }}"
                class="nav-item nav-link {{ request()->is('tentang*') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
        </div>
        <form action="{{ route('utama.search') }}" method="GET" class="d-flex" style="display:none">
            <input type="text" name="query" class="form-control me-2" placeholder="">
            <button class="btn btn-primary rounded-pill px-3" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</nav>
<!-- Navbar End -->
