@extends('layouts.utama')

@section('content')
    <!-- Page Header End -->
    <div class="container-xxxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">Tempat Kursus</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Kategori</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Classes Start -->
    <div class="container-xxxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">{{ $tempatkursus->nama_tempat_kursus }}</h1>
            </div>
            <div class="row justify-content-center g-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ $tempatkursus->nama_tempat_kursus }}</div>

                        <div class="card-body">
                            <p>{{ $tempatkursus->alamat }}</p>
                            <p>{{ $tempatkursus->no_telp }}</p>

                            <div id="map" style="height: 400px;"></div>

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
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
                            </script>

                            <img src="{{ asset('storage/' . $tempatkursus->foto_utama) }}"
                                alt="{{ $tempatkursus->nama_tempat_kursus }}" width="300" height="200">

                            <h4>Program yang tersedia:</h4>
                            <ul>
                                @foreach ($tempatkursus->program as $program)
                                    <li>
                                        <h5>{{ $program->nama_program }}</h5>
                                        <p>{{ $program->deskripsi_program }}</p>
                                        <img src="{{ asset('storage/' . $program->foto_program) }}"
                                            alt="{{ $program->nama_program }}" width="200" height="150">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Classes End -->
@endsection
