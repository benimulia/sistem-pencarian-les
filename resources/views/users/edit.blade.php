@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ubah Pengguna Baru</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="">Kelola Pengguna</a></li>
                    <li class="breadcrumb-item">Ubah Pengguna Baru</li>
                </ol>
            </nav>
        </div>
        <div class="pull-right mb-4">
            <a class="btn btn-secondary" href="{{ route('users.index') }}"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Gagal!</strong> Ada beberapa masalah dengan input Anda.
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nama','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kata Sandi:</strong>
            {!! Form::password('password', array('placeholder' => 'Kata Sandi','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Konfirmasi Kata Sandi:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Konfirmasi Kata Sandi','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</div>
{!! Form::close() !!}
@endsection