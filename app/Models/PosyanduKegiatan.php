<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosyanduKegiatan extends Model
{
    use HasFactory;

    protected $table = 'posyandu_kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'posyandu_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'agenda',
        'status',
        'catatan',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'agenda' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now()->toDateString())
            ->where('status', 'terjadwal');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Static methods
    public static function getUpcomingForPublic($limit = 5)
    {
        return self::active()
            ->upcoming()
            ->with('posyandu')
            ->orderBy('tanggal')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_kegiatan' => $item->nama_kegiatan,
                    'posyandu' => $item->posyandu->nama,
                    'tanggal' => $item->tanggal->locale('id')->translatedFormat('l, j F'),
                    'jam' => $item->jam_mulai->format('H:i') . ' - ' . $item->jam_selesai->format('H:i') . ' WIB',
                    'agenda' => $item->agenda ?? [],
                ];
            });
    }

    public static function getStatusOptions()
    {
        return [
            'terjadwal' => 'Terjadwal',
            'berlangsung' => 'Berlangsung',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];
    }

    // Accessors
    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal->locale('id')->translatedFormat('l, j F Y');
    }

    public function getFormattedJamAttribute()
    {
        return $this->jam_mulai->format('H:i') . ' - ' . $this->jam_selesai->format('H:i') . ' WIB';
    }
}
