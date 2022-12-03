<?php

namespace App\Models\Surat;

use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKK extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'rt_id',
        'rw_id',
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'kab_kota',
        'kecamatan',
        'kode_pos',
        'provinsi',
        'nama_desa',
        'rt_nama',
        'rw_nama', 'updated_by', 'created_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'surat_k_k_s';
    const tableName = 'surat_k_k_s';

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id', 'id');
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }

    public function penduduks()
    {
        return $this->hasMany(SuratKKPenduduk::class, 'surat_kk_id', 'id');
    }
}
