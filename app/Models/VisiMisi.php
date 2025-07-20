<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misi';

    protected $fillable = [
        'visi',
        'misi',
        'nilai_dasar',
        'tujuan',
        'sasaran',
        'periode_awal',
        'periode_akhir',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active visi misi
     */
    public static function getActive()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Get periode display
     */
    public function getPeriodeAttribute()
    {
        return $this->periode_awal . ' - ' . $this->periode_akhir;
    }

    /**
     * Get misi as array
     */
    public function getMisiArrayAttribute()
    {
        return $this->misi ? explode("\n", $this->misi) : [];
    }

    /**
     * Get nilai dasar as array
     */
    public function getNilaiDasarArrayAttribute()
    {
        return $this->nilai_dasar ? explode("\n", $this->nilai_dasar) : [];
    }

    /**
     * Get tujuan as array
     */
    public function getTujuanArrayAttribute()
    {
        return $this->tujuan ? explode("\n", $this->tujuan) : [];
    }

    /**
     * Get sasaran as array
     */
    public function getSasaranArrayAttribute()
    {
        return $this->sasaran ? explode("\n", $this->sasaran) : [];
    }

    /**
     * Activate this visi misi and deactivate others
     */
    public function activate()
    {
        // Deactivate all other visi misi
        self::where('id', '!=', $this->id)->update(['is_active' => false]);

        // Activate this one
        $this->update(['is_active' => true]);
    }
}
