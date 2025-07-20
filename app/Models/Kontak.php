<?php
// app/Models/Kontak.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'nama_kantor',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'email',
        'telepon',
        'fax',
        'jam_operasional',
        'latitude',
        'longitude',
        'deskripsi',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Static methods
    public static function getActive()
    {
        return self::active()->first();
    }

    public static function getForPublic()
    {
        return self::active()->first();
    }

    // Accessors
    public function getAlamatLengkapAttribute()
    {
        return "{$this->alamat}, {$this->kecamatan}, {$this->kabupaten}, {$this->provinsi}";
    }

    public function getGoogleMapsUrlAttribute()
    {
        $address = urlencode($this->alamat_lengkap);
        return "https://www.google.com/maps/search/?api=1&query={$address}";
    }

    public function getGoogleMapsEmbedUrlAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1000!2d{$this->longitude}!3d{$this->latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMDAnMDAuMCJOIDk4wrAwMCcwMC4wIkU!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid";
        }

        $address = urlencode($this->alamat_lengkap);
        return "https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q={$address}";
    }

    // Methods
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        $this->save();
        return $this;
    }
}
