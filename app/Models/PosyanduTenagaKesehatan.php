<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosyanduTenagaKesehatan extends Model
{
    use HasFactory;

    protected $table = 'posyandu_tenaga_kesehatan';

    protected $fillable = [
        'nama',
        'gelar',
        'jabatan',
        'spesialisasi',
        'pengalaman_tahun',
        'telepon',
        'email',
        'foto',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'pengalaman_tahun' => 'integer',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Static methods
    public static function getAllForPublic()
    {
        return self::active()
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'gelar' => $item->gelar,
                    'nama_lengkap' => $item->nama . ($item->gelar ? ', ' . $item->gelar : ''),
                    'jabatan' => $item->jabatan,
                    'spesialisasi' => $item->spesialisasi,
                    'pengalaman' => $item->pengalaman_tahun . ' tahun',
                    'telepon' => $item->telepon,
                    'email' => $item->email,
                    'foto' => $item->foto_url, // ← FIX: Gunakan accessor foto_url
                ];
            });
    }

    // Accessors
    public function getNamaLengkapAttribute()
    {
        return $this->nama . ($this->gelar ? ', ' . $this->gelar : '');
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=059669&color=fff&size=200';
    }
}
