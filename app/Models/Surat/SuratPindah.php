<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPindah extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
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
        'ke_provinsi',
        'ke_kab_kota',
        'ke_kecamatan',
        'ke_desa_kel',
        'ke_rt_rw',
        'ke_alamat_lengkap',
        'alasan_pindah',
        'jml_pengikut',
        'updated_by',
        'created_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'surat_pindahs';
    const tableName = 'surat_pindahs';
    const jenis = 'SURAT PINDAH';

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id', 'id');
    }

    public function pengikuts()
    {
        return $this->hasMany(SuratPindahPengikut::class, 'surat_pindah_id', 'id');
    }
}
