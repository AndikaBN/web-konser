@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Pesanan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Pesanan</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Daftar Pesanan</h4>
                        <div class="card-header-form">
                            <form method="GET" action="{{ route('admin.pesanan.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari nama user atau konser..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.alert')

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Nama Konser</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Total Harga</th>
                                        <th>Status Pesanan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pesanans as $pesanan)
                                        <tr>
                                            <td>{{ ($pesanans->currentPage() - 1) * $pesanans->perPage() + $loop->iteration }}</td>
                                            <td>{{ $pesanan->user->name }}</td>
                                            <td>{{ $pesanan->konser->nama_konser }}</td>
                                            <td>{{ $pesanan->jumlah_tiket }}</td>
                                            <td>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $pesanan->status_pesanan == 'Lunas' ? 'success' : 'warning' }}">
                                                    {{ $pesanan->status_pesanan }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($pesanan->status_pesanan != 'Lunas')
                                                    <form action="{{ route('admin.pesanan.mark-paid', $pesanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menandai pesanan ini sebagai lunas?')">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm">
                                                            <i class="fas fa-check"></i> Tandai Lunas
                                                        </button>
                                                    </form>
                                                @else
                                                <a href="{{ route('user.pesanan.download', $pesanan->id) }}" class="btn btn-primary">Unduh E-Ticket</a>

                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data pesanan ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $pesanans->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                paging: false,
                info: false,
                searching: false,
                ordering: false,
            });
        });
    </script>
@endpush
