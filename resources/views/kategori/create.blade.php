@extends('layouts.master')
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
            <h2>Tambah Kategori Baru</h2>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item">Tambah Kategori</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row" style="margin-bottom: 30px;">
    <div class="col-sm-12 col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary"> <i class="fas fa-fw fa-arrow-left"></i>
            Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <form id="kategoriForm" class="needs-validation" novalidate action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_kategori_besar">Kategori Besar :</label>
                <select class="form-control select2" id="id_kategori_besar" name="id_kategori_besar">
                    <option value="">Pilih Kategori Besar</option>
                    @foreach ($kategoribesar as $index => $result)
                    <option value="{{ $result->id_kategori_besar }}">{{ $result->nama_kategori_besar }}</option>
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
                <label for="nama_kategori">Nama :</label>
                <input type="text" class="form-control" id="nama_kategori" placeholder="Masukkan nama kategori" name="nama_kategori" required>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div class="form-group">
                <label for="persen_populer">Persen Populer :</label>
                <input type="text" class="form-control persen" id="persen_populer" placeholder="Masukkan persen populer.." name="persen_populer" required>
                <small>contoh: 40 </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div class="form-group">
                <label for="persen_umum">Persen Umum :</label>
                <input type="text" class="form-control persen" id="persen_umum" placeholder="Masukkan persen umum.." name="persen_umum" required>
                <small>contoh: 40 </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div class="form-group">
                <label for="persen_unik">Persen Unik :</label>
                <input type="text" class="form-control persen" id="persen_unik" placeholder="Masukkan persen unik.." name="persen_unik" required>
                <small>contoh: 40 </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('kategori.create') }}" class="btn btn-danger mr-2">Batal</a>
                <button type="submit" id="btn-save" name="btnsave" class="btn btn-success">Simpan</button>

            </div>

        </form>
    </div>
</div>
@endsection

@section('footer-script')
<script type="text/javascript">
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

                    // Check the persen fields for valid values
                    var persenPopuler = parseInt(document.getElementById('persen_populer').value);
                    var persenUmum = parseInt(document.getElementById('persen_umum').value);
                    var persenUnik = parseInt(document.getElementById('persen_unik').value);

                    if (persenPopuler < 0 || persenPopuler > 100 ||
                        persenUmum < 0 || persenUmum > 100 ||
                        persenUnik < 0 || persenUnik > 100) {
                        event.preventDefault();
                        event.stopPropagation();
                        $('#myModal').modal('hide');
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                        alert('Invalid percentage value. Please enter a value between 0 and 100 for the percentage fields.');
                        return false;
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    $('.persen').keypress(function(e) {
        var arr = [];
        var kk = e.which;

        for (i = 48; i < 58; i++)
            arr.push(i);

        if (!(arr.indexOf(kk) >= 0))
            e.preventDefault();
    });
</script>

@endsection