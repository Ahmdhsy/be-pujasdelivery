<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pujas Delivery Admin Dashboard">
    <meta name="author" content="">

    <title>Pujas Delivery - Transaksi</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('templates/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('templates/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom CSS for Status Colors -->
    <style>
        .status-pending { background-color: #FFC107; color: white; padding: 5px 10px; border-radius: 5px; }
        .status-diproses { background-color: #8B4513; color: white; padding: 5px 10px; border-radius: 5px; }
        .status-dalam-pengantaran { background-color: #2196F3; color: white; padding: 5px 10px; border-radius: 5px; }
        .status-btn { margin-left: 10px; padding: 5px 10px; cursor: pointer; }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pujas Delivery</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen
            </div>

            <!-- Nav Item - Tenant -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tenant.index') }}">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Tenant</span></a>
            </li>

            <!-- Nav Item - Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.index') }}">
                    <i class="fas fa-fw fa-hamburger"></i>
                    <span>Menu</span>
                </a>
            </li>

            <!-- Nav Item - Orders -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('transaction.index') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Pesanan</span></a>
            </li>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pengguna</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Laporan
            </div>

            <!-- Nav Item - Sales Report -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan Penjualan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Cari..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('templates/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Transaksi</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                                </div>
                                <div class="card-body">
                                    @if($transactions->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Pemesan</th>
                                                        <th>Tenant</th>
                                                        <th>Gedung</th>
                                                        <th>Item</th>
                                                        <th>Total Harga</th>
                                                        <th>Status</th>
                                                        <th>Bukti Pembayaran</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($transactions as $transaction)
                                                        <tr>
                                                            <td>{{ $transaction->id }}</td>
                                                            <td>{{ $transaction->user->name ?? 'User tidak ditemukan' }}</td>
                                                            <td>{{ $transaction->tenant->name ?? 'Tenant tidak ditemukan' }}</td>
                                                            <td>{{ $transaction->gedung->name ?? 'Gedung tidak ditemukan' }}</td>
                                                            <td>
                                                                <ul class="list-unstyled mb-0">
                                                                    @foreach($transaction->items as $item)
                                                                        <li class="small">{{ $item->menu->nama ?? 'Menu tidak ditemukan' }} ({{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }})</li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                                            <td>
                                                                <span class="status-{{ str_replace(' ', '-', strtolower($transaction->status)) }}">
                                                                    {{ ucfirst($transaction->status) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @if($transaction->bukti_pembayaran)
                                                                    <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                                                        <i class="fas fa-eye"></i> Lihat Bukti
                                                                    </a>
                                                                @else
                                                                    <span class="text-muted">Tidak ada</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                                            <td>
                                                                @if($transaction->status === 'pending')
                                                                    <form action="{{ route('transaction.updateStatus', $transaction->id) }}" method="POST" onsubmit="return confirm('Ubah status menjadi Diproses?');">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status" value="diproses">
                                                                        <button type="submit" class="btn btn-warning btn-sm">Proses</button>
                                                                    </form>
                                                                @elseif($transaction->status === 'diproses')
                                                                    <form action="{{ route('transaction.updateStatus', $transaction->id) }}" method="POST" onsubmit="return confirm('Ubah status menjadi Dalam Pengantaran?');">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status" value="dalam pengantaran">
                                                                        <button type="submit" class="btn btn-success btn-sm">Antar</button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <div class="mb-3">
                                                <i class="fas fa-shopping-cart fa-3x text-gray-300"></i>
                                            </div>
                                            <p class="text-gray-500">Belum ada data transaksi</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Pujas Delivery 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda ingin mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('templates/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates/js/sb-admin-2.min.js') }}"></script>

    <!-- Custom JavaScript for Status Update -->
    <script>
        function updateStatus(transactionId, newStatus) {
            if (confirm('Yakin ingin mengubah status transaksi?')) {
                fetch(`/transactions/${transactionId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Status updated') {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
    <!-- Ensure CSRF token is included in the head -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>

</html>