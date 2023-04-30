<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
    <a href="/" class="navbar-brand">
        <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Kider</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <div class="nav-item {{ request()->is('kategori*') ? 'active' : '' }} dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kategori</a>
                <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                    @if (isset($kategori))
                        @foreach ($kategori as $result)
                            <a href="/kategori/{{ $result->id_kategori }}"
                                class="dropdown-item">{{ $result->nama_kategori }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="{{route ('utama.search')}}" class="nav-item nav-link">Cari Tempat Kursus</a>
            <a href="contact.html" class="nav-item nav-link">Maps</a>
            <a href="about.html" class="nav-item nav-link">Tentang Kider</a>
        </div>
        <form action="{{route ('utama.search')}}" method="GET" class="d-flex" style="display:none">
            <input type="text" name="query" class="form-control me-2" placeholder="">
            <button class="btn btn-primary rounded-pill px-3" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</nav>
<!-- Navbar End -->
