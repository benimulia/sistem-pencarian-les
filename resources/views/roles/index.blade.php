@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mb-4">
            <h2>Manajemen Akses Pengguna</h2>
        </div>
        <div class="pull-right mb-2">
            @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Tambah Role Baru</a>
            @endcan
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th width="280px">Aksi</th>
    </tr>

    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Lihat</a>
            @can('role-edit')
            @if($role->name != 'Super Admin')
            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Ubah</a>
            @endif
            @endcan
            @can('role-delete')
            @if($role->name != 'Super Admin')
            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline','onsubmit' => "return ConfirmDelete()"]) !!}
            {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endif
            @endcan
        </td>
    </tr>
    @endforeach
</table>
{!! $roles->render() !!}
@endsection

@section('footer-script')
<script type="text/javascript">
    var ctext = 'Konfirmasi jika Anda benar ingin menghapus data ini. \n'

    function ConfirmDelete() {

        return confirm(ctext);
    };
</script>
@endsection