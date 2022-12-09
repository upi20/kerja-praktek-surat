<?php

namespace App\Models\Desa;

use App\Models\Penduduk\Penduduk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip',
        'jabatan_id',
        'penduduk_id',
        'updated_by',
        'created_by'
    ];

    protected $primaryKey = 'id';
    protected $table = 'pegawais';
    const tableName = 'pegawais';

    public function jabatan()
    {
        return $this->belongsTo(PegawaiJabatan::class, 'jabatan_id', 'id');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
