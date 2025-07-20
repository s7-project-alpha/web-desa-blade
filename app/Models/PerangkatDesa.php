<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PerangkatDesa extends Model
{
    use HasFactory;

    protected $table = 'perangkat_desa';

    protected $fillable = [
        'nama',
        'jabatan',
        'periode',
        'telepon',
        'email',
        'pendidikan',
        'visi',
        'tugas_tanggung_jawab',
        'foto',
        'kategori',
        'dusun',
        'rt_rw',
        'is_active',
        'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer'
    ];

    /**
     * Get foto URL
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return Storage::url($this->foto);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * Get formatted tugas as array
     */
    public function getTugasArrayAttribute()
    {
        if ($this->tugas_tanggung_jawab) {
            return explode("\n", $this->tugas_tanggung_jawab);
        }
        return [];
    }

    /**
     * Scope untuk kategori tertentu
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('nama', 'asc');
    }

    /**
     * Get kepala desa
     */
    public static function getKepalaDesa()
    {
        return self::byKategori('kepala_desa')->active()->first();
    }

    /**
     * Get perangkat desa
     */
    public static function getPerangkatDesa()
    {
        return self::byKategori('perangkat_desa')->active()->ordered()->get();
    }

    /**
     * Get kepala dusun
     */
    public static function getKepalaDusun()
    {
        return self::byKategori('kepala_dusun')->active()->ordered()->get();
    }

    /**
     * Get BPD
     */
    public static function getBPD()
    {
        return self::byKategori('bpd')->active()->ordered()->get();
    }

    /**
     * Get all perangkat for public display
     */
    public static function getAllForPublic()
    {
        return [
            'kepala_desa' => self::getKepalaDesa(),
            'perangkat_desa' => self::getPerangkatDesa(),
            'kepala_dusun' => self::getKepalaDusun(),
            'bpd' => self::getBPD()
        ];
    }

    /**
     * Get kategori options
     */
    public static function getKategoriOptions()
    {
        return [
            'kepala_desa' => 'Kepala Desa',
            'perangkat_desa' => 'Perangkat Desa',
            'kepala_dusun' => 'Kepala Dusun',
            'bpd' => 'Badan Permusyawaratan Desa (BPD)'
        ];
    }
}
