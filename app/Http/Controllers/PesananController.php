<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Konser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Rekening;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    /**
     * Display a listing of orders for admin.
     */
    public function indexAdmin()
    {
        $pesanans = Pesanan::with('user', 'konser')->paginate(10);
        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Display a listing of orders for a specific user.
     */
    public function indexUser()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())->with('konser')->get();
        return view('user.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $konser = Konser::all();
        return view('user.pesanan.create', compact('konser'));
    }


    public function show($id)
    {
        $konser = Konser::with('category')->findOrFail($id);
        $rekenings = Rekening::all();
        return view('user.pages.detail', compact('konser', 'rekenings'));
    }

    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'konser_id' => 'required|exists:konser,id',
            'rekening_id' => 'required|exists:rekening,id',
            'jumlah_tiket' => 'required|integer|min:1',
            'bukti_bayar' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Hitung total harga
        $konser = Konser::findOrFail($request->konser_id);
        $validated['total_harga'] = $konser->harga_tiket * $request->jumlah_tiket;

        // Simpan bukti bayar
        if ($request->hasFile('bukti_bayar')) {
            $validated['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        // Tambahkan user_id ke data validasi
        $validated['user_id'] = auth()->id();

        Pesanan::create($validated);

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat. Menunggu konfirmasi pembayaran.');
    }

    /**
     * Mark the order as paid by admin.
     */

    public function markAsPaid(Pesanan $pesanan)
    {
        // Update status pesanan menjadi "Lunas"
        $pesanan->update(['status_pesanan' => 'Lunas']);

        // Membuat PDF e-ticket
        $pdf = PDF::loadView('e_ticket', compact('pesanan'));

        // Simpan e-ticket ke storage
        $filePath = 'e_tickets/eticket_' . $pesanan->id . '.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil ditandai sebagai lunas.');
    }



    /**
     * Allow user to download their e-ticket.
     */
    public function downloadETicket(Pesanan $pesanan)
    {
        if ($pesanan->user_id != auth()->id() || $pesanan->status_pesanan != 'Lunas') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Path ke e-ticket
        $filePath = 'public/e_tickets/eticket_' . $pesanan->id . '.pdf';

        if (!Storage::exists($filePath)) {
            abort(404, 'E-Ticket tidak ditemukan.');
        }

        return Storage::download($filePath);
    }
}
