@extends('layouts.app')

@section('title', 'Daftar Konser')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Konser</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Konser</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Daftar Konser</h4>
                        <div>
                            <a href="{{ route('konser.create') }}" class="btn btn-primary">Add New</a>
                        </div>
                        <div class="card-header-form">
                            <form method="GET" action="{{ route('konser.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nama_konser" placeholder="Cari konser atau lokasi..." value="{{ request('nama_konser') }}">
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
                                        <th>Nama Konser</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Harga Tiket</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($konser as $item)
                                        <tr>
                                            <td>{{ ($konser->currentPage() - 1) * $konser->perPage() + $loop->iteration }}</td>
                                            <td>{{ $item->nama_konser }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_konser)->format('d M Y') }}</td>
                                            <td>{{ $item->lokasi }}</td>
                                            <td>Rp{{ number_format($item->harga_tiket, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $item->status_konser == 'Aktif' ? 'success' : 'danger' }}">
                                                    {{ $item->status_konser }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('konser.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('konser.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus konser ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data konser ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $konser->withQueryString()->links() }}
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
