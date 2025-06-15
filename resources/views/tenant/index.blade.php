@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manajemen Tenant</h1>

        <!-- Button to Add New Tenant -->
        <a href="#" class="btn btn-primary mb-3">Tambah Tenant Baru</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Tenant</h6>
            </div>
            <div class="card-body">
                @if($tenants->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pemesan</th>
                                    <th>Email</th>
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
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->user->name ?? 'Tidak ada' }}</td>
                                        <td>{{ $transaction->user->email ?? '[email protected]' }}</td>
                                        <td>{{ $transaction->tenant->name ?? 'Tidak ada' }}</td>
                                        <td>{{ $transaction->gedung->name ?? 'Gedung tidak ditemukan' }}</td>
                                        <td>
                                            @foreach ($transaction->items as $item)
                                                {{ $item->menu->name }} ({{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }})<br>
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
                                            <span class="badge {{ $badgeClass }}">{{ ucfirst($transaction->status) }}</span>
                                        </td>
                                        <td>
                                            @if ($transaction->bukti_pembayaran)
                                                <a href="#" class="btn btn-sm btn-info">Lihat Bukti</a>
                                            @else
                                                Tidak ada
                                            @endif
                                        </td>
                                        <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            @if ($transaction->status == 'pending')
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                                                </form>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger">Batal</button>
                                                </form>
                                            @elseif ($transaction->status == 'diproses')
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-info">Antar</button>
                                                </form>
                                            @elseif ($transaction->status == 'diantar')
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-success">Selesai</button>
                                                </form>
                                            @else
                                                {{ ucfirst($transaction->status) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Belum ada data tenant</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Contoh script untuk DataTables atau lainnya
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush