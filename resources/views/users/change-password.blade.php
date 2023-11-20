@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

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

        @if ($errors->any())
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong>
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


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ubah Kata Sandi') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('change-password-post') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi Lama') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Sandi Baru') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Kata Sandi Baru') }}</label>

                            <div class="col-md-6">
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Ubah Kata Sandi') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection