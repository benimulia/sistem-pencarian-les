@extends('layouts.utama')

@section('content')
    <div class="container-fluid p-0 mb-5">
        <div class="slideshow-container mt-4">

            <div class="mySlides">
                <img src="utama/img/custom-carousel-1.png" style="width:100%">
                <div class="text"></div>
            </div>

            <div class="mySlides">
                <img src="utama/img/custom-carousel-2.png" style="width:100%">
                <div class="text"></div>
            </div>

            <div class="mySlides">
                <img src="utama/img/custom-carousel-3.png" style="width:100%">
                <div class="text"></div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>



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

            {{-- <div class="text-center mt-4 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('utama.jeniskategoripopuler') }}" class="btn btn-primary">Lihat Selengkapnya</a>
            </div> --}}
        </div>
    </div>
    <!-- Kategori Kursus End -->

    <!-- Classes Start -->
    <div class="container-xxxl py-5">
        <div class="container">
            <div class="text-left mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h2 class="mb-3">Temukan Kursus Terbaik Anda</h2>
                <p>Temukan kursus terbaik untuk anak Anda dengan mudah melalui SIPTKA. Di sini, kami menawarkan berbagai
                    kategori kursus yang dapat dipilih sesuai dengan kebutuhan anak Anda.</p>
            </div>
            <div class="row g-4">
                @if ($tempat_kursus->count() > 0)
                    @foreach ($tempat_kursus as $kursus)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-img-top content-ratio"
                                    style="background-image: url('{{ asset('gambar/tempatkursus/foto-utama/' . $kursus->foto_utama) }}');">
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('utama.tempatkursus', ['id' => $kursus->id_tempat_kursus]) }}">
                                        <h4 class="card-title">{{ $kursus->nama_tempat_kursus }}</h4>
                                    </a>
                                    <p class="card-text">{{ $kursus->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Data tidak ditemukan. </p>
                @endif
            </div>
            <div class="text-center mt-4 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('utama.search') }}"
                    style="
                text-decoration: underline;
                color: black;
                font-weight: 550;
            ">Temukan
                    lebih banyak</a>
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
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="utama/img/testimonial-1.jpg"
                            style="width: 90px; height: 90px;">
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
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="utama/img/testimonial-2.jpg"
                            style="width: 90px; height: 90px;">
                        <div class="ps-3">
                            <h3 class="mb-1">Client Name</h3>
                            <span>Profession</span>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-5">
                    <p class="fs-5">SIPTKA memberikan layanan yang sangat cepat dan akurat, dengan hasil desain yang
                        kreatif dan inovatif. Saya sangat senang dengan hasil akhirnya dan pasti akan menggunakan SIPTKA
                        lagi
                        di masa depan.</p>
                    <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="utama/img/testimonial-3.jpg"
                            style="width: 90px; height: 90px;">
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

@section('scripts')
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active-car", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active-car";
        }
    </script>
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
