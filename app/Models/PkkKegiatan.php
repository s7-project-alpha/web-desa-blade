<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PkkKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pkk_kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'waktu',
        'lokasi',
        'penanggung_jawab',
        'jumlah_peserta',
        'foto',
        'status',
        'is_active'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
        'is_active' => 'boolean',
        'jumlah_peserta' => 'integer',
    ];

    // Scope untuk data aktif
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Scope berdasarkan status
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    // Scope kegiatan mendatang
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('tanggal', '>=', now()->toDateString())
                    ->whereIn('status', ['akan_datang', 'sedang_berlangsung']);
    }

    // Scope kegiatan terbaru
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc');
    }

    // Method untuk mendapatkan kegiatan untuk public
    public static function getForPublic($limit = 6)
    {
        return self::active()->latest()->limit($limit)->get();
    }

    // Method untuk mendapatkan kegiatan mendatang
    public static function getUpcomingForPublic($limit = 3)
    {
        return self::active()->upcoming()->orderBy('tanggal', 'asc')->limit($limit)->get();
    }

    // Method untuk mendapatkan URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return Storage::url($this->foto);
        }

        return null;
    }

    // Method untuk mendapatkan format tanggal Indonesia
    public function getFormattedTanggal()
    {
        return $this->tanggal->translatedFormat('d F Y');
    }

    // Method untuk mendapatkan format waktu
    public function getFormattedWaktu()
    {
        if (!$this->waktu) {
            return null;
        }

        return $this->waktu->format('H:i');
    }

    // Method untuk mendapatkan status badge
    public function getStatusBadge()
    {
        $badges = [
            'akan_datang' => [
                'text' => 'Akan Datang',
                'class' => 'bg-blue-100 text-blue-800'
            ],
            'sedang_berlangsung' => [
                'text' => 'Sedang Berlangsung',
                'class' => 'bg-green-100 text-green-800'
            ],
            'selesai' => [
                'text' => 'Selesai',
                'class' => 'bg-gray-100 text-gray-800'
            ],
        ];

        return $badges[$this->status] ?? $badges['akan_datang'];
    }

    // Method untuk auto update status berdasarkan tanggal
    public function updateStatusBasedOnDate()
    {
        $today = now()->toDateString();

        if ($this->tanggal->toDateString() > $today) {
            $this->status = 'akan_datang';
        } elseif ($this->tanggal->toDateString() == $today) {
            $this->status = 'sedang_berlangsung';
        } else {
            $this->status = 'selesai';
        }

        $this->save();
    }

    // Method untuk mendapatkan hari tersisa
    public function getHariTersisa()
    {
        if ($this->status !== 'akan_datang') {
            return null;
        }

        $today = now()->startOfDay();
        $eventDate = $this->tanggal->startOfDay();

        return $today->diffInDays($eventDate);
    }

    // Method untuk toggle active status
    public function toggleActive()
    {
        $this->update(['is_active' => !$this->is_active]);
    }

    // Method untuk mendapatkan excerpt deskripsi
    public function getExcerpt($length = 100)
    {
        return \Illuminate\Support\Str::limit($this->deskripsi, $length);
    }
}
