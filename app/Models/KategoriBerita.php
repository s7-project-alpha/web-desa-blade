<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'warna',
        'icon',
        'is_active',
        'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer'
    ];

    // Boot method untuk auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama') && empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    // Relationships
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id');
    }

    // PERBAIKAN: Definisi yang lebih jelas untuk berita aktif
    public function beritasActive()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id')
                    ->where('status', 'published')
                    ->where(function($query) {
                        $query->where('is_active', true)
                              ->orWhereNull('is_active'); // Handle jika is_active NULL (default aktif)
                    });
    }

    // Relasi tambahan untuk berbagai status
    public function beritasPublished()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id')
                    ->where('status', 'published');
    }

    public function beritasDraft()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id')
                    ->where('status', 'draft');
    }

    public function beritasArchived()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id')
                    ->where('status', 'archived');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }

    // Static methods
    public static function getActiveForPublic()
    {
        return static::active()
            ->withCount(['beritasActive'])
            ->having('beritas_active_count', '>', 0)
            ->ordered()
            ->get();
    }

    public static function getForSelect()
    {
        return static::active()->ordered()->pluck('nama', 'id');
    }

    // Accessors - PERBAIKAN: Gunakan relasi yang benar
    public function getBeritaCountAttribute()
    {
        return $this->beritasActive()->count();
    }

    public function getTotalViewsAttribute()
    {
        return $this->beritas()->sum('views');
    }

    public function getIconHtmlAttribute()
    {
        if (empty($this->icon)) {
            return '<div class="w-4 h-4 rounded-full" style="background-color: ' . $this->warna . '"></div>';
        }
        return '<i class="' . $this->icon . '" style="color: ' . $this->warna . '"></i>';
    }

    // Methods
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Helper methods untuk debugging
    public function getBeritaStats()
    {
        return [
            'total' => $this->beritas()->count(),
            'published' => $this->beritasPublished()->count(),
            'active' => $this->beritasActive()->count(),
            'draft' => $this->beritasDraft()->count(),
            'archived' => $this->beritasArchived()->count(),
            'total_views' => $this->beritas()->sum('views')
        ];
    }
}
