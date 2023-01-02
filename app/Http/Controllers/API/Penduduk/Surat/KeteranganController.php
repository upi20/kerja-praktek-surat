<?php

namespace App\Http\Controllers\API\Penduduk\Surat;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\App\Penduduk\Surat\KeteranganController as SuratKeteranganController;
use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratKeterangan;
use App\Models\Surat\SuratKeteranganJenis;
use App\Models\Surat\SuratTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Config\Exception\ValidationException;

class KeteranganController extends Controller
{
    private $surat = null;
    public function __construct()
    {
        $this->surat = new SuratKeteranganController();
    }

    public function jenis(Request $request)
    {
        $jenis = SuratKeteranganJenis::select([DB::raw('id as jenis_id'), 'nama'])
            ->orderBy('nama')->get();

        return ResponseFormatter::success(
            ['jenises' => $jenis]
        );
    }

    public function simpan(Request $request)
    {
        $result = $this->surat->simpan($request);
        return ResponseFormatter::success($result->original);
    }
}
