<?php

namespace App\Models\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetuaRt extends Model
{
    use HasFactory;
    protected $fillable = ['rt_id', 'penduduk_id', 'updated_by', 'created_by'];
    protected $primaryKey = 'id';
    protected $table = 'ketua_rts';
    const tableName = 'ketua_rts';

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
