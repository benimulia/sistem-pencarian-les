@extends('layouts.utama')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="utama/img/carousel-1.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center p-4" style="background: rgba(0, 0, 0, .2);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown mb-4">Temukan Tempat Kursus Terdekat
                            </h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">Temukan berbagai pilihan tempat kursus
                                terdekat dengan
                                kualitas terbaik dan harga terjangkau. Dapatkan penawaran menarik dan promo eksklusif
                                hanya di
                                SIPTKA.</p>
                            <a href="{{ route('utama.search') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Cari
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="utama/img/carousel-2.jpg" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center p-4" style="background: rgba(0, 0, 0, .2);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown mb-4">Pilihan Tempat Kursus Terbaik
                            </h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-2">Temukan tempat kursus terbaik untuk
                                meningkatkan kemampuan
                                dan keterampilan Anda. Dapatkan pengalaman belajar yang menyenangkan dan bermanfaat
                                hanya di
                                SIPTKA.</p>
                            <a href="{{ route('utama.search') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Cari
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


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
<div class="container-xxl py-5">
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
                <div class="row g-4 align-items-center">
                    <div class="col-sm-6">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{route ('utama.about')}}">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-12 text-center">
                        <img class="img-fluid w-75 rounded-circle bg-light p-3" src="utama/img/about-1.jpg" alt="">
                    </div>
                    <div class="col-6 text-start" style="margin-top: -150px;">
                        <img class="img-fluid w-100 rounded-circle bg-light p-3" src="utama/img/about-2.jpg" alt="">
                    </div>
                    <div class="col-6 text-end" style="margin-top: -150px;">
                        <img class="img-fluid w-100 rounded-circle bg-light p-3" src="utama/img/about-3.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Kategori Kursus Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Kategori Kursus Populer</h1>
            <p>Temukan kursus terbaik untuk anak Anda dengan mudah melalui SIPTKA. Di sini, kami menawarkan berbagai
                kategori kursus yang dapat dipilih sesuai dengan kebutuhan anak Anda.</p>
        </div>
        <div class="row g-4">
            @foreach ($kategorikursuspopuler as $index => $result)
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
<!-- Kategori Kursus End -->

<!-- Kategori Kursus Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Kategori Kursus Umum</h1>
            <p>Temukan kursus terbaik untuk anak Anda dengan mudah melalui SIPTKA. Di sini, kami menawarkan berbagai
                kategori kursus yang dapat dipilih sesuai dengan kebutuhan anak Anda.</p>
        </div>
        <div class="row g-4">
            @foreach ($kategorikursusumum as $index => $result)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('utama.kategori', ['id' => $result->id_kategori]) }}">
                    <div class="team-item2 position-relative">
                        <div class="team-text2 p-4 text-center">
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
<!-- Kategori Kursus End -->


<!-- Classes Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Kursus Unik</h1>
            <p>Temukan kursus-kursus yang paling populer di SIPTKA. Kami menawarkan berbagai pilihan kursus berkualitas
                untuk memenuhi kebutuhan belajar anak-anak anda. Cari tahu kursus mana yang menjadi favorit para orang
                tua dan siswa di sekitar anda.</p>
        </div>

        <div class="row g-4">
            @foreach ($kategorikursusunik as $index => $result)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="classes-item">
                    <div class="bg-light rounded-circle w-75 mx-auto p-3">
                        <img class="img-fluid rounded-circle" src="{{ asset('gambar/icon kategori.png  ') }}" alt="" style="width: 100%; aspect-ratio: 3/2; object-fit:contain;">
                    </div>
                    <div class="bg-light rounded p-4 pt-5 mt-n5">
                        <a class="d-block text-center h3 mt-3 mb-4" href="{{ route('utama.kategori', ['id' => $result->id_kategori]) }}">{{ $result->nama_kategori }}</a>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Classes End -->




<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Apa Kata Mereka?</h1>
            <p>Berikut adalah beberapa testimoni dari pelanggan kami yang telah menggunakan layanan SIPTKA</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">Saya sangat senang dengan layanan SIPTKA! Timnya sangat profesional dan membantu saya
                    menyelesaikan proyek saya dengan sangat baik. Saya akan merekomendasikan SIPTKA kepada siapa saja
                    yang membutuhkan layanan desain yang berkualitas tinggi.</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="utama/img/testimonial-1.jpg" style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">Client Name</h3>
                        <span>Profession</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">SIPTKA benar-benar telah melampaui harapan saya. Mereka sangat responsif dan
                    memberikan kualitas desain yang luar biasa. Saya sangat merekomendasikan SIPTKA kepada siapa saja
                    yang ingin bekerja dengan perusahaan desain yang terpercaya dan berkualitas tinggi.</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="utama/img/testimonial-2.jpg" style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">Client Name</h3>
                        <span>Profession</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
            <div class="testimonial-item bg-light rounded p-5">
                <p class="fs-5">SIPTKA memberikan layanan yang sangat cepat dan akurat, dengan hasil desain yang
                    kreatif dan inovatif. Saya sangat senang dengan hasil akhirnya dan pasti akan menggunakan SIPTKA lagi
                    di masa depan.</p>
                <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="utama/img/testimonial-3.jpg" style="width: 90px; height: 90px;">
                    <div class="ps-3">
                        <h3 class="mb-1">Client Name</h3>
                        <span>Profession</span>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection