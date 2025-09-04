<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'nomor_pengajuan',
        'jenis_surat',
        'nama',
        'nomor_whatsapp',
        'data_surat',
        'status',
        'catatan_admin',
        'tanggal_pengajuan',
        'tanggal_selesai'
    ];

    protected $casts = [
        'data_surat' => 'array',
        'tanggal_pengajuan' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    // Boot method untuk auto generate nomor pengajuan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_pengajuan)) {
                $model->nomor_pengajuan = self::generateNomorPengajuan();
            }
        });
    }

    /**
     * Generate nomor pengajuan otomatis
     */
    public static function generateNomorPengajuan()
    {
        $date = now()->format('Ymd');
        $latest = self::whereDate('created_at', now()->toDateString())
                     ->orderBy('id', 'desc')
                     ->first();

        $sequence = $latest ? (int)substr($latest->nomor_pengajuan, -3) + 1 : 1;

        return $date . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan jenis surat
     */
    public function scopeByJenisSurat($query, $jenisSurat)
    {
        return $query->where('jenis_surat', $jenisSurat);
    }

    /**
     * Get daftar jenis surat dengan label
     */
    public static function getJenisSuratOptions()
    {
        return [
            'sk_domisili' => 'Surat Keterangan Domisili',
            'sk_belum_kawin' => 'Surat Keterangan Belum Kawin',
            'sk_usaha' => 'Surat Keterangan Usaha',
            'sk_skck' => 'Surat Pengantar SKCK',
            'sk_mandah_keluar_masuk' => 'Surat Keterangan Pindah/Keluar Masuk',
            'sk_penghasilan_ortu' => 'Surat Keterangan Penghasilan Orang Tua',
            'sk_tidak_mampu' => 'Surat Keterangan Tidak Mampu'
        ];
    }

    /**
     * Get label jenis surat
     */
    public function getJenisSuratLabelAttribute()
    {
        $options = self::getJenisSuratOptions();
        return $options[$this->jenis_surat] ?? $this->jenis_surat;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'selesai' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800'
        ];

        return $classes[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get required fields untuk setiap jenis surat
     */
    public static function getRequiredFields($jenisSurat)
    {
        $fields = [
            'sk_domisili' => [
                'nama' => 'Nama Lengkap',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tanggal Lahir',
                'jenis_kelamin' => 'Jenis Kelamin',
                'nik' => 'NIK',
                'bangsa' => 'Warga Negara',
                'agama' => 'Agama',
                'status_perkawinan' => 'Status Perkawinan',
                'pekerjaan' => 'Pekerjaan',
                'alamat' => 'Alamat'
            ],
            'sk_belum_kawin' => [
                'nama' => 'Nama Lengkap',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tanggal Lahir',
                'jenis_kelamin' => 'Jenis Kelamin',
                'nik' => 'NIK',
                'bangsaA' => 'Warga Negara',
                'agama' => 'Agama',
                'status_perkawinan' => 'Status Perkawinan',
                'pekerjaan' => 'Pekerjaan',
                'alamat' => 'Alamat'
            ],
            'sk_usaha' => [
                'nama' => 'Nama Lengkap',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tanggal Lahir',
                'jenis_kelamin' => 'Jenis Kelamin',
                'nik' => 'NIK',
                'bangsa' => 'Warga Negara',
                'agama' => 'Agama',
                'status_perkawinan' => 'Status Perkawinan',
                'pekerjaan' => 'Pekerjaan',
                'alamat' => 'Alamat'
            ],
            'sk_skck' => [
                'nama' => 'Nama Lengkap',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tanggal Lahir',
                'jenis_kelamin' => 'Jenis Kelamin',
                'nik' => 'NIK',
                'bangsa' => 'Warga Negara',
                'agama' => 'Agama',
                'status_perkawinan' => 'Status Perkawinan',
                'pekerjaan' => 'Pekerjaan',
                'alamat' => 'Alamat'
            ],
            'sk_mandah_keluar_masuk' => [
                'nama_lengkap' => 'Nama Lengkap',
                'alias' => 'Alias (jika ada)',
                'jenis_kelamin' => 'Jenis Kelamin',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tanggal Lahir',
                'bangsa' => 'Warga Negara',
                'agama' => 'Agama',
                'status_perkawinan' => 'Status Perkawinan',
                'pekerjaan' => 'Pekerjaan',
                'tempat_tinggal' => 'Tempat Tinggal',
                'pindah_ke' => 'Pindah Ke',
                'desa_kelurahan' => 'Desa/Kelurahan',
                'kecamatan' => 'Kecamatan',
                'keperluan' => 'Keperluan',
                'lama_tinggal' => 'Lama Tinggal',
                'pengikut' => 'Pengikut'
            ],
            'sk_penghasilan_ortu' => [
                'nama' => 'Nama Lengkap',
                'umur' => 'Umur',
                'pekerjaan' => 'Pekerjaan',
                'alamat' => 'Alamat'
            ],
            'sk_tidak_mampu' => [
                'nama' => 'Nama Lengkap',
                'nik' => 'NIK',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tanggal Lahir',
                'pekerjaan' => 'Pekerjaan',
                'alamat' => 'Alamat',
                'orang_tua_dari' => 'Orang Tua Dari'
            ]
        ];

        return $fields[$jenisSurat] ?? [];
    }

    /**
     * Update status pengajuan
     */
    public function updateStatus($status, $catatan = null)
    {
        $this->update([
            'status' => $status,
            'catatan_admin' => $catatan,
            'tanggal_selesai' => $status === 'selesai' ? now() : null
        ]);
    }

    /**
     * Get statistics untuk dashboard
     */
    public static function getStatistics()
    {
        return [
            'total' => self::count(),
            'pending' => self::byStatus('pending')->count(),
            'diproses' => self::byStatus('diproses')->count(),
            'selesai' => self::byStatus('selesai')->count(),
            'ditolak' => self::byStatus('ditolak')->count(),
            'hari_ini' => self::whereDate('created_at', today())->count(),
            'bulan_ini' => self::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)->count()
        ];
    }
}
