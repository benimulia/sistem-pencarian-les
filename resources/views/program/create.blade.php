@extends('layouts.master')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}" />
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
            <h2>Tambah Program Baru</h2>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program Kursus</a></li>
                <li class="breadcrumb-item"><a>Tambah Program</a></li>
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
        <form id="programForm" class="needs-validation" novalidate action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="id_tempat_kursus">Tempat Kursus :</label>
                <select class="form-control select2" id="id_tempat_kursus" name="id_tempat_kursus">
                    <option value="">Tempat Kursus</option>
                    @foreach ($tempatkursus as $index => $result)
                    <option value="{{ $result->id_tempat_kursus }}">{{ $result->nama_tempat_kursus }}</option>
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
                <label for="nama_program">Nama Program :</label>
                <input type="text" class="form-control" id="nama_program" placeholder="Masukkan nama program.." name="nama_program" required>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi_program">Deskripsi Program :</label>
                <textarea type="text" class="form-control" id="deskripsi_program" placeholder="Masukkan deskripsi.." name="deskripsi_program" required> </textarea>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="harga">Harga :</label>
                <input type="text" class="form-control" id="harga" placeholder="Masukkan harga.." name="harga" required>
                <small>contoh: 250000 </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div class="form-group">
                <label for="jadwal">Jadwal Program :</label>
                <input type="text" class="form-control" id="jadwal" placeholder="Masukkan jadwal program.." name="jadwal" required>
                <small>contoh: Senin-Jumat Pukul 16:00 - 17:00 </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>
            <div class="form-group">
                <label for="durasi">Durasi Program :</label>
                <input type="text" class="form-control" id="durasi" placeholder="Masukkan durasi program.." name="durasi" required>
                <small>contoh: 60 menit </small>
                <div class="valid-feedback">
                    Terlihat bagus!
                </div>
                <div class="invalid-feedback">
                    Silahkan isi kolom ini.
                </div>
            </div>

            <div class="form-group">
                <label for="foto_program">Upload foto program:</label> <br>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto_program" name="foto_program" accept=".jpg,.jpeg,.png" required />
                    <label class="custom-file-label" for="foto_program">Masukkan foto</label>
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
                <a href="{{ route('program.create') }}" class="btn btn-danger mr-2">Batal</a>
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

        $('#id_tempat_kursus').select2({
            placeholder: "Pilih Tempat Kursus",
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

    $('#harga').keypress(function(e) {
        var arr = [];
        var kk = e.which;

        for (i = 48; i < 58; i++)
            arr.push(i);

        if (!(arr.indexOf(kk) >= 0))
            e.preventDefault();
    });

    //logic upload foto start
    $('#foto_program').on('change', function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
        readURL(this);

    })
    $('#foto_program').bind('change', function() {
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