<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PkkPengurus extends Model
{
    use HasFactory;

    protected $table = 'pkk_pengurus';

    protected $fillable = [
        'nama',
        'jabatan',
        'deskripsi',
        'foto',
        'telepon',
        'email',
        'tugas',
        'periode_mulai',
        'periode_selesai',
        'is_active',
        'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    // Method untuk mendapatkan semua pengurus untuk public
    public static function getAllForPublic()
    {
        return self::active()->ordered()->get();
    }

    // Method untuk mendapatkan URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return Storage::url($this->foto);
        }

        // Default avatar jika tidak ada foto
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=059669&color=fff&size=400';
    }

    // Method untuk mendapatkan periode lengkap
    public function getPeriodeLengkap()
    {
        if ($this->periode_mulai && $this->periode_selesai) {
            return $this->periode_mulai . ' - ' . $this->periode_selesai;
        } elseif ($this->periode_mulai) {
            return $this->periode_mulai . ' - sekarang';
        }
        return 'Tidak ditentukan';
    }

    // Method untuk format telepon
    public function getFormattedTelepon()
    {
        if (!$this->telepon) {
            return null;
        }

        // Format nomor telepon Indonesia
        $telepon = preg_replace('/[^0-9]/', '', $this->telepon);

        if (substr($telepon, 0, 1) == '0') {
            $telepon = '62' . substr($telepon, 1);
        } elseif (substr($telepon, 0, 2) != '62') {
            $telepon = '62' . $telepon;
        }

        return $telepon;
    }

    // Method untuk mendapatkan WhatsApp URL
    public function getWhatsAppUrl()
    {
        $telepon = $this->getFormattedTelepon();
        if (!$telepon) {
            return null;
        }

        return 'https://wa.me/' . $telepon;
    }

    // Method untuk toggle active status
    public function toggleActive()
    {
        $this->update(['is_active' => !$this->is_active]);
    }

    // Method untuk mendapatkan initial nama
    public function getInitials()
    {
        $words = explode(' ', $this->nama);
        $initials = '';

        foreach ($words as $word) {
            $initials .= substr($word, 0, 1);
        }

        return strtoupper(substr($initials, 0, 2));
    }
}
