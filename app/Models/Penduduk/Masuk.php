<?php

namespace App\Models\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'penduduk_id', 'nama', 'keterangan', 'tanggal',
        'updated_by',
        'created_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_masuks';
    const tableName = 'penduduk_masuks';

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
