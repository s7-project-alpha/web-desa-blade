<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class BumdesUnitUsaha extends Model
{
    use HasFactory;

    protected $table = 'bumdes_unit_usaha';

    protected $fillable = [
        'bumdes_id',
        'nama',
        'deskripsi',
        'status',
        'jumlah_anggota',
        'icon',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'jumlah_anggota' => 'integer',
        'urutan' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Relationship dengan BUMDes
     */
    public function bumdes()
    {
        return $this->belongsTo(Bumdes::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'aktif' => 'bg-green-100 text-green-800',
            'berkembang' => 'bg-yellow-100 text-yellow-800',
            'tidak_aktif' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get status options
     */
    public static function getStatusOptions()
    {
        return [
            'aktif' => 'Aktif',
            'berkembang' => 'Berkembang',
            'tidak_aktif' => 'Tidak Aktif'
        ];
    }
}
