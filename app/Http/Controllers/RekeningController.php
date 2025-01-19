<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::all();
        return view('admin.rekening.index', compact('rekenings'));
    }

    public function create()
    {
        return view('admin.rekening.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rekening' => 'required|string|max:255',
            'nama_bank' => 'required|string|max:255',
            'logo_bank' => 'nullable|image|mimes:jpg,png,jpeg|max:10240',
        ]);

        if ($request->hasFile('logo_bank')) {
            $validated['logo_bank'] = $request->file('logo_bank')->store('logo_bank', 'public');
        }

        Rekening::create($validated);

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    //destroy
    public function destroy(Rekening $rekening){
        $rekening->delete();
        return redirect()->back()->with('success', 'Rekening berhasil dihapus.');
    }
}