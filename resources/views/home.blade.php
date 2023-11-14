@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>
    <div class="row">
        @if ($userrole == 1)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Akun Belum Diverifikasi</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Jumlah akun yang perlu diverifikasi oleh admin.
                        </h6>
                        <p class="card-text">
                            Jumlah: <span class="text-primary">{{ $unverified }}</span>
                        </p>
                        <a href="/users" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
        @else
        @endif


    </div>

    {{-- @can('dashboard')
        
    @endcan --}}
@endsection

@section('body-script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
    </script>
@endsection
