<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
    <a href="/" class="navbar-brand">
        <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>SIPTKA</h1>
        <small style="font-size: .675em">Sistem Informasi Pencarian Tempat Kursus Anak</small>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            @if (isset($kategoriutama))
            @foreach ($kategoriutama as $kategori)
            <div class="nav-item {{ request()->is('kategori*') ? 'active' : '' }} dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ $kategori->nama_kategori_utama }}</a>
                <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                    <div class="horizontal-categories">
                        @foreach ($kategori->kategoribesar as $kategoribesar)
                        <div class="category-group">
                            <a href="#" class="dropdown-item fw-bold">{{ $kategoribesar->nama_kategori_besar }}</a>
                            @foreach ($kategoribesar->kategori as $subCategory)
                            <a href="/kategori/{{ $subCategory->id_kategori }}" class="dropdown-item sub-category">
                                <span>{{ $subCategory->nama_kategori }}</span>
                            </a>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            <a href="{{ route('utama.contact') }}" class="nav-item nav-link {{ request()->is('kontak*') ? 'active' : '' }}">Kontak</a>
            <a href="{{ route('utama.about') }}" class="nav-item nav-link {{ request()->is('tentang*') ? 'active' : '' }}">Tentang</a>
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
        </div>
        <form action="{{ route('utama.search') }}" method="GET" class="d-flex" style="display:none">
            <input type="text" name="query" class="form-control me-2" placeholder="">
            <button class="btn btn-primary rounded-pill px-3" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</nav>
<!-- Navbar End -->