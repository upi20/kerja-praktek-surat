<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganJenis extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    protected $primaryKey = 'id';
    protected $table = 'surat_keterangan_jenis';
    const tableName = 'surat_keterangan_jenis';
}
