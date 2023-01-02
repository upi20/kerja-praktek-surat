<?php

namespace App\Http\Controllers\API\Penduduk\Surat;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\App\Penduduk\Surat\KeteranganController as SuratKeteranganController;
use App\Http\Controllers\App\Penduduk\Surat\TrackingController;
use App\Http\Controllers\Controller;
use App\Models\Surat\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function detail(Request $request)
    {
        $surat = Surat::find($request->surat_id);
        if (!is_null($surat)) {
            $tracking = (new TrackingController())->get_tracking($request->surat_id);
            $rt = $surat->rt;
            $rw = $rt->rw;

            $surat_body = $surat->keterangan;

            $surat->tanggal_format = Carbon::parse($surat->tanggal)->isoFormat('dddd, D MMMM Y');
            $surat->keterangan->tanggal_lahir_format = Carbon::parse($surat->keterangan->tanggal_lahir)->isoFormat('dddd, D MMMM Y');
            $surat->tanggal_dibatalkan_format = Carbon::parse($surat->tanggal_dibatalkan)->isoFormat('dddd, D MMMM Y');
            $surat->tanggal_dibatalkan_waktu_format = date('H:i:s', strtotime($surat->tanggal_dibatalkan));

            unset($surat->rt);
            unset($surat->user);
            unset($rt->rw);
            unset($surat->keterangan);

            return ResponseFormatter::success([
                'rt' => $rt,
                'rw' => $rw,
                'surat' => $surat,
                'surat_body' => $surat_body,
                'trackings' => $tracking
            ]);
        } else {
            return ResponseFormatter::error([
                'message' => 'Not found',
                'error' => null,
            ], 'Not found', 404);
        }
    }

    public function perbaiki(Request $request)
    {
        $result = $this->surat->perbaiki_simpan($request);
        return ResponseFormatter::success($result->original);
    }

    public function download(Request $request)
    {
        $surat = Surat::find($request->surat_id);
        if (!is_null($surat)) {
            $request->merge(['download' => 1]);
            return $this->surat->print($surat, $request);
        } else {
            return ResponseFormatter::error([
                'message' => 'Not found',
                'error' => null,
            ], 'Not found', 404);
        }
    }
}
