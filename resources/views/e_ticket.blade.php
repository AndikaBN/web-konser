<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>E-Ticket</h2>
        <p>Order ID: {{ $pesanan->id }}</p>
    </div>
    <div class="content">
        <p><strong>Nama Pemesan:</strong> {{ $pesanan->user->name }}</p>
        <p><strong>Email:</strong> {{ $pesanan->user->email }}</p>
        <p><strong>Konser:</strong> {{ $pesanan->konser->nama_konser }}</p>
        <p><strong>Tanggal Konser:</strong> {{ $pesanan->konser->tanggal_konser }}</p>
        <p><strong>Jam Konser:</strong> {{ $pesanan->konser->waktu_konser }}</p>
        <p><strong>Tanggal Pemesanan:</strong> {{ $pesanan->created_at->format('d-m-Y') }}</p>
        <p><strong>Jumlah:</strong> {{ $pesanan->jumlah_tiket }}</p>
    </div>
    <div class="footer">
        <p>Terima kasih telah memesan. Harap simpan e-ticket ini untuk keperluan verifikasi.</p>
        <p>Jangan lewatkan ya {{ $pesanan->konser->nama_konser }} pada Tanggal {{ $pesanan->konser->tanggal_konser }} di jam {{ $pesanan->konser->waktu_konser }}.</p>
    </div>
</body>
</html>
