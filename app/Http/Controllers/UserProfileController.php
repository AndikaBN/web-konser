<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Konser;
use App\Models\Category;
use App\Models\Pesanan;
use App\Models\Faq;
use App\Models\User;

class UserProfileController extends Controller
{

    public function profile()
    {
        $user = auth()->user();
        // Ambil pesanan pengguna jika ada
        $pesanan = Pesanan::where('user_id', $user->id)->get();

        return view('user.pages.profilePage', compact('user', 'pesanan'));
    }


    public function edit()
    {
        return view('user.pages.profile');
    }

    public function update(Request $request)
    {
        $user = \App\Models\User::find(auth()->id());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function konserUserDashboard()
    {
        $konserTerbaru = Konser::orderBy('created_at', 'desc')->take(2)->get();
        $konserAll = Konser::all();
        $kategori = Category::all();    
        $FAQs = Faq::all();
 

        return view('user.dashboard', compact('konserTerbaru', 'konserAll', 'kategori', 'FAQs'));
    }

    // public function konserByKategori($id)
    // {
    //     $konser = Konser::where('kategori_id', $id)->latest()->take(8)->get();
    //     $kategori = Category::take(4)->get();

    //     dd(compact('konser', 'kategori')); // Cek data yang dikirimkan
    //     return view('user.dashboard', compact('konser', 'kategori'));
    // }
}
