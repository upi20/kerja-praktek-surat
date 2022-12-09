<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeterangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'jenis_surat_keterangan_id',
        'nik',
        'nama',
        'nik_jenis',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_kawin',
        'no_kk',
        'warga_negara',
        'negara_nama',
        'no_passport',
        'kitas_kitap',
        'foto_ktp',
        'alamat',
        'updated_by',
        'created_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'surat_keterangans';
    const tableName = 'surat_keterangans';
    const jenis = 'SURAT KETERANGAN';

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(SuratKeteranganJenis::class, 'jenis_surat_keterangan_id', 'id');
    }
}
