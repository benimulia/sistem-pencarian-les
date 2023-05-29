@extends('layouts.utama')

@section('content')
    <!-- Page Header End -->
    <div class="container-xxxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">{{ $tempatkursus->nama_tempat_kursus }}</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-xxxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-3"
                                src="{{ asset('gambar/tempatkursus/foto-utama/' . $tempatkursus->foto_utama) }}"
                                alt="" style="width: 100%; aspect-ratio: 3/2; object-fit:contain;">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row">
                        {{-- <h1 class="mb-4">Tentang</h1> --}}
                        <div class="col-6 wow fadeInUp" data-wow-delay="0.1s">
                            <p><i class="fas fa-cogs"></i> Program : <span
                                    style="color: brown">{{ $tempatkursus->program->count() }}</span></p>
                            <p class="mb-4"><i class="fas fa-map-marked-alt"></i> Alamat : <span
                                    style="color: brown">{{ $tempatkursus->alamat }}</span></p>
                            <p class="mb-4"><i class="fas fa-phone"></i> Telp : <span
                                    style="color: brown">{{ $tempatkursus->no_telp }}</span></p>
                        </div>
                        <div class="col-6 wow fadeInUp" data-wow-delay="0.1s">
                            <p class="mb-4"><i class="fab fa-instagram"></i> Instagram : <span
                                    style="color: brown">{{ $tempatkursus->instagram }}</span></p>
                            <p class="mb-4"><i class="fab fa-facebook"></i> Facebook : <span
                                    style="color: brown">{{ $tempatkursus->facebook }}</span></p>
                            <p class="mb-4"><i class="fas fa-user-friends"></i></i> Pengunjung : <span
                                    style="color: brown">{{ $tempatkursus->jumlah_pengunjung }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5 align-items-center mt-4">
                <div class="wow fadeInUp" id="map" style="height: 400px;"></div>

                <script>
                    function initMap() {
                        var location = {
                            lat: {{ $tempatkursus->latitude }},
                            lng: {{ $tempatkursus->longitude }}
                        };
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 15,
                            center: location
                        });
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map,
                            title: '{{ $tempatkursus->nama_tempat_kursus }}'
                        });
                    }
                </script>
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
            </div>

            <div class="row g-5 align-items-center mt-4" style="background-color: #F5F5F5">
                <h4 class="mb-4">Kamu mungkin tertarik </h4>
                <div class="col-md-12">
                    <div id="div1" class="row">
                        @if ($tempatkursus->program->count() > 0)
                            @foreach ($tempatkursus->program as $program)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-img-top content-ratio"
                                            style="background-image: url('{{ asset('gambar/tempatkursus/foto-program/' . $program->foto_program) }}');">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $program->nama_program }}</h4>
                                            <p class="card-text">{{ $program->deskripsi_program }}</p>
                                            <p class="card-text">Harga : <span
                                                    class="badge rounded-pill bg-success text-white ">Rp
                                                    {{ number_format($program->harga, 0, ',', '.') }}</span></p>
                                            <p class="card-text">Jadwal : <span
                                                    class="badge rounded-pill bg-success text-white ">{{ $program->jadwal }}</span>
                                            </p>
                                            <p class="card-text">Durasi : <span
                                                    class="badge rounded-pill bg-success text-white ">{{ $program->durasi }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Data program tidak ditemukan. </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
