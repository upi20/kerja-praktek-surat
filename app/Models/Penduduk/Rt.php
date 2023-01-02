<?php

namespace App\Models\Penduduk;

use App\Models\Surat\Surat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor',
        'nama_ketua',
        'nama_daerah',
        'rw_id',
        'updated_by',
        'created_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'rts';
    const tableName = 'rts';

    protected function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }

    protected function surats()
    {
        return $this->hasMany(Surat::class, 'rw_id', 'id');
    }

    protected function ketua()
    {
        return $this->hasOne(KetuaRt::class, 'rt_id', 'id');
    }
}
