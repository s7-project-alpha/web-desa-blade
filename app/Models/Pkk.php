<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pkk extends Model
{
    use HasFactory;

    protected $table = 'pkk';

    protected $fillable = [
        'judul',
        'deskripsi',
        'slogan',
        'visi',
        'anggota_aktif',
        'program_aktif',
        'kegiatan_per_tahun',
        'pokja_aktif',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'anggota_aktif' => 'integer',
        'program_aktif' => 'integer',
        'kegiatan_per_tahun' => 'integer',
        'pokja_aktif' => 'integer',
    ];

    // Scope untuk data aktif
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Method untuk mendapatkan data PKK aktif
    public static function getActive()
    {
        return self::active()->first();
    }

    // Method untuk mendapatkan data lengkap PKK untuk public
    public static function getCompleteData()
    {
        $pkk = self::getActive();
        if (!$pkk) {
            return null;
        }

        return [
            'info' => $pkk,
            'program_kerja' => PkkProgramKerja::active()->ordered()->get(),
            'pengurus' => PkkPengurus::active()->ordered()->get(),
            'kegiatan_terbaru' => PkkKegiatan::active()->latest()->limit(6)->get(),
        ];
    }

    // Method untuk mendapatkan statistik
    public function getStatistik()
    {
        return [
            'anggota_aktif' => $this->anggota_aktif,
            'program_aktif' => $this->program_aktif,
            'kegiatan_per_tahun' => $this->kegiatan_per_tahun,
            'pokja_aktif' => $this->pokja_aktif,
        ];
    }
}
