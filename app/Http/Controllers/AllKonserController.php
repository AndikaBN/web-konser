<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konser;
use App\Models\Category;
use App\Models\Rekening;

class AllKonserController extends Controller
{
    //index All Konser
    public function index(Request $request)
    {
        $kategori = Category::all(); // Ambil semua kategori
        $selectedCategory = $request->get('kategori'); // Ambil kategori dari query string

        if ($selectedCategory) {
            $konser = Konser::where('category_id', $selectedCategory)->paginate(9); // Filter berdasarkan kategori
        } else {
            $konser = Konser::paginate(9); // Semua konser jika tidak ada filter
        }

        return view('user.pages.allKonser', compact('konser', 'kategori', 'selectedCategory'));
    }

    public function show($id)
    {
        $konser = Konser::findOrFail($id);
        $rekening = Rekening::all();
        return view('user.pages.detail', compact('konser', 'rekening'));
    }
}
