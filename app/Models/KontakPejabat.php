<?php
// app/Models/KontakPejabat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class KontakPejabat extends Model
{
    use HasFactory;

    protected $table = 'kontak_pejabat';

    protected $fillable = [
        'nama',
        'jabatan',
        'telepon',
        'email',
        'foto',
        'deskripsi',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('nama', 'asc');
    }

    // Static methods
    public static function getAllForPublic()
    {
        return self::active()->ordered()->get();
    }

    public static function getByJabatan($jabatan)
    {
        return self::active()
            ->where('jabatan', 'like', "%{$jabatan}%")
            ->ordered()
            ->get();
    }

    // Accessors
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return Storage::disk('public')->url($this->foto);
        }

        // Generate avatar using UI Avatars
        $name = urlencode($this->nama);
        return "https://ui-avatars.com/api/?name={$name}&background=059669&color=fff&size=200&font-size=0.5&rounded=true";
    }

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        foreach ($words as $word) {
            if (strlen($word) > 0) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
    }

    // Methods
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        $this->save();
        return $this;
    }

    public function deleteFoto()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            Storage::disk('public')->delete($this->foto);
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kontakPejabat) {
            $kontakPejabat->deleteFoto();
        });
    }
}
