<?php

namespace App\Models\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Penduduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'rt_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_kawin',
        'no_kk',
        'hub_dgn_kk',
        'warga_negara',
        'negara_nama',
        'no_passport',
        'kitas_kitap',
        'foto_ktp',
    ];
    protected $primaryKey = 'id';
    protected $table = 'penduduks';
    const imageFolder = '/assets/upload';
    const tableName = 'penduduks';

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }


    protected function nama(): Attribute
    {
        return Attribute::make(set: fn ($value) => strtoupper($value));
    }

    protected function foto_ktp(): Attribute
    {
        $folder = self::imageFolder;
        return Attribute::make(get: fn ($value) => (is_null($value) ? null : asset("$folder/$value")));
    }
}
