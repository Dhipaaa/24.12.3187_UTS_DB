<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    // READ - Tampilkan daftar partner dengan search
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        
        if ($search) {
            $partners = Partner::where('name', 'LIKE', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $partners = Partner::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('admin.partners.index', compact('partners', 'search'));
    }

    // CREATE - Tampilkan form tambah partner
    public function create()
    {
        return view('admin.partners.create');
    }

    // STORE - Simpan partner baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|string|max:255',
        ]);

        Partner::create($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan');
    }

    // EDIT - Tampilkan form edit partner
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.edit', compact('partner'));
    }

    // UPDATE - Update partner
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|string|max:255',
        ]);

        $partner->update($validated);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui');
    }

    // DELETE - Hapus partner
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus');
    }
}