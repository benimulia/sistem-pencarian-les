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
                    draggable: true // membuat marker dapat di-drag oleh pengguna
                });
            }

            // isi nilai koordinat ke form
            document.getElementById("lat").value = posisiTitik.lat();
            document.getElementById("lng").value = posisiTitik.lng();

        }

        function initialize() {
            // ambil data latitude dan longitude dari database dan buat marker
            var lat = <?php echo $tempatkursus->latitude; ?>;
            var lng = <?php echo $tempatkursus->longitude; ?>;

            var propertiPeta = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

            
            var posisiTitik = new google.maps.LatLng(lat, lng);
            taruhMarker(peta, posisiTitik);

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
                <h2>Edit Tempat Kursus </h2>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tempatkursus.index') }}">Tempat Kursus</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit Tempat Kursus</a></li>
                </ol>
            </nav>
        </div>
    </div>
    @can('tempat-kursus-edit')
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
            <form name="tempatkursusForm"
                action="{{ route('tempatkursus.update', ['id' => $tempatkursus->id_tempat_kursus]) }}"
                class="needs-validation" novalidate method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="id_tempat_kursus" id="id_tempat_kursus">

                @if ($userrole == 1)
                    <div class="form-group">
                        <label for="id_user">Owner :</label>
                        <select class="form-control select2" id="id_user" name="id_user" disabled=true>
                            <option value="">Owner</option>
                            @foreach ($users as $index => $result)
                                <option value="{{ $result->id }}"
                                    {{ $tempatkursus->id_user == $result->id ? 'selected' : '' }}>{{ $result->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please fill out this field.
                        </div>
                    </div>
                @else
                    <input type="hidden" id="id_user" name="id_user" value="{{ auth()->user()->id }}">
                @endif

                <div class="form-group">
                    <label for="id_kategori">Kategori :</label>
                    <select class="form-control select2" id="id_kategori" name="id_kategori[]" multiple="multiple" required
                        disabled=true>
                        @foreach ($kategori as $index => $result)
                            <option value="{{ $result->id_kategori }}"
                                {{ in_array($result->id_kategori, $tempatkursus->kategori->pluck('id_kategori')->toArray()) ? 'selected' : '' }}>
                                {{ $result->nama_kategori }}
                            </option>
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
                    <label for="nama_tempat_kursus">Nama Tempat Kursus :</label>
                    <input type="text" class="form-control" id="nama_tempat_kursus" placeholder="Masukkan nama.."
                        name="nama_tempat_kursus" required value="{{ $tempatkursus->nama_tempat_kursus }}" disabled=true>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat.." name="alamat"
                        required value="{{ $tempatkursus->alamat }}" disabled=true>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div id="googleMap" style="width:100%;height:380px;"></div>
                <input type="hidden" id="lat" name="lat" value="{{ $tempatkursus->latitude }}">
                <input type="hidden" id="lng" name="lng" value="{{ $tempatkursus->longitude }}">

                <div class="form-group">
                    <label for="no_telp">Nomor Telp :</label>
                    <input type="text" class="form-control" id="no_telp" placeholder="Masukkan no telp.."
                        name="no_telp" maxlength="13" required value="{{ $tempatkursus->no_telp }}" disabled=true>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="instagram">Instagram :</label>
                    <input type="text" class="form-control" id="instagram"
                        placeholder="Masukkan username instagram.." name="instagram" required
                        value="{{ $tempatkursus->instagram }}" disabled=true>
                    <small>contoh : ukdw.yogyakarta </small>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook :</label>
                    <input type="text" class="form-control" id="facebook" placeholder="Masukkan facebook.."
                        name="facebook" required value="{{ $tempatkursus->facebook }}" disabled=true>
                    <small>contoh : UKDW Yogyakarta </small>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill out this field.
                    </div>
                </div>

                <div class="form-group">
                    <label for="foto_utama">Upload foto utama tempat kursus :</label> <br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input form-control" id="foto_utama" name="foto_utama"
                            accept=".jpg,.jpeg,.png" disabled=true />
                        <label class="custom-file-label" for="foto_utama">{{ $tempatkursus->foto_utama }}</label>
                    </div>
                    <div>
                        <small>*Ukuran Foto Maksimal 2Mb</small>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label id="lblimgtag" for="profile-img-tag" style="display:none">Preview Gambar:</label>
                    @if ($tempatkursus->foto_utama)
                        <a href="/gambar/tempatkursus/foto-utama/{{ $tempatkursus->foto_utama }}">
                            <img src="/gambar/tempatkursus/foto-utama/{{ $tempatkursus->foto_utama }}"
                                style="width: 10%; aspect-ratio: 3/2; object-fit: contain;" id="profile-img-tag">
                        </a>
                    @else
                        <p>Tidak ada gambar yang diunggah.</p>
                    @endif
                </div>


                <div class="" style="margin-top: 30px;">
                    <a href="{{ route('tempatkursus.edit', ['id' => $tempatkursus->id_tempat_kursus]) }}" id="btnBatal"
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
