<?php

namespace App\Models\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nama_ketua', 'nama_daerah', 'rw_id'];
    protected $primaryKey = 'id';
    protected $table = 'rws';
    const tableName = 'rws';

    public function rws()
    {
        return $this->belongsTo(Rt::class, 'rw_id', 'id');
    }
}
