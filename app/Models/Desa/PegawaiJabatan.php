<?php

namespace App\Models\Desa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'urutan',
        'updated_by',
        'created_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'pegawai_jabatans';
    const tableName = 'pegawai_jabatans';

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'jabatan_id', 'id');
    }
}
