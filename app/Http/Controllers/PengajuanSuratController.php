<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengajuanSuratController extends Controller
{
    /**
     * Show pengajuan surat form
     */
    public function index()
    {
        $jenisSuratOptions = PengajuanSurat::getJenisSuratOptions();
        return view('public.pengajuan-surat.index', compact('jenisSuratOptions'));
    }

    /**
     * Get required fields for specific jenis surat
     */
    public function getRequiredFields(Request $request)
    {
        $jenisSurat = $request->get('jenis_surat');
        $fields = PengajuanSurat::getRequiredFields($jenisSurat);

        return response()->json([
            'fields' => $fields,
            'jenis_surat' => $jenisSurat
        ]);
    }

    /**
     * Store pengajuan surat
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_surat' => 'required|in:' . implode(',', array_keys(PengajuanSurat::getJenisSuratOptions())),
            'nama' => 'required|string|max:255',
            'nomor_whatsapp' => ['required', 'string', 'regex:/^08[0-9]{10,11}$/'],
            'data_surat' => 'required|array'
        ], [
            'nomor_whatsapp.regex' => 'Nomor WhatsApp harus dimulai dengan 08 dan terdiri dari 12-13 digit.',
            'nomor_whatsapp.regex' => 'Nomor WhatsApp harus dimulai dengan 08 dan hanya berisi angka.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        // Validasi field dinamis berdasarkan jenis surat
        $requiredFields = PengajuanSurat::getRequiredFields($request->jenis_surat);
        $dataSurat = $request->data_surat;

        foreach ($requiredFields as $fieldKey => $fieldLabel) {
            if (empty($dataSurat[$fieldKey])) {
                return redirect()->back()
                               ->withErrors(["data_surat.{$fieldKey}" => "Field {$fieldLabel} wajib diisi"])
                               ->withInput();
            }

            // Validasi khusus untuk NIK
            if ($fieldKey === 'nik') {
                if (!preg_match('/^[0-9]{16}$/', $dataSurat[$fieldKey])) {
                    return redirect()->back()
                                   ->withErrors(["data_surat.{$fieldKey}" => "NIK harus 16 digit angka"])
                                   ->withInput();
                }
            }
        }

        try {
            $pengajuan = PengajuanSurat::create([
                'jenis_surat' => $request->jenis_surat,
                'nama' => $request->nama,
                'nomor_whatsapp' => $request->nomor_whatsapp,
                'data_surat' => $dataSurat,
                'status' => 'pending'
            ]);

            return redirect()->route('public.pengajuan-surat.success', $pengajuan->nomor_pengajuan)
                           ->with('success', 'Pengajuan surat berhasil dikirim');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan pengajuan'])
                           ->withInput();
        }
    }

    /**
     * Show success page after submission
     */
    public function success($nomorPengajuan)
    {
        $pengajuan = PengajuanSurat::where('nomor_pengajuan', $nomorPengajuan)->firstOrFail();
        return view('public.pengajuan-surat.success', compact('pengajuan'));
    }

    /**
     * Track pengajuan surat status
     */
    public function track()
    {
        return view('public.pengajuan-surat.track');
    }

    /**
     * Check status pengajuan
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'nomor_pengajuan' => 'required|string'
        ]);

        $pengajuan = PengajuanSurat::where('nomor_pengajuan', $request->nomor_pengajuan)->first();

        if (!$pengajuan) {
            return response()->json([
                'found' => false,
                'message' => 'Nomor pengajuan tidak ditemukan'
            ]);
        }

        return response()->json([
            'found' => true,
            'data' => [
                'nomor_pengajuan' => $pengajuan->nomor_pengajuan,
                'nama' => $pengajuan->nama,
                'jenis_surat' => $pengajuan->jenis_surat_label,
                'status' => $pengajuan->status,
                'status_label' => $pengajuan->status_label,
                'tanggal_pengajuan' => $pengajuan->tanggal_pengajuan->format('d/m/Y H:i'),
                'tanggal_selesai' => $pengajuan->tanggal_selesai ? $pengajuan->tanggal_selesai->format('d/m/Y H:i') : null,
                'catatan_admin' => $pengajuan->catatan_admin
            ]
        ]);
    }
}
