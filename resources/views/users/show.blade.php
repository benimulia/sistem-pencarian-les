@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Tampilan Pengguna</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="">Kelola Pengguna</a></li>
                    <li class="breadcrumb-item">Tampilan Pengguna</li>
                </ol>
            </nav>
        </div>
        <div class="pull-right mb-4">
            <a class="btn btn-secondary" href="{{ route('users.index') }}"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Namea:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <span class="badge rounded-pill bg-warning">{{ $v }}</span>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection