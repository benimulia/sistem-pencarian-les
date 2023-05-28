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
                <h2>Edit Program </h2>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit Program</a></li>
                </ol>
            </nav>
        </div>
    </div>
    @can('program-edit')
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
            <form name="programForm" action="{{ route('program.update', ['id' => $program->id_program]) }}"
                class="needs-validation" novalidate method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="id_program" id="id_program">                

                <div class="form-group">
                    <label for="id_tempat_kursus">Tempat Kursus :</label>
                    <select class="form-control select2" id="id_tempat_kursus" name="id_tempat_kursus" disabled=true>
                        <option value="">Tempat Kursus</option>
                        @foreach ($tempatkursus as $index => $result)
                            <option value="{{ $result->id_tempat_kursus }}" {{ $program->id_tempat_kursus == $result->id_tempat_kursus ? 'selected' : '' }}>{{ $result->nama_tempat_kursus }}</option>
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
                    <label for="nama_program">Nama Program :</label>
                    <input type="text" class="form-control" id="nama_program" placeholder="Masukkan nama program.."
                        name="nama_program" required value="{{ $program->nama_program }}" disabled=true>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi_program">Deskripsi Program :</label>
                    <textarea type="text" class="form-control" id="deskripsi_program" placeholder="Masukkan deskripsi.." name="deskripsi_program"
                        required value="{{ $program->deskripsi_program }}" disabled=true> {{ $program->deskripsi_program }} </textarea>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="harga">Harga :</label>
                    <input type="text" class="form-control" id="harga" placeholder="Masukkan harga.." name="harga"
                        required value="{{ $program->harga }}" disabled=true>
                    <small>contoh: 250000 </small>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>
                <div class="form-group">
                    <label for="jadwal">Jadwal Program :</label>
                    <input type="text" class="form-control" id="jadwal" placeholder="Masukkan jadwal program.."
                        name="jadwal" required value="{{ $program->jadwal }}" disabled=true>
                    <small>contoh: Senin-Jumat Pukul 16:00 - 17:00 </small>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>
                <div class="form-group">
                    <label for="durasi">Durasi Program :</label>
                    <input type="text" class="form-control" id="durasi" placeholder="Masukkan durasi program.."
                        name="durasi" required value="{{ $program->durasi }}" disabled=true>
                    <small>contoh: 60 menit </small>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="foto_program">Upload foto program :</label> <br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input form-control" id="foto_program"
                            name="foto_program" accept=".jpg,.jpeg,.png" disabled=true />
                        <label class="custom-file-label" for="foto_program">{{ $program->foto_program }}</label>
                    </div>
                    <div>
                        <small>*Ukuran Foto Maksimal 2Mb</small>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <label id="lblimgtag" for="profile-img-tag" style="display:none">Preview Gambar:</label>
                    <a href="/gambar/tempatkursus/foto-program/{{ $program->foto_program }}">
                        <img src="/gambar/tempatkursus/foto-program/{{ $program->foto_program }}"
                        style="width: 10%; aspect-ratio: 3/2; object-fit:contain;" id="profile-img-tag">
                    </a>
                </div>

                <div class="" style="margin-top: 30px;">
                    <a href="{{ route('program.edit', ['id' => $program->id_program]) }}" id="btnBatal"
                        class="btn btn-danger mr-2" style="display: none;">Batal</a>
                    <a href="#myModal" id="btnUpdate" data-toggle="modal" class="btn btn-success"
                        style="display: none;">Update </a>
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

@section('body-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
