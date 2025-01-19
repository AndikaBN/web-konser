@extends('layouts.app')

@section('title', 'Rekening')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rekening</h1>
                <div class="section-header-button">
                    <a href="{{ route('rekening.create') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Rekekning</h2>
                <p class="section-lead">
                    You can manage all Rekekning, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Nomor Rekening</th>
                                            <th>Nama Bank</th>
                                            <th>Logo Bank</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($rekenings as $rekening)
                                            <tr>

                                                <td>{{ $rekening->nomor_rekening }}
                                                </td>
                                                <td>
                                                    {{ $rekening->nama_bank }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $rekening->logo_bank) }}" alt="logo bank" width="100">
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <form action="{{ route('rekening.destroy', $rekening->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
