<?php

namespace App\Models\Surat;

use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $fillable = [
        'penduduk_id',
        'untuk_penduduk_id',
        'rt_id',
        'rt_pend_id',
        'rw_pend_id',
        'kades_pend_id',
        'rw_id',
        'nama_penduduk',
        'nik_penduduk',
        'nama_untuk_penduduk',
        'nik_untuk_penduduk',
        'nama_surat',
        'rt_nik',
        'rt_nama',
        'rw_nik',
        'rw_nama',
        'kades_nik',
        'kades_nama',
        'no_surat',
        'no_resi',
        'foto_pbb',
        'foto_kk',
        'reg_no',
        'tanggal',
        'status',
        'jenis',
        'dibatalkan',
        'alasan_dibatalkan',
        'tanggal_dibatalkan', 'updated_by', 'created_by'
    ];

    protected $primaryKey = 'id';
    protected $table = 'surats';
    const tableName = 'surats';

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }
}