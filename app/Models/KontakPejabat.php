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

    // PERBAIKAN UTAMA: Method untuk cek keberadaan foto
    public function hasFoto()
    {
        if (empty($this->foto)) {
            return false;
        }

        // Cek di berbagai lokasi kemungkinan file tersimpan
        $locations = [
            // 1. Storage disk (standard Laravel)
            'storage' => $this->foto,

            // 2. Storage dengan prefix kontak-pejabat
            'storage_prefixed' => 'kontak-pejabat/' . basename($this->foto),

            // 3. Public folder langsung
            'public_direct' => public_path('kontak-pejabat/' . basename($this->foto)),

            // 4. Public dengan path lengkap
            'public_full' => public_path($this->foto),
        ];

        // Cek storage locations
        if (Storage::disk('public')->exists($locations['storage'])) {
            return true;
        }

        if (Storage::disk('public')->exists($locations['storage_prefixed'])) {
            return true;
        }

        // Cek public locations
        if (file_exists($locations['public_direct'])) {
            return true;
        }

        if (file_exists($locations['public_full'])) {
            return true;
        }

        return false;
    }

    // PERBAIKAN UTAMA: Method untuk mendapatkan URL foto yang benar
    public function getFotoUrlAttribute()
    {
        if (empty($this->foto)) {
            return $this->getDefaultAvatar();
        }

        $filename = basename($this->foto);

        // Priority 1: Storage disk standard Laravel (recommended)
        if (Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        // Priority 2: Storage dengan prefix kontak-pejabat
        $prefixedPath = 'kontak-pejabat/' . $filename;
        if (Storage::disk('public')->exists($prefixedPath)) {
            return asset('storage/' . $prefixedPath);
        }

        // Priority 3: File langsung di public/kontak-pejabat/ (current issue)
        $publicPath = public_path('kontak-pejabat/' . $filename);
        if (file_exists($publicPath)) {
            return asset('kontak-pejabat/' . $filename);
        }

        // Priority 4: File dengan path lengkap di public
        $fullPublicPath = public_path($this->foto);
        if (file_exists($fullPublicPath)) {
            return asset($this->foto);
        }

        // Priority 5: Coba berbagai variasi path
        $variations = [
            'storage/kontak-pejabat/' . $filename,
            'kontak-pejabat/' . $filename,
            'uploads/kontak-pejabat/' . $filename,
        ];

        foreach ($variations as $variation) {
            if (file_exists(public_path($variation))) {
                return asset($variation);
            }
        }

        // Fallback: Default avatar
        return $this->getDefaultAvatar();
    }

    // TAMBAHAN: Method untuk mendapatkan default avatar
    private function getDefaultAvatar()
    {
        // Option 1: UI Avatars (external service)
        $name = urlencode($this->nama);
        return "https://ui-avatars.com/api/?name={$name}&background=059669&color=fff&size=200&font-size=0.5&rounded=true";

        // Option 2: Local default image (jika ada)
        // return asset('images/default-avatar.jpg');

        // Option 3: CSS-based avatar placeholder
        // return null; // Handle in view with CSS
    }

    // PERBAIKAN: Accessor untuk initials
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';

        foreach ($words as $word) {
            if (strlen(trim($word)) > 0) {
                $initials .= strtoupper(trim($word)[0]);
            }

            // Limit to 2 characters
            if (strlen($initials) >= 2) {
                break;
            }
        }

        return $initials ?: substr(strtoupper($this->nama), 0, 2);
    }

    // TAMBAHAN: Method untuk mendapatkan path foto yang actual
    public function getActualFotoPath()
    {
        if (!$this->hasFoto()) {
            return null;
        }

        $filename = basename($this->foto);

        // Cek lokasi dan return path yang actual
        if (Storage::disk('public')->exists($this->foto)) {
            return storage_path('app/public/' . $this->foto);
        }

        $prefixedPath = 'kontak-pejabat/' . $filename;
        if (Storage::disk('public')->exists($prefixedPath)) {
            return storage_path('app/public/' . $prefixedPath);
        }

        $publicPath = public_path('kontak-pejabat/' . $filename);
        if (file_exists($publicPath)) {
            return $publicPath;
        }

        return null;
    }

    // PERBAIKAN: Method untuk hapus foto dengan handle berbagai lokasi
    public function deleteFoto()
    {
        if (empty($this->foto)) {
            return;
        }

        $filename = basename($this->foto);

        // Hapus dari storage locations
        if (Storage::disk('public')->exists($this->foto)) {
            Storage::disk('public')->delete($this->foto);
        }

        $prefixedPath = 'kontak-pejabat/' . $filename;
        if (Storage::disk('public')->exists($prefixedPath)) {
            Storage::disk('public')->delete($prefixedPath);
        }

        // Hapus dari public locations
        $publicLocations = [
            public_path('kontak-pejabat/' . $filename),
            public_path($this->foto),
        ];

        foreach ($publicLocations as $location) {
            if (file_exists($location)) {
                @unlink($location);
            }
        }
    }

    // TAMBAHAN: Method untuk debug info (helpful untuk troubleshooting)
    public function getFotoDebugInfo()
    {
        if (empty($this->foto)) {
            return ['status' => 'no_foto_field'];
        }

        $filename = basename($this->foto);
        $info = [
            'foto_field' => $this->foto,
            'filename' => $filename,
            'has_foto' => $this->hasFoto(),
            'foto_url' => $this->foto_url,
            'locations_checked' => []
        ];

        // Check all possible locations
        $locations = [
            'storage_original' => [
                'path' => $this->foto,
                'exists' => Storage::disk('public')->exists($this->foto),
                'full_path' => storage_path('app/public/' . $this->foto)
            ],
            'storage_prefixed' => [
                'path' => 'kontak-pejabat/' . $filename,
                'exists' => Storage::disk('public')->exists('kontak-pejabat/' . $filename),
                'full_path' => storage_path('app/public/kontak-pejabat/' . $filename)
            ],
            'public_kontak_pejabat' => [
                'path' => 'kontak-pejabat/' . $filename,
                'exists' => file_exists(public_path('kontak-pejabat/' . $filename)),
                'full_path' => public_path('kontak-pejabat/' . $filename)
            ],
            'public_direct' => [
                'path' => $this->foto,
                'exists' => file_exists(public_path($this->foto)),
                'full_path' => public_path($this->foto)
            ]
        ];

        $info['locations_checked'] = $locations;

        return $info;
    }

    // Methods (existing)
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        $this->save();
        return $this;
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kontakPejabat) {
            $kontakPejabat->deleteFoto();
        });
    }
}
