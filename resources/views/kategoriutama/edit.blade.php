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
            <h2>Ubah Kategori Utama</h2>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kategoriutama.index') }}">Kategori Utama</a></li>
                <li class="breadcrumb-item"><a href="#">Ubah Kategori Utama</a></li>
            </ol>
        </nav>
    </div>
</div>
@can('kategori-edit')
<div class="row" style="margin-bottom: 30px;">
    <div class="col-sm-12 col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary"> <i class="fas fa-fw fa-arrow-left"></i>
            Kembali</a>
        <button id="btnEnableEdit" class="btn btn-info" onclick="enableInput();"> <i class="fas fa-fw fa-edit"></i> Ubah
            Data</button>
    </div>
</div>
@endcan
<div class="row">
    <div class="col-sm-12 col-md-12">
        <form name="kategoriutamaForm" action="{{ route('kategoriutama.update', ['id' => $kategori->id_kategori_utama]) }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="id_kategori_utama" id="id_kategori_utama">

            <div class="form-group">
                <label for="nama_kategori_utama">Nama :</label>
                <input type="text" class="form-control" id="nama_kategori_utama" placeholder="Masukkan nama kategori besar" name="nama_kategori_utama" required value="{{ $kategori->nama_kategori_utama }}" disabled=true>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Silahkan isi kolom ini!</div>
            </div>

            <div class="" style="margin-top: 30px;">
                <a href="{{ route('kategoriutama.edit', ['id' => $kategori->id_kategori_utama]) }}" id="btnBatal" class="btn btn-danger mr-2" style="display: none;">Batal</a>
                <a href="#myModal" id="btnUpdate" data-toggle="modal" class="btn btn-success" style="display: none;">Simpan</a>
            </div>
            <!-- Modal HTML -->


            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-light">
                            <h5 class="modal-title w-100">Ubah Data</h5>
                            <a data-dismiss="modal" class="btn btn-light btn-circle">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin untuk mengubah data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button id="submit" type="submit" class="btn btn-success">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer-script')
<script type="text/javascript">
    function enableInput() {
        var inputs = document.getElementsByClassName('form-control');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
        $("#btnUpdate").css("display", "");
        $("#btnBatal").css("display", "");
    }

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