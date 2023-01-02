<?php

namespace App\Http\Controllers\API\Penduduk\Surat;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\App\Penduduk\Surat\DomisiliController as SuratDomisiliController;
use App\Http\Controllers\App\Penduduk\Surat\TrackingController;
use App\Http\Controllers\Controller;
use App\Models\Surat\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DomisiliController extends Controller
{
    private $surat = null;
    public function __construct()
    {
        $this->surat = new SuratDomisiliController();
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

            $surat_body = $surat->domisili;

            $surat->tanggal_format = Carbon::parse($surat->tanggal)->isoFormat('dddd, D MMMM Y');
            $surat->tanggal_dibatalkan_format = Carbon::parse($surat->tanggal_dibatalkan)->isoFormat('dddd, D MMMM Y');
            $surat->tanggal_dibatalkan_waktu_format = date('H:i:s', strtotime($surat->tanggal_dibatalkan));

            $surat->domisili->tanggal_lahir_format = Carbon::parse($surat->domisili->tanggal_lahir)->isoFormat('dddd, D MMMM Y');
            $surat->domisili->tanggal_sejak_format = Carbon::parse($surat->domisili->tanggal_sejak)->isoFormat('dddd, D MMMM Y');

            unset($surat->rt);
            unset($surat->user);
            unset($rt->rw);
            unset($surat->domisili);

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
