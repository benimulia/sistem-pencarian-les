@extends('layouts.master')

@section('style')
<!-- Custom styles for this template-->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
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

<!-- Content Row -->
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tempat Kursus</h1>
<p class="mb-4">Halaman ini digunakan untuk menampilkan dan mengelola daftar tempat kursus.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Tempat Kursus</h6>
    </div>
    <div class="card-body">
        @can('tempat-kursus-create')
        <div class="row ml-0">
            <a href="{{ route('tempatkursus.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Tempat Kursus</span>
            </a>
        </div>
        @endcan
        <div class="my-4"></div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Nama Kursus</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Telp</th>
                        <th class="text-center" style="width: 10px">Jumlah Pengunjung</th>

                        @can('tempat-kursus-edit')
                        <th data-orderable="false"></th>
                        @endcan
                        @can('tempat-kursus-delete')
                        <th data-orderable="false"></th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tempatkursus as $index => $result)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            @foreach ($result->kategori as $kategori)
                            <span class="badge badge-primary">{{ $kategori->nama_kategori }}</span>
                            @endforeach
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($result->nama_tempat_kursus)), 50) }}
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($result->alamat)), 100) }}
                        <td>{{ $result->no_telp }}
                        <td>{{ $result->jumlah_pengunjung }}
                        </td>
                        @can('tempat-kursus-edit')
                        <td class="text-center">
                            <a href="{{ route('tempatkursus.edit', ['id' => $result->id_tempat_kursus]) }}" class="btn btn-success text-light btb-circle" id="edit-tempat-kursus">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        @endcan
                        @can('tempat-kursus-delete')
                        <td class="text-center">
                            <a data-id="{!! $result->id_tempat_kursus !!}" data-target="#previewModal-{{ $result->id_tempat_kursus }}" data-toggle="modal" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        @endcan
                        <!-- Modal HTML -->
                        <div class="modal fade" tabindex="-1" id="previewModal-{{ $result->id_tempat_kursus }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger dark">
                                        <h5 class="modal-title w-100 text-light">Hapus Data?</h5>
                                        <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                        <a data-dismiss="modal" class="btn btn-light btn-circle">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin untuk menghapus data? Data yang sudah dihapus tidak
                                            dapat
                                            kembali!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="{{ route('tempatkursus.destroy', ['id' => $result->id_tempat_kursus]) }}" class="btn btn-danger text-light">
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('body-script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
@endsection

@section('footer-script')
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        var buttonCommon = {
            exportOptions: {
                format: {
                    body: function(data, row, column, node) {
                        return data;
                    }
                }
            }
        };

        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength', 'copy', 'print', ,
                $.extend(true, {}, buttonCommon, {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }), 'pdf'
            ],
            lengthChange: true
        });
    });
</script>
@endsection