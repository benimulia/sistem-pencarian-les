@extends('layouts.master')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}" />
@endsection

@section('head-script')
<script src="http://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
<script>
    // variabel global marker
    var marker;

    function taruhMarker(peta, posisiTitik) {

        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta,
                draggable: true
            });
        }

        // isi nilai koordinat ke form
        document.getElementById("lat").value = posisiTitik.lat();
        document.getElementById("lng").value = posisiTitik.lng();

    }

    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(-7.785996142593305, 110.37836496578073),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        // even listner ketika maps diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });

    }


    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection

@section('content')
@if ($message = Session::get('success'))
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Berhasil!</strong> {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('fail'))
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Gagal!</strong> {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="pull-left">
            <h2>Tambah Tempat Kursus Baru</h2>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tempatkursus.index') }}">Tempat Kursus</a></li>
                <li class="breadcrumb-item">Tambah Tempat Kursus</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="row" style="margin-bottom: 30px;">
    <div class="col-sm-12 col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-fw fa-arrow-left"></i>
            Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <form id="tempatkursusForm" class="needs-validation" novalidate action="{{ route('tempatkursus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($userrole == 1)
            <div class="form-group">
                <label for="id_user">Owner :</label>
                <select class="form-control select2" id="id_user" name="id_user">
                    <option value="">Owner</option>
                    @foreach ($users as $index => $result)
                    <option value="{{ $result->id }}">{{ $result->name }}</option>
                    @endforeach
                </select>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            @else
            <input type="hidden" id="id_user" name="id_user" value="{{ auth()->user()->id }}">
            @endif


            <div class="form-group">
                <label for="id_kategori">Kategori :</label>
                <select class="form-control select2" id="id_kategori" name="id_kategori[]" multiple="multiple" required>
                    @foreach ($kategori as $index => $result)
                    <option value="{{ $result->id_kategori }}">{{ $result->nama_kategori }}</option>
                    @endforeach
                </select>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>


            <div class="form-group">
                <label for="nama_tempat_kursus">Nama Tempat Kursus :</label>
                <input type="text" class="form-control" id="nama_tempat_kursus" placeholder="Masukkan nama.." name="nama_tempat_kursus" required>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat :</label>
                <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat.." name="alamat" required>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div id="googleMap" style="width:100%;height:380px;"></div>
            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="lng" name="lng" value="">

            <div class="form-group">
                <label for="no_telp">Nomor Telp :</label>
                <input type="text" class="form-control" id="no_telp" placeholder="Masukkan no telp.." name="no_telp" maxlength="13" required>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="instagram">Instagram :</label>
                <input type="text" class="form-control" id="instagram" placeholder="Masukkan username instagram.." name="instagram" required>
                <small>contoh : ukdw.yogyakarta </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="facebook">Facebook :</label>
                <input type="text" class="form-control" id="facebook" placeholder="Masukkan facebook.." name="facebook" required>
                <small>contoh : UKDW Yogyakarta </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="foto_utama">Upload foto utama tempat kursus:</label> <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto_utama" name="foto_utama" accept=".jpg,.jpeg,.png" required />
                    <label class="custom-file-label" for="foto_utama">Masukkan foto</label>
                </div>
                <div>
                    <small>*Ukuran Foto Maksimal 2Mb</small>
                </div>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <label id="lblimgtag" for="profile-img-tag" style="display:none">Tampilkan Gambar:</label>
                <img src="#" style="width: 10%; aspect-ratio: 3/2; object-fit:contain; display:none" id="profile-img-tag">
            </div>


            <div class="mt-4">
                <a href="{{ route('tempatkursus.create') }}" class="btn btn-danger mr-2">Batal</a>
                <button type="submit" id="btn-save" name="btnsave" class="btn btn-success">Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('body-script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('footer-script')
<script type="text/javascript">
    //select2 start
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $(document).ready(function() {

        $('#id_kategori').select2({
            placeholder: "Pilih Kategori",
            allowClear: true,
            theme: "bootstrap-5",
        });

        var role = "{{ $userrole }}";

        if (role == 1) {
            $('#id_user').select2({
                placeholder: "Pilih Owner",
                allowClear: true,
                theme: "bootstrap-5",
            });
        }

    });
    //select2 end

    //no telp logic start
    $('#no_telp').keypress(function(e) {
        var arr = [];
        var kk = e.which;

        for (i = 48; i < 58; i++)
            arr.push(i);

        if (!(arr.indexOf(kk) >= 0))
            e.preventDefault();
    });
    //no telp logic end

    //logic upload foto start
    $('#foto_utama').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
        readURL(this);

    })
    $('#foto_utama').bind('change', function() {
        if (this.files[0].size / 1024 / 1024 > 2) {
            alert("Ukuran foto yang Anda masukkan lebih dari 2mb. Mohon input ulang");
            $(this).val('');
            $(this).next('.custom-file-label').html('Masukkan foto');
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            if (input.files[0].size / 1024 / 1024 < 2) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                    $("#profile-img-tag").css("display", "");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
    //logic upload foto end

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        $('#myModal').modal('hide');
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                        form.classList.add('was-validated');
                        return false;
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection