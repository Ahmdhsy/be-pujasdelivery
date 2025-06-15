{{-- resources/views/transaction/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Transaksi')

@section('custom_css')
<style>
    .status-pending { background-color: #FFC107; color: white; padding: 5px 10px; border-radius: 5px; }
    .status-diproses { background-color: #8B4513; color: white; padding: 5px 10px; border-radius: 5px; }
    .status-dalam-pengantaran { background-color: #2196F3; color: white; padding: 5px 10px; border-radius: 5px; }
    .status-btn { margin-left: 10px; padding: 5px 10px; cursor: pointer; }
</style>
@endsection

@section('content')
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
                                    <th>Catatan</th>
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
                                        <td>
                                            {{-- Tambahkan kolom catatan --}}
                                            @foreach ($transaction->items as $item)
                                                @if ($item->catatan)
                                                    {{ $item->catatan }}<br>
                                                @else
                                                    -
                                                @endif
                                            @endforeach
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
@endsection

@section('custom_js')
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
@endsection
