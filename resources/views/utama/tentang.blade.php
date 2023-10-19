@extends('layouts.utama')

@section('content')
    <!-- Page Header End -->
    <div class="container-xxxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Value Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Nilai-nilai</h1>
                <p>SIPTKA memiliki nilai yang terus akan dijaga untuk menjaga kualitas.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="facility-item">
                        <div class="facility-icon bg-primary">
                            <span class="bg-primary"></span>
                            <i class="fa fa-check fa-3x text-primary"></i>
                            <span class="bg-primary"></span>
                        </div>
                        <div class="facility-text bg-primary">
                            <h3 class="text-primary mb-3">Quality Choices</h3>
                            <p class="mb-0">Pilihan berkualitas dengan konten dan kurikulum yang diakui oleh para ahli
                                pendidikan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="facility-item">
                        <div class="facility-icon bg-success">
                            <span class="bg-success"></span>
                            <i class="fas fa-headset fa-3x text-success"></i>
                            <span class="bg-success"></span>
                        </div>
                        <div class="facility-text bg-success">
                            <h3 class="text-success mb-3">Free Consulting</h3>
                            <p class="mb-0">Konsultasi gratis dengan guru dan konselor profesional untuk membantu memilih
                                kursus terbaik untuk anak Anda.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="facility-item">
                        <div class="facility-icon bg-warning">
                            <span class="bg-warning"></span>
                            <i class="fa fa-lock fa-3x text-warning"></i>
                            <span class="bg-warning"></span>
                        </div>
                        <div class="facility-text bg-warning">
                            <h3 class="text-warning mb-3">Reliable</h3>
                            <p class="mb-0">Terpercaya dan selalu berusaha memberikan yang terbaik bagi siswa dengan
                                pengajar yang berkualitas dan pelayanan yang responsif.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="facility-item">
                        <div class="facility-icon bg-info">
                            <span class="bg-info"></span>
                            <i class="fa fa-percent fa-3x text-info"></i>
                            <span class="bg-info"></span>
                        </div>
                        <div class="facility-text bg-info">
                            <h3 class="text-info mb-3">Promos</h3>
                            <p class="mb-0">Berbagai promo menarik dengan diskon dan penawaran menarik untuk kursus
                                tertentu.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Value End -->

    <!-- About Start -->
    <div class="container-xxxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">Tentang</h1>
                    <p>SIPTKA adalah portal web yang memudahkan Anda untuk mencari tempat kursus anak di sekitar Yogyakarta
                        secara online. Dengan SIPTKA, Anda tidak perlu repot-repot mencari dan menghubungi setiap tempat
                        kursus secara terpisah. SIPTKA menyediakan informasi lengkap dan terpercaya tentang tempat kursus
                        anak, sehingga Anda dapat memilih tempat kursus yang sesuai dengan kebutuhan dan preferensi Anda
                    </p>
                    <p class="mb-4">SIPTKA juga memberikan layanan konsultasi gratis untuk membantu Anda dalam memilih
                        tempat kursus yang tepat untuk anak Anda. Dengan SIPTKA, mencari tempat kursus anak menjadi lebih
                        mudah, cepat, dan efisien.</p>
                    <p class="mb-4">Apakah kamu pemilik tempat kursus? Kamu juga bisa mendaftarkan tempat kursus kamu di
                        SIPTKA melalui link berikut.</p>
                    <a href="{{ route('login') }}" target="_blank" rel="noopener noreferrer">Klik Disini</a>
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-3" src="utama/img/about-1.jpg"
                                alt="">
                        </div>
                        <div class="col-6 text-start" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="utama/img/about-2.jpg"
                                alt="">
                        </div>
                        <div class="col-6 text-end" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="utama/img/about-3.jpg"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
