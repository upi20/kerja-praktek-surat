<?php

namespace App\Models\Penduduk;

use App\Models\Surat\Surat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;
    protected $fillable = ['nomor', 'nama_ketua', 'updated_by', 'created_by'];
    protected $primaryKey = 'id';
    protected $table = 'rws';
    const tableName = 'rws';

    protected function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id', 'id');
    }

    protected function surats()
    {
        return $this->hasMany(Surat::class, 'rt_id', 'id');
    }

    protected function ketua()
    {
        return $this->hasOne(KetuaRw::class, 'rw_id', 'id');
    }
}
