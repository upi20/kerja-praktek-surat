<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratNikah extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'ibu_id',
        'ayah_id',
        'anak_id',
        'calon_id',
        'tanggal',
        'waktu',
        'tempat',
        'dengan_seorang',
        'ibu_nik',
        'ibu_nama',
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
        'ayah_nik',
        'ayah_nama',
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
        'anak_nik',
        'anak_nama',
        'anak_nik_jenis',
        'anak_jenis_kelamin',
        'anak_tempat_lahir',
        'anak_tanggal_lahir',
        'anak_agama',
        'anak_pendidikan',
        'anak_pekerjaan',
        'anak_status_kawin',
        'anak_no_kk',
        'anak_warga_negara',
        'anak_negara_nama',
        'anak_no_passport',
        'anak_kitas_kitap',
        'anak_foto_ktp',
        'calon_nik',
        'calon_nama',
        'calon_nik_jenis',
        'calon_jenis_kelamin',
        'calon_tempat_lahir',
        'calon_tanggal_lahir',
        'calon_agama',
        'calon_pendidikan',
        'calon_pekerjaan',
        'calon_status_kawin',
        'calon_no_kk',
        'calon_warga_negara',
        'calon_negara_nama',
        'calon_no_passport',
        'calon_kitas_kitap',
        'calon_foto_ktp',
    ];
    protected $primaryKey = 'id';
    protected $table = 'surat_nikahs';
    const tableName = 'surat_nikahs';

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id', 'id');
    }

    public function ibu()
    {
        return $this->belongsTo(Penduduk::class, 'ibu_id', 'id');
    }

    public function ayah()
    {
        return $this->belongsTo(Penduduk::class, 'ayah_id', 'id');
    }

    public function anak()
    {
        return $this->belongsTo(Penduduk::class, 'anak_id', 'id');
    }

    public function calon()
    {
        return $this->belongsTo(Penduduk::class, 'calon_id', 'id');
    }
}
