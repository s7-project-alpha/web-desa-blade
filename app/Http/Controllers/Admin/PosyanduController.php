<?php
// app/Http/Controllers/Admin/PosyanduController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posyandu;
use App\Models\PosyanduTenagaKesehatan;
use App\Models\PosyanduKegiatan;
use App\Models\PosyanduLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosyanduController extends Controller
{
    /**
     * Display main posyandu index
     */
    public function index()
    {
        $posyandu = Posyandu::orderBy('nama')->paginate(10);
        $stats = [
            'total_posyandu' => Posyandu::count(),
            'active_posyandu' => Posyandu::active()->count(),
            'total_balita' => Posyandu::active()->sum('total_balita'),
            'total_tenaga_kesehatan' => PosyanduTenagaKesehatan::active()->count(),
            'upcoming_kegiatan' => PosyanduKegiatan::upcoming()->count(),
        ];

        return view('admin.posyandu.index', compact('posyandu', 'stats'));
    }

    /**
     * Show the form for creating a new posyandu
     */
    public function create()
    {
        return view('admin.posyandu.create');
    }

    /**
     * Store a newly created posyandu
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'dusun' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'penanggung_jawab' => 'required|string|max:255',
            'telepon_penanggung_jawab' => 'required|string|max:255',
            'layanan' => 'array',
            'anggota_aktif' => 'integer|min:0',
            'total_balita' => 'integer|min:0',
            'balita_gizi_baik' => 'integer|min:0',
            'cakupan_imunisasi' => 'numeric|min:0|max:100',
            'ibu_hamil_aktif' => 'integer|min:0',
        ]);

        $data = $request->all();
        $data['layanan'] = $request->layanan ?? [];

        Posyandu::create($data);

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    /**
     * Show the form for editing posyandu
     */
    public function edit(Posyandu $posyandu)
    {
        return view('admin.posyandu.edit', compact('posyandu'));
    }

    /**
     * Update posyandu
     */
    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'dusun' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'penanggung_jawab' => 'required|string|max:255',
            'telepon_penanggung_jawab' => 'required|string|max:255',
            'layanan' => 'array',
            'anggota_aktif' => 'integer|min:0',
            'total_balita' => 'integer|min:0',
            'balita_gizi_baik' => 'integer|min:0',
            'cakupan_imunisasi' => 'numeric|min:0|max:100',
            'ibu_hamil_aktif' => 'integer|min:0',
        ]);

        $data = $request->all();
        $data['layanan'] = $request->layanan ?? [];

        $posyandu->update($data);

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data Posyandu berhasil diperbarui.');
    }

    /**
     * Remove posyandu
     */
    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data Posyandu berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Posyandu $posyandu)
    {
        $posyandu->update(['is_active' => !$posyandu->is_active]);

        $status = $posyandu->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "Posyandu {$posyandu->nama} berhasil {$status}.");
    }

    // ===== TENAGA KESEHATAN METHODS =====

    /**
     * Display tenaga kesehatan
     */
    public function tenagaKesehatan()
    {
        $tenagaKesehatan = PosyanduTenagaKesehatan::orderBy('nama')->paginate(10);
        return view('admin.posyandu.tenaga-kesehatan.index', compact('tenagaKesehatan'));
    }

    /**
     * Create tenaga kesehatan
     */
    public function createTenagaKesehatan()
    {
        return view('admin.posyandu.tenaga-kesehatan.create');
    }

    /**
     * Store tenaga kesehatan
     */
    public function storeTenagaKesehatan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gelar' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'pengalaman_tahun' => 'integer|min:0',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('posyandu/tenaga-kesehatan', 'public');
        }

        PosyanduTenagaKesehatan::create($data);

        return redirect()->route('admin.posyandu.tenaga-kesehatan')
            ->with('success', 'Data Tenaga Kesehatan berhasil ditambahkan.');
    }

    /**
     * Edit tenaga kesehatan
     */
    public function editTenagaKesehatan(PosyanduTenagaKesehatan $tenagaKesehatan)
    {
        return view('admin.posyandu.tenaga-kesehatan.edit', compact('tenagaKesehatan'));
    }

    /**
     * Update tenaga kesehatan
     */
    public function updateTenagaKesehatan(Request $request, PosyanduTenagaKesehatan $tenagaKesehatan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gelar' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'pengalaman_tahun' => 'integer|min:0',
            'telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($tenagaKesehatan->foto) {
                Storage::disk('public')->delete($tenagaKesehatan->foto);
            }
            $data['foto'] = $request->file('foto')->store('posyandu/tenaga-kesehatan', 'public');
        }

        $tenagaKesehatan->update($data);

        return redirect()->route('admin.posyandu.tenaga-kesehatan')
            ->with('success', 'Data Tenaga Kesehatan berhasil diperbarui.');
    }

    /**
     * Delete tenaga kesehatan
     */
    public function destroyTenagaKesehatan(PosyanduTenagaKesehatan $tenagaKesehatan)
    {
        if ($tenagaKesehatan->foto) {
            Storage::disk('public')->delete($tenagaKesehatan->foto);
        }

        $tenagaKesehatan->delete();

        return redirect()->route('admin.posyandu.tenaga-kesehatan')
            ->with('success', 'Data Tenaga Kesehatan berhasil dihapus.');
    }

    // ===== KEGIATAN METHODS =====

    /**
     * Display kegiatan
     */
    public function kegiatan()
    {
        $kegiatan = PosyanduKegiatan::with('posyandu')->orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.posyandu.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Create kegiatan
     */
    public function createKegiatan()
    {
        $posyandu = Posyandu::active()->orderBy('nama')->get();
        return view('admin.posyandu.kegiatan.create', compact('posyandu'));
    }

    /**
     * Store kegiatan
     */
    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'posyandu_id' => 'required|exists:posyandu,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'agenda' => 'array',
            'status' => 'required|in:terjadwal,berlangsung,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['agenda'] = $request->agenda ?? [];

        PosyanduKegiatan::create($data);

        return redirect()->route('admin.posyandu.kegiatan')
            ->with('success', 'Kegiatan Posyandu berhasil ditambahkan.');
    }

    /**
     * Edit kegiatan
     */
    public function editKegiatan(PosyanduKegiatan $kegiatan)
    {
        $posyandu = Posyandu::active()->orderBy('nama')->get();
        return view('admin.posyandu.kegiatan.edit', compact('kegiatan', 'posyandu'));
    }

    /**
     * Update kegiatan
     */
    public function updateKegiatan(Request $request, PosyanduKegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'posyandu_id' => 'required|exists:posyandu,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'agenda' => 'array',
            'status' => 'required|in:terjadwal,berlangsung,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['agenda'] = $request->agenda ?? [];

        $kegiatan->update($data);

        return redirect()->route('admin.posyandu.kegiatan')
            ->with('success', 'Kegiatan Posyandu berhasil diperbarui.');
    }

    /**
     * Delete kegiatan
     */
    public function destroyKegiatan(PosyanduKegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('admin.posyandu.kegiatan')
            ->with('success', 'Kegiatan Posyandu berhasil dihapus.');
    }

    // ===== LAYANAN METHODS =====

    /**
     * Display layanan
     */
    public function layanan()
    {
        $layanan = PosyanduLayanan::orderBy('nama_layanan')->paginate(10);
        return view('admin.posyandu.layanan.index', compact('layanan'));
    }

    /**
     * Create layanan
     */
    public function createLayanan()
    {
        return view('admin.posyandu.layanan.create');
    }

    /**
     * Store layanan
     */
    public function storeLayanan(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal' => 'required|string|max:255',
            'target_usia' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        PosyanduLayanan::create($request->all());

        return redirect()->route('admin.posyandu.layanan')
            ->with('success', 'Layanan Posyandu berhasil ditambahkan.');
    }

    /**
     * Edit layanan
     */
    public function editLayanan(PosyanduLayanan $layanan)
    {
        return view('admin.posyandu.layanan.edit', compact('layanan'));
    }

    /**
     * Update layanan
     */
    public function updateLayanan(Request $request, PosyanduLayanan $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jadwal' => 'required|string|max:255',
            'target_usia' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $layanan->update($request->all());

        return redirect()->route('admin.posyandu.layanan')
            ->with('success', 'Layanan Posyandu berhasil diperbarui.');
    }

    /**
     * Delete layanan
     */
    public function destroyLayanan(PosyanduLayanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.posyandu.layanan')
            ->with('success', 'Layanan Posyandu berhasil dihapus.');
    }
}
