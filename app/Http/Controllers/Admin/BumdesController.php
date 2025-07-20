<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bumdes;
use App\Models\BumdesUnitUsaha;
use App\Models\BumdesTimManajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BumdesController extends Controller
{
    /**
     * Display BUMDes dashboard
     */
    public function index()
    {
        $bumdes = Bumdes::getActive();
        $unitUsahaCount = $bumdes ? $bumdes->unitUsaha()->count() : 0;
        $timManajemenCount = $bumdes ? $bumdes->timManajemen()->count() : 0;

        return view('admin.bumdes.index', compact('bumdes', 'unitUsahaCount', 'timManajemenCount'));
    }

    /**
     * Show form for creating/editing BUMDes utama
     */
    public function createOrEdit()
    {
        $bumdes = Bumdes::getActive();
        return view('admin.bumdes.form', compact('bumdes'));
    }

    /**
     * Store or update BUMDes utama
     */
    public function storeOrUpdate(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tagline' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'header_title' => 'nullable|string|max:255',
            'header_subtitle' => 'nullable|string|max:255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total_aset' => 'required|numeric|min:0',
            'aset_growth' => 'nullable|numeric',
            'omzet_tahunan' => 'required|numeric|min:0',
            'omzet_growth' => 'nullable|numeric',
            'laba_bersih' => 'required|numeric|min:0',
            'laba_growth' => 'nullable|numeric',
            'anggota_aktif' => 'required|integer|min:0',
            'anggota_growth' => 'nullable|numeric',
            'is_active' => 'boolean'
        ];

        $validated = $request->validate($rules);

        $bumdes = Bumdes::getActive();

        // Handle header image upload
        if ($request->hasFile('header_image')) {
            // Delete old image
            if ($bumdes && $bumdes->header_image && Storage::disk('public')->exists($bumdes->header_image)) {
                Storage::disk('public')->delete($bumdes->header_image);
            }

            $file = $request->file('header_image');
            $filename = time() . '_bumdes_header.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('bumdes', $filename, 'public');
            $validated['header_image'] = $path;
        }

        if ($bumdes) {
            $bumdes->update($validated);
            $message = 'Data BUMDes berhasil diperbarui.';
        } else {
            Bumdes::create($validated);
            $message = 'Data BUMDes berhasil dibuat.';
        }

        return redirect()->route('admin.bumdes.index')->with('success', $message);
    }

    /**
     * Unit Usaha Management
     */
    public function unitUsaha()
    {
        $bumdes = Bumdes::getActive();
        if (!$bumdes) {
            return redirect()->route('admin.bumdes.create-or-edit')->with('error', 'Buat data BUMDes utama terlebih dahulu.');
        }

        $unitUsaha = $bumdes->unitUsaha()->orderBy('urutan')->paginate(10);
        return view('admin.bumdes.unit-usaha.index', compact('bumdes', 'unitUsaha'));
    }

    public function createUnitUsaha()
    {
        $bumdes = Bumdes::getActive();
        if (!$bumdes) {
            return redirect()->route('admin.bumdes.create-or-edit')->with('error', 'Buat data BUMDes utama terlebih dahulu.');
        }

        $statusOptions = BumdesUnitUsaha::getStatusOptions();
        return view('admin.bumdes.unit-usaha.create', compact('bumdes', 'statusOptions'));
    }

    public function storeUnitUsaha(Request $request)
    {
        $bumdes = Bumdes::getActive();
        if (!$bumdes) {
            return redirect()->route('admin.bumdes.create-or-edit')->with('error', 'Buat data BUMDes utama terlebih dahulu.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,berkembang,tidak_aktif',
            'jumlah_anggota' => 'required|integer|min:0',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        $validated['bumdes_id'] = $bumdes->id;
        BumdesUnitUsaha::create($validated);

        return redirect()->route('admin.bumdes.unit-usaha')->with('success', 'Unit usaha berhasil ditambahkan.');
    }

    public function editUnitUsaha(BumdesUnitUsaha $unitUsaha)
    {
        $statusOptions = BumdesUnitUsaha::getStatusOptions();
        return view('admin.bumdes.unit-usaha.edit', compact('unitUsaha', 'statusOptions'));
    }

    public function updateUnitUsaha(Request $request, BumdesUnitUsaha $unitUsaha)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,berkembang,tidak_aktif',
            'jumlah_anggota' => 'required|integer|min:0',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        $unitUsaha->update($validated);

        return redirect()->route('admin.bumdes.unit-usaha')->with('success', 'Unit usaha berhasil diperbarui.');
    }

    public function destroyUnitUsaha(BumdesUnitUsaha $unitUsaha)
    {
        $unitUsaha->delete();
        return redirect()->route('admin.bumdes.unit-usaha')->with('success', 'Unit usaha berhasil dihapus.');
    }

    /**
     * Tim Manajemen Management
     */
    public function timManajemen()
    {
        $bumdes = Bumdes::getActive();
        if (!$bumdes) {
            return redirect()->route('admin.bumdes.create-or-edit')->with('error', 'Buat data BUMDes utama terlebih dahulu.');
        }

        $timManajemen = $bumdes->timManajemen()->orderBy('urutan')->paginate(10);
        return view('admin.bumdes.tim-manajemen.index', compact('bumdes', 'timManajemen'));
    }

    public function createTimManajemen()
    {
        $bumdes = Bumdes::getActive();
        if (!$bumdes) {
            return redirect()->route('admin.bumdes.create-or-edit')->with('error', 'Buat data BUMDes utama terlebih dahulu.');
        }

        return view('admin.bumdes.tim-manajemen.create', compact('bumdes'));
    }

    public function storeTimManajemen(Request $request)
    {
        $bumdes = Bumdes::getActive();
        if (!$bumdes) {
            return redirect()->route('admin.bumdes.create-or-edit')->with('error', 'Buat data BUMDes utama terlebih dahulu.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pengalaman' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bumdes/tim', $filename, 'public');
            $validated['foto'] = $path;
        }

        $validated['bumdes_id'] = $bumdes->id;
        BumdesTimManajemen::create($validated);

        return redirect()->route('admin.bumdes.tim-manajemen')->with('success', 'Tim manajemen berhasil ditambahkan.');
    }

    public function editTimManajemen(BumdesTimManajemen $timManajemen)
    {
        return view('admin.bumdes.tim-manajemen.edit', compact('timManajemen'));
    }

    public function updateTimManajemen(Request $request, BumdesTimManajemen $timManajemen)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pengalaman' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($timManajemen->foto && Storage::disk('public')->exists($timManajemen->foto)) {
                Storage::disk('public')->delete($timManajemen->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bumdes/tim', $filename, 'public');
            $validated['foto'] = $path;
        }

        $timManajemen->update($validated);

        return redirect()->route('admin.bumdes.tim-manajemen')->with('success', 'Tim manajemen berhasil diperbarui.');
    }

    public function destroyTimManajemen(BumdesTimManajemen $timManajemen)
    {
        // Delete foto
        if ($timManajemen->foto && Storage::disk('public')->exists($timManajemen->foto)) {
            Storage::disk('public')->delete($timManajemen->foto);
        }

        $timManajemen->delete();
        return redirect()->route('admin.bumdes.tim-manajemen')->with('success', 'Tim manajemen berhasil dihapus.');
    }
}
