<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PkkProgramKerja extends Model
{
    use HasFactory;

    protected $table = 'pkk_program_kerja';

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'kegiatan',
        'peserta_aktif',
        'icon',
        'color',
        'is_active',
        'urutan'
    ];

    protected $casts = [
        'kegiatan' => 'array',
        'is_active' => 'boolean',
        'peserta_aktif' => 'integer',
        'urutan' => 'integer',
    ];

    // Scope untuk data aktif
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Scope untuk urutan
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    // Method untuk mendapatkan semua program untuk public
    public static function getAllForPublic()
    {
        return self::active()->ordered()->get();
    }

    // Method untuk mendapatkan kegiatan sebagai string
    public function getKegiatanString()
    {
        if (!$this->kegiatan) {
            return '';
        }

        return implode(', ', $this->kegiatan);
    }

    // Method untuk mendapatkan warna default berdasarkan urutan
    public function getDefaultColor()
    {
        $colors = ['blue', 'green', 'yellow', 'red', 'purple', 'pink', 'indigo', 'teal'];
        return $colors[($this->urutan - 1) % count($colors)] ?? 'blue';
    }

    // Method untuk mendapatkan icon default
    public function getDefaultIcon()
    {
        $icons = [
            'users', 'heart', 'home', 'star', 'book', 'briefcase', 'camera', 'music'
        ];
        return $icons[($this->urutan - 1) % count($icons)] ?? 'users';
    }
}
