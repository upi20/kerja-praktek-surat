<?php

namespace App\Models\Penduduk;

use App\Models\Desa\Pegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'updated_by',
        'created_by',
    ];
    protected $primaryKey = 'id';
    protected $table = 'penduduks';
    const imageFolder = '/assets/upload';
    const tableName = 'penduduks';
    protected $appends = ['tanggal_lahir_text'];

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }


    protected function nama(): Attribute
    {
        return Attribute::make(set: fn ($value) => strtoupper($value));
    }

    protected function fotoKtp(): Attribute
    {
        $folder = self::imageFolder;
        return Attribute::make(get: fn ($value) => (is_null($value) ? null : asset("$folder/$value")));
    }

    protected function keluars()
    {
        return $this->hasMany(Keluar::class, 'penduduk_id', 'id');
    }

    protected function masuks()
    {
        return $this->hasMany(Masuk::class, 'penduduk_id', 'id');
    }

    protected function getTanggalLahirTextAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_lahir'])
            ->isoFormat("D MMMM Y");
    }

    protected function user()
    {
        return $this->hasOne(User::class, 'penduduk_id', 'id');
    }

    protected function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'penduduk_id', 'id');
    }
}
