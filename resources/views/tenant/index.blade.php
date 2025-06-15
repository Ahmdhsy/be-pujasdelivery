@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manajemen Tenant</h1>

    <!-- Tombol Tambah Tenant Baru -->
    <a href="{{ route('tenant.create') }}" class="btn btn-primary mb-3">Tambah Tenant Baru</a>

    <!-- Tabel Tenant -->
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
                                <th>Nama Tenant</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td>{{ $tenant->id }}</td>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->phone ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $tenant->status === 'active' ? 'badge-success' : 'badge-secondary' }}">
                                            {{ ucfirst($tenant->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('tenant.edit', $tenant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus tenant ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Belum ada data tenant.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush
