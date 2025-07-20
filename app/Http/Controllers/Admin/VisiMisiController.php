<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visiMisiList = VisiMisi::orderBy('periode_awal', 'desc')->paginate(10);
        return view('admin.visi-misi.index', compact('visiMisiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visi-misi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'nilai_dasar' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'sasaran' => 'nullable|string',
            'periode_awal' => 'required|string|size:4',
            'periode_akhir' => 'required|string|size:4',
        ]);

        $visiMisi = VisiMisi::create($request->all());

        // If this is set as active, deactivate others
        if ($request->has('is_active')) {
            $visiMisi->activate();
        }

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VisiMisi $visiMisi)
    {
        return view('admin.visi-misi.show', compact('visiMisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi)
    {
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'nilai_dasar' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'sasaran' => 'nullable|string',
            'periode_awal' => 'required|string|size:4',
            'periode_akhir' => 'required|string|size:4',
        ]);

        $visiMisi->update($request->all());

        // If this is set as active, deactivate others
        if ($request->has('is_active')) {
            $visiMisi->activate();
        } elseif ($visiMisi->is_active && !$request->has('is_active')) {
            $visiMisi->update(['is_active' => false]);
        }

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil dihapus.');
    }

    /**
     * Activate the specified visi misi
     */
    public function activate(VisiMisi $visiMisi)
    {
        $visiMisi->activate();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil diaktifkan.');
    }
}
