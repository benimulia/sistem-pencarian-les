@extends('layouts.utama')

@section('content')
<!-- Page Header End -->
<div class="container-xxxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">Kategori</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item text-white">Kategori Kursus </li>
                <li class="breadcrumb-item text-white active" aria-current="page">Kursus {{ $breadcrumb_kategori }}</li>
                <li class="breadcrumb-item text-white active" aria-current="page">{{ $kategori->nama_kategori }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Classes Start -->
<div class="container-xxxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">{{ $kategori->nama_kategori }}</h1>
            <p>Berikut tempat kursus yang memiliki kategori {{ $kategori->nama_kategori }}.</p>
        </div>
        <div class="row g-4">
            @foreach ($tempatkursus as $index => $result)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('gambar/tempatkursus/foto-utama/' . $result->foto_utama) }}" alt="">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="{{ route('utama.tempatkursus', ['id' => $result->id_tempat_kursus]) }}">{{ $result->nama_tempat_kursus }}</a>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="ms-0">
                                    <h6 class="mb-1">
                                        @foreach ($result->kategori as $kategori)
                                        <span class="badge bg-primary">{{ $kategori->nama_kategori }}</span>
                                        @endforeach
                                    </h6>
                                </div>
                            </div>
                            {{-- <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span> --}}
                        </div>
                        <div class="row g-1">
                            <div class="col-4">
                                <div class="border-top border-3 border-primary pt-2">
                                    <h6 class="text-primary mb-1">Harga:</h6>
                                    <small>
                                        @if ($result->program->first())
                                        Start from Rp
                                        {{ number_format($result->program->first()->harga, 0, ',', '.') }}
                                        @else
                                        -
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-success pt-2">
                                    <h6 class="text-success mb-1">Jadwal:</h6>
                                    <small>
                                        @if ($result->program->first())
                                        {{ $result->program->first()->jadwal }}
                                        @else
                                        -
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top border-3 border-warning pt-2">
                                    <h6 class="text-warning mb-1">Durasi:</h6>
                                    <small>
                                        @if ($result->program->first())
                                        {{ $result->program->first()->durasi }}
                                        @else
                                        -
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Classes End -->
@endsection