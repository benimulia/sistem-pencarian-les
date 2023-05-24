@extends('layouts.master')
@section('content')
    @if ($message = Session::get('success'))
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <strong>Failed!</strong> {{ $message }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="pull-left">
                <h2>Tambah Kategori Besar Baru</h2>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kategoribesar.index') }}">Kategori Besar</a></li>
                    <li class="breadcrumb-item"><a href="#">Tambah Kategori Besar</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row" style="margin-bottom: 30px;">
        <div class="col-sm-12 col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-danger"> <i class="fas fa-fw fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <form id="kategoriForm" class="needs-validation" novalidate action="{{ route('kategoribesar.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_kategori_besar">Nama :</label>
                    <input type="text" class="form-control" id="nama_kategori_besar" placeholder="Masukkan nama kategori besar"
                        name="nama_kategori_besar" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('kategoribesar.create') }}" class="btn btn-danger mr-2">Batal</a>
                    <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Submit</button>

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
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
