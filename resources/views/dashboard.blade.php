@extends('layouts.app')

@section('title', 'Dashboard - Pujas Delivery')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, Admin!</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Unduh Laporan
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Tenant Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Tenant</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTenant }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Menu Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Menu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMenu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-utensils fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenant Aktif Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tenant Aktif
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $tenantActivePercentage }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $tenantActivePercentage }}%" aria-valuenow="{{ $tenantActivePercentage }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-rata Harga Menu Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Rata-rata Harga Menu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($averagePrice, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Row -->
    <div class="row">
        <!-- Menu Berdasarkan Kategori -->
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Menu Berdasarkan Kategori</h6>
                </div>
                <div class="card-body">
                    @if($menusByCategory->count() > 0)
                        @foreach($menusByCategory as $category)
                        <div class="mb-3">
                            <div class="small text-gray-500">{{ $category->category ?? 'Tidak Berkategori' }}
                                <div class="small float-right"><b>{{ $category->count }} menu</b></div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ ($category->count / $totalMenu) * 100 }}%"
                                    aria-valuenow="{{ ($category->count / $totalMenu) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">Belum ada data menu</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Menu Terbaru -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Menu Terbaru</h6>
                </div>
                <div class="card-body">
                    @if($recentMenus->count() > 0)
                        @foreach($recentMenus as $menu)
                        <div class="d-flex align-items-center border-bottom py-2">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-utensils text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-gray-500">{{ $menu->tenant->name ?? 'Tenant tidak ditemukan' }}</div>
                                <div class="font-weight-bold">{{ $menu->nama }}</div>
                                <div class="text-xs text-success">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">Belum ada menu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('templates/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ asset('templates/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('templates/js/demo/chart-pie-demo.js') }}"></script>
@endpush
@endsection