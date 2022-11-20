<?php

namespace App\Models\Surat;

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
        'rw_nama',
    ];
    protected $primaryKey = 'id';
    protected $table = 'surat_k_k_s';
    const tableName = 'surat_k_k_s';
}
