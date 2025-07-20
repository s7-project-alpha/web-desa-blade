<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demografi;
use Illuminate\Http\Request;

class DemografiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demografiList = Demografi::orderBy('tahun', 'desc')->paginate(10);
        return view('admin.demografi.index', compact('demografiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.demografi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_penduduk' => 'required|integer|min:0',
            'total_kepala_keluarga' => 'required|integer|min:0',
            'total_laki_laki' => 'required|integer|min:0',
            'total_perempuan' => 'required|integer|min:0',
            'luas_wilayah' => 'required|numeric|min:0',
            'angka_harapan_hidup' => 'required|numeric|min:0|max:150',
            'jumlah_dusun' => 'required|integer|min:0',
            'jumlah_rt' => 'required|integer|min:0',
            'jumlah_rw' => 'required|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'keterangan' => 'nullable|string',
        ]);

        // Validasi total laki-laki + perempuan = total penduduk
        if ($request->total_laki_laki + $request->total_perempuan != $request->total_penduduk) {
            return back()->withErrors(['total_penduduk' => 'Total penduduk harus sama dengan jumlah laki-laki + perempuan'])
                        ->withInput();
        }

        $data = $request->all();

        // Hitung rasio jenis kelamin
        if ($request->total_perempuan > 0) {
            $data['rasio_jenis_kelamin'] = ($request->total_laki_laki / $request->total_perempuan) * 100;
        } else {
            $data['rasio_jenis_kelamin'] = 0;
        }

        // Process JSON data
        $data['distribusi_usia'] = $this->processDistribusiUsia($request);
        $data['tingkat_pendidikan'] = $this->processTingkatPendidikan($request);
        $data['mata_pencaharian'] = $this->processMataPencaharian($request);
        $data['agama'] = $this->processAgama($request);
        $data['status_perkawinan'] = $this->processStatusPerkawinan($request);

        $demografi = Demografi::create($data);

        // If this is set as active, deactivate others
        if ($request->has('is_active')) {
            $demografi->activate();
        }

        return redirect()->route('admin.demografi.index')
            ->with('success', 'Data demografi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demografi $demografi)
    {
        return view('admin.demografi.show', compact('demografi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demografi $demografi)
    {
        return view('admin.demografi.edit', compact('demografi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demografi $demografi)
    {
        $request->validate([
            'total_penduduk' => 'required|integer|min:0',
            'total_kepala_keluarga' => 'required|integer|min:0',
            'total_laki_laki' => 'required|integer|min:0',
            'total_perempuan' => 'required|integer|min:0',
            'luas_wilayah' => 'required|numeric|min:0',
            'angka_harapan_hidup' => 'required|numeric|min:0|max:150',
            'jumlah_dusun' => 'required|integer|min:0',
            'jumlah_rt' => 'required|integer|min:0',
            'jumlah_rw' => 'required|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'keterangan' => 'nullable|string',
        ]);

        // Validasi total laki-laki + perempuan = total penduduk
        if ($request->total_laki_laki + $request->total_perempuan != $request->total_penduduk) {
            return back()->withErrors(['total_penduduk' => 'Total penduduk harus sama dengan jumlah laki-laki + perempuan'])
                        ->withInput();
        }

        $data = $request->all();

        // Hitung rasio jenis kelamin
        if ($request->total_perempuan > 0) {
            $data['rasio_jenis_kelamin'] = ($request->total_laki_laki / $request->total_perempuan) * 100;
        } else {
            $data['rasio_jenis_kelamin'] = 0;
        }

        // Process JSON data
        $data['distribusi_usia'] = $this->processDistribusiUsia($request);
        $data['tingkat_pendidikan'] = $this->processTingkatPendidikan($request);
        $data['mata_pencaharian'] = $this->processMataPencaharian($request);
        $data['agama'] = $this->processAgama($request);
        $data['status_perkawinan'] = $this->processStatusPerkawinan($request);

        $demografi->update($data);

        // If this is set as active, deactivate others
        if ($request->has('is_active')) {
            $demografi->activate();
        } elseif ($demografi->is_active && !$request->has('is_active')) {
            $demografi->update(['is_active' => false]);
        }

        return redirect()->route('admin.demografi.index')
            ->with('success', 'Data demografi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demografi $demografi)
    {
        $demografi->delete();

        return redirect()->route('admin.demografi.index')
            ->with('success', 'Data demografi berhasil dihapus.');
    }

    /**
     * Activate the specified demografi
     */
    public function activate(Demografi $demografi)
    {
        $demografi->activate();

        return redirect()->route('admin.demografi.index')
            ->with('success', 'Data demografi berhasil diaktifkan.');
    }

    /**
     * Process distribusi usia data
     */
    private function processDistribusiUsia($request)
    {
        return [
            '0_5' => (int) $request->input('usia_0_5', 0),
            '6_12' => (int) $request->input('usia_6_12', 0),
            '13_17' => (int) $request->input('usia_13_17', 0),
            '18_25' => (int) $request->input('usia_18_25', 0),
            '26_35' => (int) $request->input('usia_26_35', 0),
            '36_45' => (int) $request->input('usia_36_45', 0),
            '46_55' => (int) $request->input('usia_46_55', 0),
            '56_65' => (int) $request->input('usia_56_65', 0),
            '65_plus' => (int) $request->input('usia_65_plus', 0),
        ];
    }

    /**
     * Process tingkat pendidikan data
     */
    private function processTingkatPendidikan($request)
    {
        return [
            'tidak_sekolah' => (int) $request->input('pendidikan_tidak_sekolah', 0),
            'belum_tamat_sd' => (int) $request->input('pendidikan_belum_tamat_sd', 0),
            'sd' => (int) $request->input('pendidikan_sd', 0),
            'smp' => (int) $request->input('pendidikan_smp', 0),
            'sma' => (int) $request->input('pendidikan_sma', 0),
            'diploma' => (int) $request->input('pendidikan_diploma', 0),
            's1' => (int) $request->input('pendidikan_s1', 0),
            's2' => (int) $request->input('pendidikan_s2', 0),
            's3' => (int) $request->input('pendidikan_s3', 0),
        ];
    }

    /**
     * Process mata pencaharian data
     */
    private function processMataPencaharian($request)
    {
        return [
            'petani' => (int) $request->input('pekerjaan_petani', 0),
            'buruh_tani' => (int) $request->input('pekerjaan_buruh_tani', 0),
            'peternak' => (int) $request->input('pekerjaan_peternak', 0),
            'nelayan' => (int) $request->input('pekerjaan_nelayan', 0),
            'pedagang' => (int) $request->input('pekerjaan_pedagang', 0),
            'wiraswasta' => (int) $request->input('pekerjaan_wiraswasta', 0),
            'pns' => (int) $request->input('pekerjaan_pns', 0),
            'tni_polri' => (int) $request->input('pekerjaan_tni_polri', 0),
            'guru' => (int) $request->input('pekerjaan_guru', 0),
            'bidan_perawat' => (int) $request->input('pekerjaan_bidan_perawat', 0),
            'pensiunan' => (int) $request->input('pekerjaan_pensiunan', 0),
            'tidak_bekerja' => (int) $request->input('pekerjaan_tidak_bekerja', 0),
            'lainnya' => (int) $request->input('pekerjaan_lainnya', 0),
        ];
    }

    /**
     * Process agama data
     */
    private function processAgama($request)
    {
        return [
            'islam' => (int) $request->input('agama_islam', 0),
            'kristen' => (int) $request->input('agama_kristen', 0),
            'katolik' => (int) $request->input('agama_katolik', 0),
            'hindu' => (int) $request->input('agama_hindu', 0),
            'buddha' => (int) $request->input('agama_buddha', 0),
            'khonghucu' => (int) $request->input('agama_khonghucu', 0),
            'lainnya' => (int) $request->input('agama_lainnya', 0),
        ];
    }

    /**
     * Process status perkawinan data
     */
    private function processStatusPerkawinan($request)
    {
        return [
            'belum_kawin' => (int) $request->input('status_belum_kawin', 0),
            'kawin' => (int) $request->input('status_kawin', 0),
            'cerai_hidup' => (int) $request->input('status_cerai_hidup', 0),
            'cerai_mati' => (int) $request->input('status_cerai_mati', 0),
        ];
    }
}
