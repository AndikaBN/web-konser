@extends('layouts.app')

@section('title', 'Add User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form Rekening</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Rekenings</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Rekenings     </h2>



                <div class="card">
                    <form action="{{ route('rekening.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="text"
                                class="form-control @error('nomor_rekening') is-invalid @enderror"
                                name="nomor_rekening" value="{{ old('nomor_rekening') }}">
                            @error('nomor_rekening')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text"
                                name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" value="{{ old('nama_bank') }}">
                            @error('nama_bank') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Logo Bank</label>
                            <input type="file" name="logo_bank" class="form-control @error('logo_bank') is-invalid @enderror">
                            @error('logo_bank') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
