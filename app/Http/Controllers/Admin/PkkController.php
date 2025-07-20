<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pkk;
use App\Models\PkkProgramKerja;
use App\Models\PkkPengurus;
use App\Models\PkkKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PkkController extends Controller
{
    /**
     * Display PKK management dashboard
     */
    public function index()
    {
        $pkk = Pkk::first();
        $stats = [
            'program_kerja' => PkkProgramKerja::count(),
            'program_aktif' => PkkProgramKerja::active()->count(),
            'pengurus' => PkkPengurus::count(),
            'pengurus_aktif' => PkkPengurus::active()->count(),
            'kegiatan' => PkkKegiatan::count(),
            'kegiatan_mendatang' => PkkKegiatan::upcoming()->count(),
        ];

        return view('admin.pkk.index', compact('pkk', 'stats'));
    }

    /**
     * Show form to create or edit PKK main data
     */
    public function createOrEdit()
    {
        $pkk = Pkk::first();
        return view('admin.pkk.create-or-edit', compact('pkk'));
    }

    /**
     * Store or update PKK main data
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'slogan' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'anggota_aktif' => 'required|integer|min:0',
            'program_aktif' => 'required|integer|min:0',
            'kegiatan_per_tahun' => 'required|integer|min:0',
            'pokja_aktif' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $pkk = Pkk::first();
        if ($pkk) {
            $pkk->update($data);
            $message = 'Data PKK berhasil diperbarui';
        } else {
            Pkk::create($data);
            $message = 'Data PKK berhasil dibuat';
        }

        return redirect()->route('admin.pkk.index')->with('success', $message);
    }

    // ==================== PROGRAM KERJA ====================

    /**
     * Display program kerja list
     */
    public function programKerja()
    {
        $programKerja = PkkProgramKerja::orderBy('urutan', 'asc')->get();
        return view('admin.pkk.program-kerja.index', compact('programKerja'));
    }

    /**
     * Show form to create program kerja
     */
    public function createProgramKerja()
    {
        return view('admin.pkk.program-kerja.create');
    }

    /**
     * Store program kerja
     */
    public function storeProgramKerja(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kegiatan' => 'required|array',
            'kegiatan.*' => 'required|string',
            'peserta_aktif' => 'required|integer|min:0',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        PkkProgramKerja::create($data);

        return redirect()->route('admin.pkk.program-kerja')->with('success', 'Program kerja berhasil ditambahkan');
    }

    /**
     * Show form to edit program kerja
     */
    public function editProgramKerja(PkkProgramKerja $programKerja)
    {
        return view('admin.pkk.program-kerja.edit', compact('programKerja'));
    }

    /**
     * Update program kerja
     */
    public function updateProgramKerja(Request $request, PkkProgramKerja $programKerja)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kegiatan' => 'required|array',
            'kegiatan.*' => 'required|string',
            'peserta_aktif' => 'required|integer|min:0',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $programKerja->update($data);

        return redirect()->route('admin.pkk.program-kerja')->with('success', 'Program kerja berhasil diperbarui');
    }

    /**
     * Delete program kerja
     */
    public function destroyProgramKerja(PkkProgramKerja $programKerja)
    {
        $programKerja->delete();
        return redirect()->route('admin.pkk.program-kerja')->with('success', 'Program kerja berhasil dihapus');
    }

    // ==================== PENGURUS ====================

    /**
     * Display pengurus list
     */
    public function pengurus()
    {
        $pengurus = PkkPengurus::orderBy('urutan', 'asc')->get();
        return view('admin.pkk.pengurus.index', compact('pengurus'));
    }

    /**
     * Show form to create pengurus
     */
    public function createPengurus()
    {
        return view('admin.pkk.pengurus.create');
    }

    /**
     * Store pengurus
     */
    public function storePengurus(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'tugas' => 'nullable|string',
            'periode_mulai' => 'nullable|string|max:4',
            'periode_selesai' => 'nullable|string|max:4',
            'urutan' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pkk/pengurus', 'public');
        }

        PkkPengurus::create($data);

        return redirect()->route('admin.pkk.pengurus')->with('success', 'Pengurus berhasil ditambahkan');
    }

    /**
     * Show form to edit pengurus
     */
    public function editPengurus(PkkPengurus $pengurus)
    {
        return view('admin.pkk.pengurus.edit', compact('pengurus'));
    }

    /**
     * Update pengurus
     */
    public function updatePengurus(Request $request, PkkPengurus $pengurus)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'tugas' => 'nullable|string',
            'periode_mulai' => 'nullable|string|max:4',
            'periode_selesai' => 'nullable|string|max:4',
            'urutan' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('pkk/pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->route('admin.pkk.pengurus')->with('success', 'Pengurus berhasil diperbarui');
    }

    /**
     * Delete pengurus
     */
    public function destroyPengurus(PkkPengurus $pengurus)
    {
        // Delete foto if exists
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();
        return redirect()->route('admin.pkk.pengurus')->with('success', 'Pengurus berhasil dihapus');
    }

    // ==================== KEGIATAN ====================

    /**
     * Display kegiatan list
     */
    public function kegiatan()
    {
        $kegiatan = PkkKegiatan::orderBy('tanggal', 'desc')->get();
        return view('admin.pkk.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Show form to create kegiatan
     */
    public function createKegiatan()
    {
        return view('admin.pkk.kegiatan.create');
    }

    /**
     * Store kegiatan
     */
    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'jumlah_peserta' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:akan_datang,sedang_berlangsung,selesai',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pkk/kegiatan', 'public');
        }

        PkkKegiatan::create($data);

        return redirect()->route('admin.pkk.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Show form to edit kegiatan
     */
    public function editKegiatan(PkkKegiatan $kegiatan)
    {
        return view('admin.pkk.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update kegiatan
     */
    public function updateKegiatan(Request $request, PkkKegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'jumlah_peserta' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:akan_datang,sedang_berlangsung,selesai',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pkk/kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.pkk.kegiatan')->with('success', 'Kegiatan berhasil diperbarui');
    }

    /**
     * Delete kegiatan
     */
    public function destroyKegiatan(PkkKegiatan $kegiatan)
    {
        // Delete foto if exists
        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();
        return redirect()->route('admin.pkk.kegiatan')->with('success', 'Kegiatan berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Request $request, $type, $id)
    {
        $model = match($type) {
            'program-kerja' => PkkProgramKerja::findOrFail($id),
            'pengurus' => PkkPengurus::findOrFail($id),
            'kegiatan' => PkkKegiatan::findOrFail($id),
            default => abort(404)
        };

        $model->toggleActive();

        return response()->json(['success' => true]);
    }
}
