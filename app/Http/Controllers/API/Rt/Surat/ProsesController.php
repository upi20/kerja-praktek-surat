<?php

namespace App\Http\Controllers\API\Rt\Surat;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\API\Penduduk\Surat\DomisiliController;
use App\Http\Controllers\API\Penduduk\Surat\KelahiranController;
use App\Http\Controllers\API\Penduduk\Surat\KeteranganController;
use App\Http\Controllers\API\Penduduk\Surat\NikahController;
use App\Http\Controllers\API\Penduduk\Surat\TrackingController;
use App\Http\Controllers\App\Rt\Surat\ProsesSuratController;
use App\Http\Controllers\Controller;
use App\Models\Penduduk\KetuaRt;
use App\Models\Surat\Surat;
use Illuminate\Http\Request;
use App\Models\Surat\SuratDomisili;
use App\Models\Surat\SuratKelahiran;
use App\Models\Surat\SuratKeterangan;
use App\Models\Surat\SuratNikah;
use League\Config\Exception\ValidationException;

class ProsesController extends Controller
{
    private $query = [];
    private $surat = null;
    public function __construct()
    {
        $this->surat = new ProsesSuratController();
    }

    public function list_surat(Request $request)
    {
        if ($cek = $this->isKetuaRt()) {
            return $cek;
        }
        $data = $this->surat->datatable($request);
        return ResponseFormatter::success([
            'data_total' => $data->original['recordsTotal'],
            'data_filtered' => $data->original['recordsFiltered'],
            'surats' => $data->original['data'],
        ]);
    }

    public function setujui(Request $request)
    {
        if ($cek = $this->isKetuaRt()) {
            return $cek;
        }
        try {
            $request->validate([
                'surat_id' => ['required', 'integer'],
                'keterangan' => ['required', 'string'],
                'catatan' => ['nullable', 'string'],
            ]);

            $request->request->add([
                'id' => $request->surat_id,
                'disetujui' => 1
            ]);

            $send = $this->surat->simpan($request);
            return ResponseFormatter::success($send, "Surat berhasil disetujui");
        } catch (ValidationException $error) {
            return ResponseFormatter::error($error, 'Server Error', 500);
        }
    }

    public function tolak(Request $request)
    {
        if ($cek = $this->isKetuaRt()) {
            return $cek;
        }
        try {
            $request->validate([
                'surat_id' => ['required', 'integer'],
                'keterangan' => ['required', 'string'],
                'catatan' => ['nullable', 'string'],
            ]);

            $request->request->add([
                'id' => $request->surat_id,
                'disetujui' => 0
            ]);

            $send = $this->surat->simpan($request);
            return ResponseFormatter::success($send, "Surat berhasil ditolak");
        } catch (ValidationException $error) {
            return ResponseFormatter::error($error, 'Server Error', 500);
        }
    }

    public function detail(Request $request)
    {
        try {
            $request->validate([
                'surat_id' => ['required', 'integer']
            ]);

            $surat = Surat::find($request->surat_id);

            if (!is_null($surat)) {
                switch ($surat->jenis) {
                    case SuratKelahiran::jenis:
                        $surat = new KelahiranController();
                        return $surat->detail($request);
                        break;

                    case SuratDomisili::jenis:
                        $surat = new DomisiliController();
                        return $surat->detail($request);
                        break;

                    case SuratKeterangan::jenis:
                        $surat = new KeteranganController();
                        return $surat->detail($request);
                        break;

                    case SuratNikah::jenis:
                        $surat = new NikahController();
                        return $surat->detail($request);
                        break;

                    default:
                        return ResponseFormatter::error([
                            'message' => 'Not found',
                            'error' => null,
                        ], 'Not found', 404);
                        break;
                }
            } else {
                return ResponseFormatter::error([
                    'message' => 'Not found',
                    'error' => null,
                ], 'Not found', 404);
            }
            return ResponseFormatter::success();
        } catch (ValidationException $error) {
            return ResponseFormatter::error($error, 'Server Error', 500);
        }
    }

    public function download(Request $request)
    {
        try {
            $request->validate([
                'surat_id' => ['required', 'integer']
            ]);

            $surat = Surat::find($request->surat_id);

            if (!is_null($surat)) {
                switch ($surat->jenis) {
                    case SuratKelahiran::jenis:
                        $surat = new KelahiranController();
                        return $surat->download($request);
                        break;

                    case SuratDomisili::jenis:
                        $surat = new DomisiliController();
                        return $surat->download($request);
                        break;

                    case SuratKeterangan::jenis:
                        $surat = new KeteranganController();
                        return $surat->download($request);
                        break;

                    case SuratNikah::jenis:
                        $surat = new NikahController();
                        return $surat->download($request);
                        break;

                    default:
                        return ResponseFormatter::error([
                            'message' => 'Not found',
                            'error' => null,
                        ], 'Not found', 404);
                        break;
                }
            } else {
                return ResponseFormatter::error([
                    'message' => 'Not found',
                    'error' => null,
                ], 'Not found', 404);
            }
            return ResponseFormatter::success();
        } catch (ValidationException $error) {
            return ResponseFormatter::error($error, 'Server Error', 500);
        }
    }

    public function pelacakan(Request $request)
    {
        $api_tracing = new TrackingController();
        return $api_tracing->detail($request);
    }

    private function isKetuaRt()
    {
        // cek apakah dia ketua rt
        $penduduk_id = auth()->user()->penduduk->id;
        $ketua_rw = KetuaRt::where('penduduk_id', $penduduk_id)->first();
        if (is_null($ketua_rw)) {
            return ResponseFormatter::error([
                'message' => '',
                'error' => null,
            ], 'Anda bukan seorang ketua RT', 401);
        } else {
            return false;
        }
    }
}
