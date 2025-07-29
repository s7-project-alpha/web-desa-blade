<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of pengajuan surat
     */
    public function index(Request $request)
    {
        $query = PengajuanSurat::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat')) {
            $query->byJenisSurat($request->jenis_surat);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_pengajuan', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_whatsapp', 'like', "%{$search}%");
            });
        }

        $pengajuanSurat = $query->latest()->paginate(10)->withQueryString();
        $statistics = PengajuanSurat::getStatistics();
        $jenisSuratOptions = PengajuanSurat::getJenisSuratOptions();

        return view('admin.pengajuan-surat.index', compact(
            'pengajuanSurat',
            'statistics',
            'jenisSuratOptions'
        ));
    }

    /**
     * Display the specified pengajuan surat
     */
    public function show(PengajuanSurat $pengajuanSurat)
    {
        return view('admin.pengajuan-surat.show', compact('pengajuanSurat'));
    }

    /**
     * Update status pengajuan surat
     */
    public function updateStatus(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        $pengajuanSurat->updateStatus($request->status, $request->catatan_admin);

        // TODO: Kirim notifikasi WhatsApp jika status selesai
        if ($request->status === 'selesai') {
            $this->sendWhatsAppNotification($pengajuanSurat);
        }

        return redirect()->route('admin.pengajuan-surat.index')->with('success', 'Status pengajuan berhasil diperbarui');
    }

    /**
     * Remove the specified pengajuan surat from storage
     */
    public function destroy(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->delete();
        return redirect()->route('admin.pengajuan-surat.index')
                        ->with('success', 'Pengajuan surat berhasil dihapus');
    }

    /**
     * Export pengajuan surat to Excel
     */
    public function export(Request $request)
    {
        // TODO: Implement export functionality
        return response()->json(['message' => 'Export functionality coming soon']);
    }

    /**
     * PERBAIKAN: Bulk update status dengan error handling yang lebih baik
     */
    public function bulkUpdateStatus(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'ids' => 'required|array|min:1',
                'ids.*' => 'exists:pengajuan_surat,id',
                'status' => 'required|in:pending,diproses,selesai,ditolak',
                'catatan_admin' => 'nullable|string|max:1000'
            ]);

            // Ambil pengajuan yang akan diupdate
            $pengajuanSurat = PengajuanSurat::whereIn('id', $validated['ids'])->get();

            if ($pengajuanSurat->count() === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada pengajuan yang ditemukan'
                ], 400);
            }

            // Update setiap pengajuan
            $updated = 0;
            foreach ($pengajuanSurat as $item) {
                $item->updateStatus($validated['status'], $validated['catatan_admin']);
                $updated++;

                // Kirim notifikasi WhatsApp jika status selesai
                if ($validated['status'] === 'selesai') {
                    $this->sendWhatsAppNotification($item);
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Berhasil memperbarui status {$updated} pengajuan surat"
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Bulk update status error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send WhatsApp notification (placeholder)
     */
    private function sendWhatsAppNotification(PengajuanSurat $pengajuan)
    {
        // TODO: Implement WhatsApp API integration
        Log::info("WhatsApp notification should be sent to: {$pengajuan->nomor_whatsapp} for pengajuan: {$pengajuan->nomor_pengajuan}");

        // Contoh pesan: "Yth. {nama}, surat {jenis_surat} dengan nomor {nomor_pengajuan} sudah selesai dan dapat diambil di kantor desa. Terima kasih."
    }
}
