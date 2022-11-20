<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKelahiran extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'ayah_id',
        'ibu_id',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'waktu_lahir',
        'berat',
        'panjang',
        'jenis_kelamin',
        'ibu_nama',
        'ibu_nik',
        'ibu_nik_jenis',
        'ibu_jenis_kelamin',
        'ibu_tempat_lahir',
        'ibu_tanggal_lahir',
        'ibu_agama',
        'ibu_pendidikan',
        'ibu_pekerjaan',
        'ibu_status_kawin',
        'ibu_no_kk',
        'ibu_warga_negara',
        'ibu_negara_nama',
        'ibu_no_passport',
        'ibu_kitas_kitap',
        'ibu_foto_ktp',
        'ayah_nama',
        'ayah_nik',
        'ayah_nik_jenis',
        'ayah_jenis_kelamin',
        'ayah_tempat_lahir',
        'ayah_tanggal_lahir',
        'ayah_agama',
        'ayah_pendidikan',
        'ayah_pekerjaan',
        'ayah_status_kawin',
        'ayah_no_kk',
        'ayah_warga_negara',
        'ayah_negara_nama',
        'ayah_no_passport',
        'ayah_kitas_kitap',
        'ayah_foto_ktp',
    ];

    protected $primaryKey = 'id';
    protected $table = 'surat_kelahirans';
    const tableName = 'surat_kelahirans';
}
