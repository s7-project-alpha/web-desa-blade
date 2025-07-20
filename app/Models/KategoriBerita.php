<?php
// app/Models/KategoriBerita.php

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
        return $this->hasMany(Berita::class);
    }

    public function beritasActive()
    {
        return $this->hasMany(Berita::class)->where('is_active', true)->where('status', 'published');
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

    // Accessors
    public function getBeritaCountAttribute()
    {
        return $this->beritas()->where('is_active', true)->where('status', 'published')->count();
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

    public function incrementBeritaCount()
    {
        $this->increment('berita_count');
    }

    public function decrementBeritaCount()
    {
        $this->decrement('berita_count');
    }
}
