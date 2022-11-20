<?php

namespace App\Models\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nama_ketua'];
    protected $primaryKey = 'id';
    protected $table = 'rws';
    const tableName = 'rws';

    public function rts()
    {
        return $this->hasMany(Rw::class, 'rw_id', 'id');
    }
}
