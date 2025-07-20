<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PosyanduLayanan extends Model
{
    use HasFactory;

    protected $table = 'posyandu_layanan';

    protected $fillable = [
        'nama_layanan',
        'slug',
        'deskripsi',
        'jadwal',
        'target_usia',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_layanan);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama_layanan')) {
                $model->slug = Str::slug($model->nama_layanan);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Static methods
    public static function getAllForPublic()
    {
        return self::active()
            ->orderBy('nama_layanan')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama_layanan,
                    'deskripsi' => $item->deskripsi,
                    'jadwal' => $item->jadwal,
                    'target_usia' => $item->target_usia,
                    'icon' => $item->icon,
                ];
            });
    }
}
