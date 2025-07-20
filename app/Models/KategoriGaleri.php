<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriGaleri extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'warna_badge',
        'is_active',
        'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_kategori);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama_kategori') && empty($model->slug)) {
                $model->slug = Str::slug($model->nama_kategori);
            }
        });
    }

    /**
     * Relationship with Galeri
     */
    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    /**
     * Scope: Active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Ordered by urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('nama_kategori', 'asc');
    }

    /**
     * Get active categories for public display
     */
    public static function getActiveForPublic()
    {
        return self::active()
            ->ordered()
            ->withCount(['galeri' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();
    }

    /**
     * Get all categories for admin
     */
    public static function getAllForAdmin()
    {
        return self::withCount('galeri')
            ->ordered()
            ->get();
    }

    /**
     * Get category by slug
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * Generate unique slug
     */
    public static function generateUniqueSlug($namaKategori, $excludeId = null)
    {
        $slug = Str::slug($namaKategori);
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)
            ->when($excludeId, function($query, $excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Get next urutan number
     */
    public static function getNextUrutan()
    {
        return (self::max('urutan') ?? 0) + 1;
    }
}
