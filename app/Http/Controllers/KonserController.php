<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class KonserController extends Controller
{
    /**
     * Display a listing of the concerts.
     */
    public function index(Request $request)
    {
        $nama_konser = $request->input('nama_konser'); // Ambil input pencarian

        $konser = Konser::when($nama_konser, function ($query, $nama_konser) {
            $query->where('nama_konser', 'like', '%' . $nama_konser . '%')
                ->orWhere('lokasi', 'like', '%' . $nama_konser . '%');
        })->paginate(10);

        return view('admin.konser.index', compact('konser'));
    }


    /**
     * Show the form for creating a new concert.
     */
    public function create()
    {
        $kategory = Category::all();
        return view('admin.konser.create', compact('kategory'));
    }

    /**
     * Store a newly created concert in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'nama_konser' => 'required|string|max:255',
            'tanggal_konser' => 'required|date',
            'waktu_konser' => 'required',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_tiket' => 'required|numeric|min:0',
            'jumlah_tiket' => 'required|integer|min:1',
            'promosi_diskon' => 'nullable|string',
            'gambar_konser' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status_konser' => 'required|string',
        ]);

        if ($request->hasFile('gambar_konser')) {
            $validated['gambar_konser'] = $request->file('gambar_konser')->store('konser_images', 'public');
        }

        Konser::create($validated);

        return redirect()->route('konser.index')->with('success', 'Konser berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified concert.
     */
    public function edit($id)
    {
        $konser = Konser::findOrFail($id);
        $category = Category::all();
        return view('admin.konser.edit', compact('konser', 'category'));
    }

    /**
     * Update the specified concert in the database.
     */
    public function update(Request $request, Konser $konser)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'nama_konser' => 'required|string|max:255',
            'tanggal_konser' => 'required|date',
            'waktu_konser' => 'required',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_tiket' => 'required|numeric|min:0',
            'jumlah_tiket' => 'required|integer|min:1',
            'promosi_diskon' => 'nullable|string',
            'gambar_konser' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status_konser' => 'required|string',
        ]);

        if ($request->hasFile('gambar_konser')) {
            $validated['gambar_konser'] = $request->file('gambar_konser')->store('konser_images', 'public');
        }

        $konser->update($validated);

        return redirect()->route('konser.index')->with('success', 'Konser berhasil diperbarui.');
    }

    /**
     * Remove the specified concert from the database.
     */
    public function destroy(Konser $konser)
    {
        if ($konser->gambar_konser) {
            Storage::delete('public/' . $konser->gambar_konser);
        }

        $konser->delete();

        return redirect()->route('konser.index')->with('success', 'Konser berhasil dihapus.');
    }
}
