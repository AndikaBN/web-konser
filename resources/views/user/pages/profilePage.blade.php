<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Profil Pengguna</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" class="form-control" value="{{ $user->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
    
                @if($pesanan->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Anda belum memesan tiket konser.
                    </div>
                @else
                    <h5>Pesanan Tiket Anda:</h5>
                    <ul class="list-group">
                        @foreach($pesanan as $item)
                            <li class="list-group-item">
                                Konser: {{ $item->konser->nama }}<br>
                                Status Pesanan: {{ $item->status_pesanan }}<br>
                                Jumlah Tiket: {{ $item->jumlah_tiket }}<br>
                                Total Harga: Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                <a href="{{ route('user.pesanan.download', $item->id) }}" class="btn btn-primary btn-sm float-end">Unduh E-Ticket</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
    
            <div class="card-footer text-end">
                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Update Profil</a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
