<?php
// app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar_utama',
        'kategori_berita_id',
        'user_id',
        'status',
        'jenis',
        'is_featured',
        'is_urgent',
        'views',
        'tanggal_publikasi',
        'tanggal_berakhir',
        'tags',
        'galeri',
        'sumber',
        'penulis',
        'allow_comments',
        'is_active',
        'published_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'allow_comments' => 'boolean',
        'is_active' => 'boolean',
        'views' => 'integer',
        'tanggal_publikasi' => 'date',
        'tanggal_berakhir' => 'date',
        'published_at' => 'datetime',
        'tags' => 'array',
        'galeri' => 'array'
    ];

    // Boot method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }

            if (empty($model->tanggal_publikasi)) {
                $model->tanggal_publikasi = now()->toDateString();
            }

            if ($model->status === 'published' && empty($model->published_at)) {
                $model->published_at = now();
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul') && empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }

            if ($model->isDirty('status') && $model->status === 'published' && empty($model->published_at)) {
                $model->published_at = now();
            }
        });
    }

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    public function scopeByKategori($query, $kategoriSlug)
    {
        return $query->whereHas('kategori', function ($q) use ($kategoriSlug) {
            $q->where('slug', $kategoriSlug);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('ringkasan', 'like', "%{$search}%")
              ->orWhere('konten', 'like', "%{$search}%");
        });
    }

    public function scopeLatestPublished($query)
    {
        return $query->published()->orderBy('published_at', 'desc');
    }

    public function scopePopular($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days))
                    ->orderBy('views', 'desc');
    }

    // Static methods
    public static function getForPublic($filters = [])
    {
        $query = static::active()
            ->published()
            ->with(['kategori', 'author'])
            ->latestPublished();

        // Apply filters
        if (!empty($filters['kategori'])) {
            $query->byKategori($filters['kategori']);
        }

        if (!empty($filters['jenis'])) {
            $query->byJenis($filters['jenis']);
        }

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['featured'])) {
            $query->featured();
        }

        return $query->paginate($filters['per_page'] ?? 12);
    }

    public static function getFeaturedForPublic($limit = 3)
    {
        return static::active()
            ->published()
            ->featured()
            ->with(['kategori', 'author'])
            ->latestPublished()
            ->limit($limit)
            ->get();
    }

    public static function getLatestForPublic($limit = 6)
    {
        return static::active()
            ->published()
            ->with(['kategori', 'author'])
            ->latestPublished()
            ->limit($limit)
            ->get();
    }

    public static function getRelated($berita, $limit = 4)
    {
        return static::active()
            ->published()
            ->where('id', '!=', $berita->id)
            ->where('kategori_berita_id', $berita->kategori_berita_id)
            ->with(['kategori', 'author'])
            ->latestPublished()
            ->limit($limit)
            ->get();
    }

    public static function getStatistics()
    {
        return [
            'total' => static::count(),
            'published' => static::published()->count(),
            'draft' => static::where('status', 'draft')->count(),
            'featured' => static::featured()->published()->count(),
            'berita' => static::byJenis('berita')->published()->count(),
            'pengumuman' => static::byJenis('pengumuman')->published()->count(),
            'total_views' => static::published()->sum('views'),
            'this_month' => static::published()
                ->whereMonth('published_at', now()->month)
                ->whereYear('published_at', now()->year)
                ->count()
        ];
    }

    // Accessors
    public function getExcerptAttribute($length = 150)
    {
        return Str::limit(strip_tags($this->konten), $length);
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->konten));
        $minutes = ceil($words / 200); // Average reading speed
        return $minutes . ' menit baca';
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d F Y') : $this->tanggal_publikasi->format('d F Y');
    }

    public function getAuthorNameAttribute()
    {
        return $this->penulis ?: $this->author->name ?? 'Admin Desa';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => '<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">Draft</span>',
            'published' => '<span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Published</span>',
            'archived' => '<span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Archived</span>',
        ];

        return $badges[$this->status] ?? $badges['draft'];
    }

    public function getJenisBadgeAttribute()
    {
        $badges = [
            'berita' => '<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">Berita</span>',
            'pengumuman' => '<span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium">Pengumuman</span>',
        ];

        return $badges[$this->jenis] ?? $badges['berita'];
    }

    // Methods
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function isExpired()
    {
        return $this->tanggal_berakhir && $this->tanggal_berakhir->isPast();
    }

    public function canBePublished()
    {
        return $this->status === 'draft' || $this->status === 'archived';
    }

    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now()
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
            'published_at' => null
        ]);
    }

    public function archive()
    {
        $this->update([
            'status' => 'archived'
        ]);
    }

    public function getGambarUtamaUrl()
    {
        if ($this->gambar_utama && file_exists(public_path('storage/' . $this->gambar_utama))) {
            return asset('storage/' . $this->gambar_utama);
        }

        return asset('images/default-news.jpg');
    }
}
