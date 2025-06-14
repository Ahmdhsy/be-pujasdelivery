<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pujas Delivery Admin Dashboard">
    <meta name="author" content="">

    <title>Pujas Delivery - Tenant</title>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('templates/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('templates/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <!-- Custom styles untuk status badges -->
    <style>
        .status-label {
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-pending { background-color: #f6c23e; }
        .badge-diproses { background-color: #36b9cc; }
        .badge-diantar { background-color: #fd7e14; }
        .badge-selesai { background-color: #1cc88a; }
        .badge-dibatalkan { background-color: #e74a3b; }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>

<body id="page-top">

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="mt-2">Memperbarui status...</div>
        </div>
    </div>

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
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link" href="#">
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
                                aria-label="Search" aria-describedby="description">
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
                                aria-labelledby="dropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Cari..." aria-label="Search" aria-describedby="description">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="dropdown">
                                <h6 class="dropdown-header">
                                    Notifikasi
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">April 30, 2025</div>
                                        <span class="font-weight-bold">Laporan bulanan siap diunduh!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">April 28, 2025</div>
                                        <span class="font-weight-bold">Pendapatan hari ini meningkat 20%!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">April 25, 2025</div>
                                        <span class="font-weight-bold">Stok beberapa menu hampir habis!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Notifikasi</a>
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
                                aria-labelledby="dropdown">
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
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Tenant</h1>
                        <a href="{{ route('tenant.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Tenant Baru
                        </a>
                    </div>

                    <!-- Success/Error Messages -->
                    <div id="alertContainer"></div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tenant</h6>
                                </div>
                                <div class="card-body">
                                    @if($tenants->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table align-middle mb-0 bg-white" id="transactionTable">
                                                <thead class="bg-light">
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
                                                    @foreach ($transactions as $transaction)
                                                        <tr id="transaction-row-{{ $transaction->id }}">
                                                            <td>{{ $transaction->id }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://mdbootstrap.com/img/new/avatars/{{ rand(6, 8) }}.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                                                    <div class="ms-3">
                                                                        <p class="fw-bold mb-1">{{ $transaction->user->name ?? 'Tidak ada' }}</p>
                                                                        <p class="text-muted mb-0">{{ $transaction->user->email ?? 'tidak.ada@email.com' }}</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="fw-normal mb-1">{{ $transaction->tenant->name ?? 'Tidak ada' }}</p>
                                                            </td>
                                                            <td>{{ $transaction->gedung->name ?? 'Gedung tidak ditemukan' }}</td>
                                                            <td class="text-left">
                                                                @foreach ($transaction->items as $item)
                                                                    <p class="fw-normal mb-1">{{ $item->menu->name }} ({{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }})</p>
                                                                @endforeach
                                                            </td>
                                                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                                            <td>
                                                                @php
                                                                    $status = strtolower($transaction->status);
                                                                    $badgeClass = [
                                                                        'pending' => 'badge-warning',
                                                                        'diproses' => 'badge-primary',
                                                                        'diantar' => 'badge-info',
                                                                        'selesai' => 'badge-success',
                                                                        'dibatalkan' => 'badge-danger'
                                                                    ][$status] ?? 'badge-secondary';
                                                                @endphp
                                                                <span class="badge {{ $badgeClass }} rounded-pill d-inline">{{ ucfirst($transaction->status) }}</span>
                                                            </td>
                                                            <td>
                                                                @if ($transaction->bukti_pembayaran)
                                                                    <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}" target="_blank" class="btn btn-link btn-sm btn-rounded">
                                                                        Lihat Bukti
                                                                    </a>
                                                                @else
                                                                    <span class="text-muted">Tidak ada</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                                            <td>
                                                                @if ($transaction->status == 'pending')
                                                                    <button class="btn btn-link btn-sm btn-rounded" onclick="updateStatus({{ $transaction->id }}, 'diproses')">Proses</button>
                                                                    <button class="btn btn-link btn-sm btn-rounded text-danger" onclick="updateStatus({{ $transaction->id }}, 'dibatalkan')">Batal</button>
                                                                @elseif ($transaction->status == 'diproses')
                                                                    <button class="btn btn-link btn-sm btn-rounded" onclick="updateStatus({{ $transaction->id }}, 'diantar')">Antar</button>
                                                                @elseif ($transaction->status == 'diantar')
                                                                    <button class="btn btn-link btn-sm btn-rounded" onclick="updateStatus({{ $transaction->id }}, 'selesai')">Selesai</button>
                                                                @else
                                                                    <span class="badge badge-{{ $transaction->status == 'selesai' ? 'success' : 'secondary' }} rounded-pill d-inline">
                                                                        {{ ucfirst($transaction->status) }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-center text-gray-500">Belum ada data tenant</p>
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

    <!-- Custom JavaScript untuk Status Update -->
    <!-- Ganti bagian <script> yang ada dengan ini -->
    <script>
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            
            const alertHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <strong>${type === 'success' ? 'Berhasil!' : 'Error!'}</strong> ${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            `;
            
            alertContainer.innerHTML = alertHTML;
            
            // Auto hide alert after 5 seconds
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        }

        function showLoading(show = true) {
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.style.display = show ? 'flex' : 'none';
        }

        function getStatusButtonHTML(transactionId, status) {
            switch(status.toLowerCase()) {
                case 'pending':
                    return `
                        <button class="btn btn-warning btn-sm mb-1" onclick="updateStatus(${transactionId}, 'diproses')">
                            <i class="fas fa-play"></i> Proses
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="updateStatus(${transactionId}, 'dibatalkan')">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    `;
                case 'diproses':
                    return `
                        <button class="btn btn-success btn-sm" onclick="updateStatus(${transactionId}, 'diantar')">
                            <i class="fas fa-truck"></i> Antar
                        </button>
                    `;
                case 'diantar':
                    return `
                        <button class="btn btn-primary btn-sm" onclick="updateStatus(${transactionId}, 'selesai')">
                            <i class="fas fa-check"></i> Selesai
                        </button>
                    `;
                case 'selesai':
                    return '<span class="badge badge-success">Selesai</span>';
                case 'dibatalkan':
                    return '<span class="badge badge-secondary">Dibatalkan</span>';
                default:
                    return '<span class="badge badge-secondary">-</span>';
            }
        }

        function getStatusBadgeHTML(status) {
            const statusLower = status.toLowerCase();
            const badgeClass = `badge-${statusLower.replace(/ /g, '-')}`;
            return `<span class="badge ${badgeClass}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
        }

        function updateStatus(id, status) {
            const statusText = status.charAt(0).toUpperCase() + status.slice(1);
            
            // Show loading
            showLoading(true);

            fetch(`/transactions/${id}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                showLoading(false);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success || data.message) {
                    // Update UI immediately
                    const row = document.getElementById(`transaction-row-${id}`);
                    if (row) {
                        // Update status badge
                        const statusCell = row.querySelector('td:nth-child(7)');
                        if (statusCell) {
                            statusCell.innerHTML = getStatusBadgeHTML(status);
                        }

                        // Update action buttons
                        const actionCell = row.querySelector('td:last-child');
                        if (actionCell) {
                            actionCell.innerHTML = getStatusButtonHTML(id, status);
                        }
                    }

                    // Show success message
                    showAlert(`Status berhasil diubah menjadi "${statusText}"`, 'success');
                    
                    // Trigger table refresh
                    refreshTable();
                } else {
                    throw new Error(data.error || 'Gagal mengubah status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showLoading(false);
                showAlert('Terjadi kesalahan saat mengubah status: ' + error.message, 'error');
            });
        }

        function refreshTable() {
            showLoading(true);
            
            fetch('/transactions/data', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                showLoading(false);
                const tbody = document.querySelector('#transactionTable tbody');
                tbody.innerHTML = ''; // Clear existing rows

                if (data.transactions && data.transactions.length > 0) {
                    data.transactions.forEach(transaction => {
                        const row = document.createElement('tr');
                        row.id = `transaction-row-${transaction.id}`;
                        row.innerHTML = `
                            <td>${transaction.id}</td>
                            <td>${transaction.user?.name || 'Tidak ada'}</td>
                            <td>${transaction.tenant?.name || 'Tidak ada'}</td>
                            <td>${transaction.gedung?.name || 'Gedung tidak ditemukan'}</td>
                            <td class="text-left">
                                ${transaction.items.map(item => 
                                    `${item.menu.name} (${item.quantity} x Rp ${new Intl.NumberFormat('id-ID').format(item.price)})`
                                ).join('<br>')}
                            </td>
                            <td>Rp ${new Intl.NumberFormat('id-ID').format(transaction.total_price)}</td>
                            <td>${getStatusBadgeHTML(transaction.status)}</td>
                            <td>
                                ${transaction.bukti_pembayaran ? 
                                    `<a href="/storage/${transaction.bukti_pembayaran}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat Bukti
                                    </a>` : 
                                    '<span class="text-muted">Tidak ada</span>'
                                }
                            </td>
                            <td>${new Date(transaction.created_at).toLocaleString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })}</td>
                            <td>${getStatusButtonHTML(transaction.id, transaction.status)}</td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="10" class="text-center text-gray-500">Belum ada data transaksi</td></tr>';
                }
            })
            .catch(error => {
                showLoading(false);
                console.error('Error refreshing table:', error);
                showAlert('Gagal memuat ulang data transaksi', 'error');
            });
        }

        // Auto-refresh table every 30 seconds
        let autoRefreshInterval;

        function startAutoRefresh() {
            autoRefreshInterval = setInterval(() => {
                // Only refresh if no modal is open and no active requests
                if (!document.querySelector('.modal.show') && document.getElementById('loadingOverlay').style.display === 'none') {
                    refreshTable();
                }
            }, 30000); // 30 seconds
        }

        function stopAutoRefresh() {
            if (autoRefreshInterval) {
                clearInterval(autoRefreshInterval);
            }
        }

        // Start auto-refresh when page loads
        document.addEventListener('DOMContentLoaded', function() {
            startAutoRefresh();
        });

        // Stop auto-refresh when page is about to unload
        window.addEventListener('beforeunload', function() {
            stopAutoRefresh();
        });

        // Pause auto-refresh when modal is shown
        $(document).on('shown.bs.modal', function() {
            stopAutoRefresh();
        });

        // Resume auto-refresh when modal is hidden
        $(document).on('hidden.bs.modal', function() {
            startAutoRefresh();
        });
    </script>

</body>

</html>