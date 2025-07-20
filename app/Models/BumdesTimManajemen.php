<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class BumdesTimManajemen extends Model
{
    use HasFactory;

    protected $table = 'bumdes_tim_manajemen';

    protected $fillable = [
        'bumdes_id',
        'nama',
        'jabatan',
        'pengalaman',
        'telepon',
        'email',
        'foto',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'urutan' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Relationship dengan BUMDes
     */
    public function bumdes()
    {
        return $this->belongsTo(Bumdes::class);
    }

    /**
     * Get foto URL
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return Storage::url($this->foto);
        }
        return 'data:image/svg+xml;base64,' . base64_encode('
            <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="200" fill="#f3f4f6"/>
                <circle cx="100" cy="80" r="35" fill="#9ca3af"/>
                <ellipse cx="100" cy="160" rx="60" ry="40" fill="#9ca3af"/>
            </svg>
        ');
    }
}
