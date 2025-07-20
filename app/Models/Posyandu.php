<?php
// app/Models/Posyandu.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'lokasi',
        'dusun',
        'rt_rw',
        'jadwal',
        'jam_mulai',
        'jam_selesai',
        'penanggung_jawab',
        'telepon_penanggung_jawab',
        'layanan',
        'anggota_aktif',
        'total_balita',
        'balita_gizi_baik',
        'cakupan_imunisasi',
        'ibu_hamil_aktif',
        'is_active',
    ];

    protected $casts = [
        'layanan' => 'array',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'cakupan_imunisasi' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama')) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    // Relationships
    public function kegiatan()
    {
        return $this->hasMany(PosyanduKegiatan::class);
    }

    public function kegiatanMendatang()
    {
        return $this->hasMany(PosyanduKegiatan::class)
            ->where('tanggal', '>=', now())
            ->where('is_active', true)
            ->orderBy('tanggal');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Static methods
    public static function getCompleteData()
    {
        return [
            'overview' => self::getOverviewData(),
            'posyandu_list' => self::getAllForPublic(),
            'layanan' => PosyanduLayanan::getAllForPublic(),
            'tenaga_kesehatan' => PosyanduTenagaKesehatan::getAllForPublic(),
            'kegiatan_mendatang' => PosyanduKegiatan::getUpcomingForPublic(),
        ];
    }

    public static function getOverviewData()
    {
        $total_balita = self::active()->sum('total_balita');
        $balita_gizi_baik = self::active()->sum('balita_gizi_baik');
        $ibu_hamil_aktif = self::active()->sum('ibu_hamil_aktif');
        $avg_cakupan_imunisasi = self::active()->avg('cakupan_imunisasi');

        return [
            'total_balita' => $total_balita,
            'balita_gizi_baik' => $balita_gizi_baik,
            'cakupan_imunisasi' => round($avg_cakupan_imunisasi, 0),
            'ibu_hamil_aktif' => $ibu_hamil_aktif,
        ];
    }

    public static function getAllForPublic()
    {
        return self::active()
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'lokasi' => $item->lokasi,
                    'dusun' => $item->dusun,
                    'rt_rw' => $item->rt_rw,
                    'jadwal' => $item->jadwal,
                    'jam' => $item->jam_mulai->format('H:i') . ' - ' . $item->jam_selesai->format('H:i') . ' WIB',
                    'penanggung_jawab' => $item->penanggung_jawab,
                    'telepon' => $item->telepon_penanggung_jawab,
                    'layanan' => $item->layanan ?? [],
                    'anggota_aktif' => $item->anggota_aktif,
                ];
            });
    }

    // Accessors
    public function getFormattedJadwalAttribute()
    {
        return $this->jam_mulai->format('H:i') . ' - ' . $this->jam_selesai->format('H:i') . ' WIB';
    }
}
