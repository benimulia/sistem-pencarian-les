@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ubah Role Pengguna</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="">Kelola Role</a></li>
                    <li class="breadcrumb-item">Ubah Role Pengguna</li>
                </ol>
            </nav>
        </div>
        <div class="pull-right mb-4">
            <a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Gagagl!</strong>Ada beberapa masalah dengan input Anda<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
        <div class="form-group">
            <strong>Nama:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
        <div class="form-group">
            <div class="row ml-0 mb-2">
                <a class="btn btn-info mr-2" onclick="selects()">Select All</a>
                <a class="btn btn-dark" onclick="deSelect()">Deselect All</a>
            </div>
            <strong>Permission:</strong>
            <br />
            @foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br />
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('footer-script')
<script type="text/javascript">
    function selects() {
        var ele = document.getElementsByName('permission[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = true;
        }
    }

    function deSelect() {
        var ele = document.getElementsByName('permission[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = false;

        }
    }
</script>

@endsection