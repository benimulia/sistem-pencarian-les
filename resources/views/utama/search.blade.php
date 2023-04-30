@extends('layouts.utama')

@section('head-script')
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD-vdSB4GHjLFmlr5HNHvOhHU1UrmDs7Js"></script>
    <script>
        // variabel global marker
        var markers = [];

        function taruhMarker(peta, posisiTitik, namaTempat, alamatTempat) {
            var marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta,
            });

            // tambahkan marker ke array markers
            markers.push(marker);

            // tambahkan InfoWindow untuk menampilkan informasi tambahan
            var infoWindow = new google.maps.InfoWindow({
                content: '<h3>' + namaTempat + '</h3>' + '<p>' + alamatTempat + '</p>'
            });

            // tambahkan event listener untuk menampilkan InfoWindow saat marker diklik
            marker.addListener('click', function() {
                infoWindow.open(peta, marker);
            });
        }


        function initialize() {
            var propertiPeta = {
                center: new google.maps.LatLng(-7.785996142593305, 110.37836496578073),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

            // buat marker untuk setiap lokasi pada $tempat_kursus
            @foreach ($tempat_kursus as $kursus)
                var posisiTitik = new google.maps.LatLng({{ $kursus->latitude }}, {{ $kursus->longitude }});
                taruhMarker(peta, posisiTitik, '{{ $kursus->nama_tempat_kursus }}', '{{ $kursus->alamat }}');
            @endforeach

        }


        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection


@section('content')
    <!-- Page Header End -->
    <div class="container-xxxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">Cari Tempat Kursus</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Cari Tempat Kursus</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Classes Start -->
    <div class="container-xxxl py-5">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-md-3">
                    <form action="{{ route('utama.search') }}" method="GET">


                        <ul class="list-group mb-4 ms-4">
                            <div class="input-group">
                                <input type="text" name="query" id="querysearch" class="form-control mb-4"
                                    placeholder="masukkan kata kunci" value="{{ $query }}">
                                <button id="clear-input" type="button" class="btn bg-transparent"
                                    style="margin-left: -40px; z-index: 100; margin-bottom:20px; outline: none;box-shadow: none;">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>



                            <li class="list-group-item active">Lokasi</li>
                            <label>
                                <li class="list-group-item">
                                    <input type="checkbox" name="lokasi[]" value="Yogyakarta"
                                        {{ in_array('Yogyakarta', $selected_lokasis) ? 'checked' : '' }}>
                                    Kota Yogyakarta
                                </li>
                            </label>
                            <label>
                                <li class="list-group-item">
                                    <input type="checkbox" name="lokasi[]" value="Bantul"
                                        {{ in_array('Bantul', $selected_lokasis) ? 'checked' : '' }}>
                                    Kab. Bantul
                                </li>
                            </label>
                            <label>
                                <li class="list-group-item">
                                    <input type="checkbox" name="lokasi[]" value="Sleman"
                                        {{ in_array('Sleman', $selected_lokasis) ? 'checked' : '' }}>
                                    Kab. Sleman
                                </li>
                            </label>
                            <label>
                                <li class="list-group-item">
                                    <input type="checkbox" name="lokasi[]" value="Kulonprogo"
                                        {{ in_array('Kulonprogo', $selected_lokasis) ? 'checked' : '' }}>
                                    Kab. Kulonprogo
                                </li>
                            </label>
                            <label>
                                <li class="list-group-item">
                                    <input type="checkbox" name="lokasi[]" value="Gunungkidul"
                                        {{ in_array('Gunungkidul', $selected_lokasis) ? 'checked' : '' }}>
                                    Kab. Gunungkidul
                                </li>
                            </label>
                        </ul>

                        <ul class="list-group ms-4">
                            <li class="list-group-item active">Kategori</li>
                            @foreach ($kategori as $kat)
                                <label>
                                    <li class="list-group-item">
                                        <input type="checkbox" name="kategori[]" value="{{ $kat->id_kategori }}"
                                            {{ in_array($kat->id_kategori, $selected_kategoris) ? 'checked' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </li>
                                </label>
                            @endforeach
                        </ul>
                        <div class="d-grid gap-2 text-end ms-4 mt-2">
                            <button type="submit" class="btn btn-dark btn-block">Cari</button>
                        </div>
                        <div class="d-grid gap-2 text-end ms-4 mt-2">
                            <a href="{{ route('utama.search') }}" class="btn btn-secondary btn-block">Reset Pencarian </a>
                        </div>

                    </form>
                </div>
                <div class="col-md-9">
                    <!-- Search Results -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Search Results</h3>
                            <input type="checkbox" id="myCheckbox">
                            <label for="myCheckbox">tampilkan maps</label>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="div1" class="row">
                                @if ($tempat_kursus->count() > 0)
                                    @foreach ($tempat_kursus as $kursus)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <div class="card-img-top content-ratio"
                                                    style="background-image: url('{{ asset('gambar/tempatkursus/foto-utama/' . $kursus->foto_utama) }}');">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">{{ $kursus->nama_tempat_kursus }}</h4>
                                                    <p class="card-text">{{ $kursus->alamat }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Data tidak ditemukan. Silahkan melakukan pencarian lainnya </p>
                                @endif
                            </div>
                            <div id="googleMap" style="width:100%;height:500px;display:none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Classes End -->


@endsection

@section('footer-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const input = document.querySelector('#querysearch');
        const clearButton = document.querySelector('#clear-input');
        clearButton.addEventListener('click', function() {
            input.value = '';
        });

        $(document).ready(function() {
            $('#myCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#div1').hide();
                    $('#googleMap').show();
                } else {
                    $('#div1').show();
                    $('#googleMap').hide();
                }
            });
        });
    </script>
@endsection
