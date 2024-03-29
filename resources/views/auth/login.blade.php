<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{{ asset('utama/img/icon.png') }}">
    <title>Login | SIPTKA </title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- <style>
        #btn-register {
            background-color: #fe5d37;
            color: white;
        }
    </style> -->
</head>

<body class="bg-gradient-none">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Email atau password yang Anda masukkan salah.<br><br>
                    </div>
                    @endif
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-6 p-4 d-none d-lg-block">
                                <a href="/" class="navbar-brand"><img src="{{asset('img/logo.jpg')}}" style="height: 80px;width: 350px;" alt=""></a>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ old('email') }}" required autofocus aria-describedby="emailHelp" placeholder="Masukan Email...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                                        </div>
                                        <div class="form-group">
                                            {{-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div> --}}
                                        </div>
                                        <button type="submit" id="btn-register" name="btn-register" class="btn btn-user btn-block" style="background-color:  #fe5d37; color:white">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <p class="small">SIPTKA ©</p>
                                        {{-- <a class="small" href="{{ route('password.request') }}">Lupa Kata Sandi?</a> --}}
                                    </div>
                                    <div class="text-center">
                                        <p class="small">Belum punya akun? <a href="{{ route('register') }}">Buat akun!</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>