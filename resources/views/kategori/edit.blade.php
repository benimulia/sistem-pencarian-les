@extends('layouts.master')
@section('content')
@if ($message = Session::get('success'))
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{ $message }}
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
                <strong>Failed!</strong> {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="pull-left">
            <h2>Edit Kategori </h2>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item"><a href="#">Edit Kategori</a></li>
            </ol>
        </nav>
    </div>
</div>
@can('kategori-edit')
<div class="row" style="margin-bottom: 30px;">
    <div class="col-sm-12 col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-danger"> <i class="fas fa-fw fa-arrow-left"></i>
            Kembali</a>
        <button id="btnEnableEdit" class="btn btn-info" onclick="enableInput();"> <i class="fas fa-fw fa-edit"></i> Edit
            Data</button>
    </div>
</div>
@endcan
<div class="row">
    <div class="col-sm-12 col-md-12">
        <form name="kategoriForm" action="{{ route('kategori.update', ['id' => $kategori->id_kategori]) }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="id_kategori" id="id_kategori">

            <div class="form-group">
                <label for="id_kategori_besar">Kategori Besar :</label>
                <select class="form-control select2" id="id_kategori_besar" name="id_kategori_besar" disabled=true>
                    <option value="">Pilih Kategori Besar</option>
                    @foreach ($kategoribesar as $index => $result)
                    <option value="{{ $result->id_kategori_besar }}" {{ $kategori->id_kategori_besar == $result->id_kategori_besar ? 'selected' : '' }}>{{ $result->nama_kategori_besar }}</option>
                    @endforeach
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please fill out this field.
                </div>
            </div>

            <div class="form-group">
                <label for="nama_kategori">Nama :</label>
                <input type="text" class="form-control" id="nama_kategori" placeholder="Masukkan nama kategori.." name="nama_kategori" required value="{{ $kategori->nama_kategori }}" disabled=true>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="persen_populer">Persen Populer :</label>
                <input type="text" class="form-control" id="persen_populer" placeholder="Masukkan persen populer kategori.." name="persen_populer" required value="{{ $kategori->persen_populer }}" disabled=true>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="persen_umum">Persen Umum :</label>
                <input type="text" class="form-control" id="persen_umum" placeholder="Masukkan persen umum kategori.." name="persen_umum" required value="{{ $kategori->persen_umum }}" disabled=true>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="persen_unik">Persen Unik :</label>
                <input type="text" class="form-control" id="persen_unik" placeholder="Masukkan persen unik kategori.." name="persen_unik" required value="{{ $kategori->persen_unik }}" disabled=true>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="" style="margin-top: 30px;">
                <a href="{{ route('kategori.edit', ['id' => $kategori->id_kategori]) }}" id="btnBatal" class="btn btn-danger mr-2" style="display: none;">Batal</a>
                <a href="#myModal" id="btnUpdate" data-toggle="modal" class="btn btn-success" style="display: none;">Update </a>
            </div>
            <!-- Modal HTML -->


            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-light">
                            <h5 class="modal-title w-100">Edit Data?</h5>
                            <a data-dismiss="modal" class="btn btn-secondary btn-circle">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin untuk mengedit data?</p>
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

                    // Check the persen fields for valid values
                    var persenPopuler = parseFloat(document.getElementById('persen_populer').value);
                    var persenUmum = parseFloat(document.getElementById('persen_umum').value);
                    var persenUnik = parseFloat(document.getElementById('persen_unik').value);

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
</script>

@endsection