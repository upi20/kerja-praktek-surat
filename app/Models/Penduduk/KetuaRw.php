<?php

namespace App\Models\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetuaRw extends Model
{
    use HasFactory;
    protected $fillable = ['rw_id', 'penduduk_id'];
    protected $primaryKey = 'id';
    protected $table = 'ketua_rws';
    const tableName = 'ketua_rws';

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
