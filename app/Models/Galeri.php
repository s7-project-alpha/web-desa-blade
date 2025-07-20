<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'kategori_galeri_id',
        'judul',
        'slug',
        'deskripsi',
        'foto_path',
        'foto_original_name',
        'alt_text',
        'is_featured',
        'is_active',
        'urutan',
        'views_count',
        'photographer',
        'tanggal_foto',
        'lokasi',
        'metadata'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'views_count' => 'integer',
        'tanggal_foto' => 'date',
        'metadata' => 'array'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = self::generateUniqueSlug($model->judul);
            }
            if (empty($model->alt_text)) {
                $model->alt_text = $model->judul;
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul') && empty($model->slug)) {
                $model->slug = self::generateUniqueSlug($model->judul, $model->id);
            }
        });

        static::deleting(function ($model) {
            // Delete photo file when model is deleted
            if ($model->foto_path && Storage::disk('public')->exists($model->foto_path)) {
                Storage::disk('public')->delete($model->foto_path);
            }
        });
    }

    /**
     * Relationship with KategoriGaleri
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_galeri_id');
    }

    /**
     * Scope: Active galeri
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Featured galeri
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: By category
     */
    public function scopeByKategori($query, $kategoriSlug)
    {
        return $query->whereHas('kategori', function ($q) use ($kategoriSlug) {
            $q->where('slug', $kategoriSlug);
        });
    }

    /**
     * Scope: Search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              ->orWhere('photographer', 'like', '%' . $search . '%')
              ->orWhere('lokasi', 'like', '%' . $search . '%');
        });
    }

    /**
     * Scope: Latest
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope: Ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get all galeri for public display
     */
    public static function getAllForPublic($kategoriSlug = null, $perPage = 12)
    {
        $query = self::active()
            ->with('kategori')
            ->when($kategoriSlug, function($q, $kategoriSlug) {
                return $q->byKategori($kategoriSlug);
            })
            ->latest();

        return $query->paginate($perPage);
    }

    /**
     * Get featured galeri for public
     */
    public static function getFeaturedForPublic($limit = 6)
    {
        return self::active()
            ->featured()
            ->with('kategori')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get latest galeri for public
     */
    public static function getLatestForPublic($limit = 8)
    {
        return self::active()
            ->with('kategori')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get related galeri
     */
    public function getRelatedGaleri($limit = 4)
    {
        return self::active()
            ->where('id', '!=', $this->id)
            ->where('kategori_galeri_id', $this->kategori_galeri_id)
            ->with('kategori')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get photo URL
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto_path) {
            return Storage::url($this->foto_path);
        }
        return asset('images/default-gallery.jpg');
    }

    /**
     * Get thumbnail URL (you can implement thumbnail logic here)
     */
    public function getThumbnailUrlAttribute()
    {
        // For now, return the same as foto_url
        // In production, you might want to generate/store thumbnails
        return $this->foto_url;
    }

    /**
     * Generate unique slug
     */
    public static function generateUniqueSlug($judul, $excludeId = null)
    {
        $slug = Str::slug($judul);
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

    /**
     * Format tanggal foto for display
     */
    public function getFormattedTanggalFotoAttribute()
    {
        return $this->tanggal_foto ? $this->tanggal_foto->format('d M Y') : null;
    }
}
