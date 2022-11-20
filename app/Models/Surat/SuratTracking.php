<?php

namespace App\Models\Surat;

use App\Models\Desa\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'dari_pegawai_id',
        'ke_pegawai_id',

        'keterangan',
        'waktu',
        'dari_nama',
        'dari_nip',
        'ke_nama',
        'ke_nip',
        'status',
    ];

    protected $primaryKey = 'id';
    protected $table = 'surat_trackings';
    const tableName = 'surat_trackings';

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id', 'id');
    }

    public function dari_pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'dari_pegawai_id', 'id');
    }

    public function ke_pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ke_pegawai_id', 'id');
    }
}
