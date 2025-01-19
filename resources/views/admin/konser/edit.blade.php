@extends('layouts.app')

@section('title', 'Edit Konser')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Konser</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Konser</a></div>
                    <div class="breadcrumb-item">Edit Konser</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('konser.update', $konser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Form Edit Konser</h4>
                        </div>
                        <div class="card-body">
                            @include('layouts.alert')

                            <div class="form-group">
                                <label>Nama Konser</label>
                                <input type="text" name="nama_konser" class="form-control @error('nama_konser') is-invalid @enderror" value="{{ old('nama_konser', $konser->nama_konser) }}">
                                @error('nama_konser') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Konser</label>
                                <input type="date" name="tanggal_konser" class="form-control @error('tanggal_konser') is-invalid @enderror" value="{{ old('tanggal_konser', $konser->tanggal_konser ? $konser->tanggal_konser->format('Y-m-d') : '') }}">
                                @error('tanggal_konser') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Waktu Konser</label>
                                <input type="time" name="waktu_konser" class="form-control @error('waktu_konser') is-invalid @enderror" value="{{ old('waktu_konser', $konser->waktu_konser ? $konser->waktu_konser->format('H:i') : '') }}">
                                @error('waktu_konser') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $konser->lokasi) }}">
                                @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $konser->deskripsi) }}</textarea>
                                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Tiket</label>
                                <input type="number" name="harga_tiket" class="form-control @error('harga_tiket') is-invalid @enderror" value="{{ old('harga_tiket', $konser->harga_tiket) }}">
                                @error('harga_tiket') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($category as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('category_id', $konser->category_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Jumlah Tiket</label>
                                <input type="number" name="jumlah_tiket" class="form-control @error('jumlah_tiket') is-invalid @enderror" value="{{ old('jumlah_tiket', $konser->jumlah_tiket) }}">
                                @error('jumlah_tiket') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Promosi Diskon</label>
                                <input type="text" name="promosi_diskon" class="form-control @error('promosi_diskon') is-invalid @enderror" value="{{ old('promosi_diskon', $konser->promosi_diskon) }}">
                                @error('promosi_diskon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Gambar Konser</label>
                                <input type="file" name="gambar_konser" class="form-control @error('gambar_konser') is-invalid @enderror">
                                @if ($konser->gambar_konser)
                                    <img src="{{ asset('storage/' . $konser->gambar_konser) }}" alt="Gambar Konser" class="img-thumbnail mt-2" width="150">
                                @endif
                                @error('gambar_konser') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Status Konser</label>
                                <select name="status_konser" class="form-control @error('status_konser') is-invalid @enderror">
                                    <option value="Aktif" {{ old('status_konser', $konser->status_konser) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status_konser', $konser->status_konser) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status_konser') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
