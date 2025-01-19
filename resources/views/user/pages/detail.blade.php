<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konser</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <!-- Gambar Konser -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $konser->gambar_konser) }}" class="img-fluid rounded" alt="{{ $konser->nama_konser }}">
            </div>

            <!-- Detail Konser dan Form -->
            <div class="col-md-6">
                <h1>{{ $konser->nama_konser }}</h1>
                <p>{{ $konser->deskripsi }}</p>
                <h4 class="text-primary">
                    @if($konser->promosi_diskon > 0)
                        <span class="text-decoration-line-through">Rp{{ number_format($konser->harga_tiket, 0, ',', '.') }}</span>
                        Rp{{ number_format($konser->harga_tiket - ($konser->harga_tiket * $konser->promosi_diskon / 100), 0, ',', '.') }}
                    @else
                        Rp{{ number_format($konser->harga_tiket, 0, ',', '.') }}
                    @endif
                </h4>

                <form method="POST" action="{{ route('pesanan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="konser_id" value="{{ $konser->id }}">
                    <div class="mb-3">
                        <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" id="jumlah_tiket" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekening_id" class="form-label">Pilih Rekening Pembayaran</label>
                        <select name="rekening_id" id="rekening_id" class="form-select" required>
                            <option value="">Pilih Rekening</option>
                            @foreach($rekenings as $rekening)
                                <option value="{{ $rekening->id }}">
                                    {{ $rekening->nama_bank }} - {{ $rekening->nomor_rekening }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bukti_bayar" class="form-label">Unggah Bukti Bayar</label>
                        <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
