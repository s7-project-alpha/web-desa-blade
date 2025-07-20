<?php
// app/Models/KontakMessage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'ip_address',
        'user_agent',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Static methods
    public static function getUnreadCount()
    {
        return self::unread()->count();
    }

    public static function getRecentMessages($limit = 10)
    {
        return self::latest()->limit($limit)->get();
    }

    public static function getLatestForAdmin($perPage = 15)
    {
        return self::latest()->paginate($perPage);
    }

    // Accessors
    public function getStatusAttribute()
    {
        return $this->is_read ? 'Dibaca' : 'Belum Dibaca';
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }

    public function getShortPesanAttribute()
    {
        return \Str::limit($this->pesan, 100);
    }

    // Methods
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }
        return $this;
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
        return $this;
    }
}
