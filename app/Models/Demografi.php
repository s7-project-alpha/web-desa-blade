<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demografi extends Model
{
    use HasFactory;

    protected $table = 'demografi';

    protected $fillable = [
        'total_penduduk',
        'total_kepala_keluarga',
        'total_laki_laki',
        'total_perempuan',
        'luas_wilayah',
        'angka_harapan_hidup',
        'rasio_jenis_kelamin',
        'jumlah_dusun',
        'jumlah_rt',
        'jumlah_rw',
        'distribusi_usia',
        'tingkat_pendidikan',
        'mata_pencaharian',
        'agama',
        'status_perkawinan',
        'tahun',
        'is_active',
        'keterangan',
    ];

    protected $casts = [
        'distribusi_usia' => 'array',
        'tingkat_pendidikan' => 'array',
        'mata_pencaharian' => 'array',
        'agama' => 'array',
        'status_perkawinan' => 'array',
        'is_active' => 'boolean',
        'luas_wilayah' => 'decimal:2',
        'angka_harapan_hidup' => 'decimal:2',
        'rasio_jenis_kelamin' => 'decimal:2',
    ];

    /**
     * Get the active demografi data
     */
    public static function getActive()
    {
        return self::where('is_active', true)->orderBy('tahun', 'desc')->first();
    }

    /**
     * Get the latest demografi data
     */
    public static function getLatest()
    {
        return self::orderBy('tahun', 'desc')->first();
    }

    /**
     * Activate this demografi and deactivate others
     */
    public function activate()
    {
        // Deactivate all other demografi
        self::where('id', '!=', $this->id)->update(['is_active' => false]);

        // Activate this one
        $this->update(['is_active' => true]);
    }

    /**
     * Get kepadatan penduduk per km2
     */
    public function getKepadatanPendudukAttribute()
    {
        if ($this->luas_wilayah > 0) {
            return round($this->total_penduduk / $this->luas_wilayah, 2);
        }
        return 0;
    }

    /**
     * Get persentase laki-laki
     */
    public function getPersentaseLakiLakiAttribute()
    {
        if ($this->total_penduduk > 0) {
            return round(($this->total_laki_laki / $this->total_penduduk) * 100, 2);
        }
        return 0;
    }

    /**
     * Get persentase perempuan
     */
    public function getPersentasePerempuanAttribute()
    {
        if ($this->total_penduduk > 0) {
            return round(($this->total_perempuan / $this->total_penduduk) * 100, 2);
        }
        return 0;
    }

    /**
     * Get rata-rata anggota per KK
     */
    public function getRataRataAnggotaKkAttribute()
    {
        if ($this->total_kepala_keluarga > 0) {
            return round($this->total_penduduk / $this->total_kepala_keluarga, 2);
        }
        return 0;
    }

    /**
     * Get distribusi usia dengan label
     */
    public function getDistribusiUsiaLabelAttribute()
    {
        $labels = [
            '0_5' => '0-5 Tahun',
            '6_12' => '6-12 Tahun',
            '13_17' => '13-17 Tahun',
            '18_25' => '18-25 Tahun',
            '26_35' => '26-35 Tahun',
            '36_45' => '36-45 Tahun',
            '46_55' => '46-55 Tahun',
            '56_65' => '56-65 Tahun',
            '65_plus' => '65+ Tahun',
        ];

        $result = [];
        foreach ($this->distribusi_usia as $key => $value) {
            $result[$labels[$key] ?? $key] = $value;
        }
        return $result;
    }

    /**
     * Get tingkat pendidikan dengan label
     */
    public function getTingkatPendidikanLabelAttribute()
    {
        $labels = [
            'tidak_sekolah' => 'Tidak Sekolah',
            'belum_tamat_sd' => 'Belum Tamat SD',
            'sd' => 'SD/Sederajat',
            'smp' => 'SMP/Sederajat',
            'sma' => 'SMA/Sederajat',
            'diploma' => 'Diploma',
            's1' => 'S1',
            's2' => 'S2',
            's3' => 'S3',
        ];

        $result = [];
        foreach ($this->tingkat_pendidikan as $key => $value) {
            $result[$labels[$key] ?? $key] = $value;
        }
        return $result;
    }

    /**
     * Get mata pencaharian dengan label
     */
    public function getMataPencaharianLabelAttribute()
    {
        $labels = [
            'petani' => 'Petani',
            'buruh_tani' => 'Buruh Tani',
            'peternak' => 'Peternak',
            'nelayan' => 'Nelayan',
            'pedagang' => 'Pedagang',
            'wiraswasta' => 'Wiraswasta',
            'pns' => 'PNS',
            'tni_polri' => 'TNI/POLRI',
            'guru' => 'Guru',
            'bidan_perawat' => 'Bidan/Perawat',
            'pensiunan' => 'Pensiunan',
            'tidak_bekerja' => 'Tidak Bekerja',
            'lainnya' => 'Lainnya',
        ];

        $result = [];
        foreach ($this->mata_pencaharian as $key => $value) {
            $result[$labels[$key] ?? $key] = $value;
        }
        return $result;
    }
}
