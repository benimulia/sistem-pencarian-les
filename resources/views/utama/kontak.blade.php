@extends('layouts.utama')

@section('content')
<!-- Page Header End -->
<div class="container-xxxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">Kontak Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Kontak Kami</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-xxxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Hubungi</h1>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                    <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                </div>
                <h6>Gg.Aster No 7 RTO3/RW01 Santren Catur Tunggal Depok Sleman Yogyakarta 55281</h6>
            </div>
            <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                    <i class="fa fa-envelope-open fa-2x text-primary"></i>
                </div>
                <h6>Roitoniapanjaitan@gmail.com</h6>
            </div>
            <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                    <i class="fa fa-phone-alt fa-2x text-primary"></i>
                </div>
                <h6>0822-7613-9661</h6>
            </div>
        </div>
        <div class="bg-light rounded">
            <div class="row g-0">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100 d-flex flex-column justify-content-center p-5">
                        <p class="mb-4">Formulir kontak saat ini tidak aktif. Dapatkan formulir kontak yang fungsional dan berfungsi dengan
                            Ajax & PHP dalam beberapa menit. Cukup salin dan tempel file, tambahkan sedikit kode dan selesai.
                            <a href="https://htmlcodex.com/contact-form">Download Now</a>.
                        </p>
                        <form>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="name" placeholder="Masukan Nama">
                                        <label for="name">Nama</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-0" id="email" placeholder=" Masukan Email">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border-0" placeholder="Tinggalkan Pesan Disini" id="message" style="height: 100px"></textarea>
                                        <label for="message">Pesan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.202988810867!2d110.38906803063864!3d-7.768286771284413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59ba3ebfdd73%3A0x4b088ed793d86e19!2sGg.%20Aster%20No.7%2C%20Santren%2C%20Caturtunggal%2C%20Kec.%20Depok%2C%20Kabupaten%20Sleman%2C%20Daerah%20Istimewa%20Yogyakarta%2055281!5e0!3m2!1sen!2sid!4v1699977395502!5m2!1sen!2sid" frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection