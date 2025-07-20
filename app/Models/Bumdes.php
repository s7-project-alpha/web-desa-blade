<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bumdes extends Model
{
    use HasFactory;

    protected $table = 'bumdes';

    protected $fillable = [
        'nama',
        'deskripsi',
        'tagline',
        'visi',
        'misi',
        'header_image',
        'header_title',
        'header_subtitle',
        'total_aset',
        'aset_growth',
        'omzet_tahunan',
        'omzet_growth',
        'laba_bersih',
        'laba_growth',
        'anggota_aktif',
        'anggota_growth',
        'is_active'
    ];

    protected $casts = [
        'total_aset' => 'integer',
        'omzet_tahunan' => 'integer',
        'laba_bersih' => 'integer',
        'anggota_aktif' => 'integer',
        'aset_growth' => 'decimal:2',
        'omzet_growth' => 'decimal:2',
        'laba_growth' => 'decimal:2',
        'anggota_growth' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Relationship dengan unit usaha
     */
    public function unitUsaha()
    {
        return $this->hasMany(BumdesUnitUsaha::class);
    }

    /**
     * Relationship dengan tim manajemen
     */
    public function timManajemen()
    {
        return $this->hasMany(BumdesTimManajemen::class);
    }

    /**
     * Get header image URL
     */
    public function getHeaderImageUrlAttribute()
    {
        if ($this->header_image && Storage::disk('public')->exists($this->header_image)) {
            return Storage::url($this->header_image);
        }
        return asset('images/default-bumdes-header.jpg');
    }

    /**
     * Format currency
     */
    public function getFormattedTotalAsetAttribute()
    {
        return $this->formatCurrency($this->total_aset);
    }

    public function getFormattedOmzetTahunanAttribute()
    {
        return $this->formatCurrency($this->omzet_tahunan);
    }

    public function getFormattedLabaBersihAttribute()
    {
        return $this->formatCurrency($this->laba_bersih);
    }

    /**
     * Format currency helper
     */
    private function formatCurrency($amount)
    {
        if ($amount >= 1000000000) {
            return 'Rp ' . number_format($amount / 1000000000, 1) . ' miliar';
        } elseif ($amount >= 1000000) {
            return 'Rp ' . number_format($amount / 1000000, 0) . ' juta';
        } elseif ($amount >= 1000) {
            return 'Rp ' . number_format($amount / 1000, 0) . ' ribu';
        }
        return 'Rp ' . number_format($amount, 0);
    }

    /**
     * Get active BUMDes
     */
    public static function getActive()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Get complete data for public
     */
    public static function getCompleteData()
    {
        $bumdes = self::getActive();
        if (!$bumdes) return null;

        return [
            'bumdes' => $bumdes,
            'unit_usaha' => $bumdes->unitUsaha()->where('is_active', true)->orderBy('urutan')->get(),
            'tim_manajemen' => $bumdes->timManajemen()->where('is_active', true)->orderBy('urutan')->get()
        ];
    }
}


