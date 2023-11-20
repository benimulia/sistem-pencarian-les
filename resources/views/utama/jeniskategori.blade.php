@extends('layouts.utama')

@section('content')
<!-- Page Header End -->
<div class="container-xxxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">Kategori Kursus</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Kategori Kursus</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Classes Start -->
<div class="container-xxxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Kategori kursus {{ $namajeniskategori }}</h1>
            <p>Berikut tempat kursus yang memiliki kategori {{ $namajeniskategori }}.</p>
        </div>
        <div class="row g-4">
            @foreach ($jeniskategori as $index => $result)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('utama.kategori', ['id' => $result->id_kategori]) }}">
                    <div class="team-item position-relative">
                        <div class="team-text p-4 text-center">
                            <h3>{{ $result->nama_kategori }}</h3>
                            <div class="d-flex align-items-center"></div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Classes End -->
@endsection