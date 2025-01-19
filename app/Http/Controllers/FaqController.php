<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    //index
    public function index()
    {
        $FAQs = Faq::paginate(10);
        return view('admin.faq.index', compact('FAQs'));
    }

    //create
    public function create()
    {
        return view('admin.faq.create');
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($validated);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    //destroy
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil dihapus.');
    }


    // view user
    
}
