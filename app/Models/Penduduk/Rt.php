<?php

namespace App\Models\Penduduk;

use App\Models\Surat\Surat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nama_ketua', 'nama_daerah', 'rw_id'];
    protected $primaryKey = 'id';
    protected $table = 'rts';
    const tableName = 'rts';

    public function rw()
    {
        return $this->belongsTo(Rt::class, 'rw_id', 'id');
    }

    public function surats()
    {
        return $this->hasMany(Surat::class, 'rw_id', 'id');
    }
}
