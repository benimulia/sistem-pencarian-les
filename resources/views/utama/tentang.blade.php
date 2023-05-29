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


    <!-- About Start -->
    <div class="container-xxxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">Tentang</h1>
                    <p>Kursusku adalah portal web yang memudahkan Anda untuk mencari tempat kursus anak di sekitar Yogyakarta
                        secara online. Dengan Kursusku, Anda tidak perlu repot-repot mencari dan menghubungi setiap tempat
                        kursus secara terpisah. Kursusku menyediakan informasi lengkap dan terpercaya tentang tempat kursus
                        anak, sehingga Anda dapat memilih tempat kursus yang sesuai dengan kebutuhan dan preferensi Anda
                    </p>
                    <p class="mb-4">Kursusku juga memberikan layanan konsultasi gratis untuk membantu Anda dalam memilih
                        tempat kursus yang tepat untuk anak Anda. Dengan Kursusku, mencari tempat kursus anak menjadi lebih
                        mudah, cepat, dan efisien.</p>
                    <p class="mb-4">Apakah kamu pemilik tempat kursus? Kamu juga bisa mendaftarkan tempat kursus kamu di
                        Kursusku melalui link berikut.</p>
                    <a href="{{route ('login')}}" target="_blank" rel="noopener noreferrer">Klik Disini</a>
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
