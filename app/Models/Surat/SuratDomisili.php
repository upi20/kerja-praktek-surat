<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'alamat_asal',
        'tinggal_sejak',
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
    ];

    protected $primaryKey = 'id';
    protected $table = 'surat_domisilis';
    const tableName = 'surat_domisilis';
}
