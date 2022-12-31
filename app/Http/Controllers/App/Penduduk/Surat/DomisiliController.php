<?php

namespace App\Http\Controllers\App\Penduduk\Surat;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratDomisili;
use App\Models\Surat\SuratTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Config\Exception\ValidationException;
use PDF;

class DomisiliController extends Controller
{
    public function index(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Domisili',
            'navigation' => 'penduduk.surat',
        ];
        $hub_dgn_kks = config('app.hub_dgn_kks');
        $pendidikans = config('app.pendidikans');
        $pekerjaans = config('app.pekerjaans');
        $agamas = config('app.agamas');

        // get surat current
        $penduduk = auth()->user()->penduduk;
        $data =  compact('page_attr', 'hub_dgn_kks', 'pendidikans', 'pekerjaans', 'agamas', 'penduduk');
        $data['compact'] = $data;
        return view('app.penduduk.surat.domisili.form', $data);
    }

    public function simpan(Request $request)
    {
        try {
            $request->validate([
                'nik' => ['required', 'string'],
                'nama' => ['required', 'string'],
                'tempat_lahir' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'tinggal_sejak' => ['required', 'date'],
                'jenis_kelamin' => ['required', 'string'],
                'agama' => ['required', 'string'],
                'status_kawin' => ['required', 'string'],
                'pendidikan' => ['required', 'string'],
                'pekerjaan' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'alamat_asal' => ['required', 'string'],
                'warga_negara' => ['required', 'string'],
                'negara_nama' => ['required', 'string'],
                'rt' => ['required', 'integer'],
                'rw' => ['required', 'integer'],
            ]);

            DB::beginTransaction();
            $SURAT_DI_RT = config('app.status_surats')[1];

            // simpan header surat
            // penduduk yang membuat surat
            $penduduk = auth()->user()->penduduk;

            // surat untuk penduduk
            $untuk_penduduk = Penduduk::where('nik', $request->nik)->first();

            // validasi rt dan rw
            // cek rt rw
            $rw = Rw::where('nomor', $request->rw)->first();
            if (is_null($rw)) {
                return response()->json([
                    'errors' => [
                        'rw' => ['Nomor RW Tidak Terdaftar']
                    ],
                    'message' => 'Something went wrong',
                ], 422);
            }


            $rt = Rt::where('nomor', $request->rt)->where('rw_id', $rw->id)->first();
            if (is_null($rt)) {
                return response()->json([
                    'errors' => [
                        'rt' => ['Nomor RT Tidak Terdaftar']
                    ],
                    'message' => 'Something went wrong',
                ], 422);
            }

            // kades
            $t_jabatan = PegawaiJabatan::tableName;
            $t_pegawai = Pegawai::tableName;
            $kades = Pegawai::join($t_jabatan, "$t_jabatan.id", '=', "$t_pegawai.jabatan_id")
                ->orderBy("$t_jabatan.urutan")
                ->first();
            $kades_penduduk = Penduduk::find($kades->penduduk_id);

            $surat = new Surat();
            // penduduk yang mengajukan
            $surat->penduduk_id = $penduduk->id;
            $surat->nama_penduduk = $penduduk->nama;
            $surat->nik_penduduk = $penduduk->nik;

            // rt
            $surat->rt_id = $rt->id;
            $surat->rt_pend_id = $rt->ketua->penduduk_id;
            $surat->rt_nik = $rt->ketua->penduduk->nik;
            $surat->rt_nama = $rt->ketua->penduduk->nama;

            // rw
            $surat->rw_id = $rw->id;
            $surat->rw_pend_id = $rw->ketua->penduduk_id;
            $surat->rw_nik = $rw->ketua->penduduk->nik;
            $surat->rw_nama = $rw->ketua->penduduk->nama;

            // kades
            $surat->kades_pend_id = $kades_penduduk->id;
            $surat->kades_nip = $kades->nip;
            $surat->kades_nama = $kades_penduduk->nama;
            $surat->kades_jabatan = $kades->jabatan->nama;

            $surat->untuk_penduduk_id = is_null($untuk_penduduk) ? null : $untuk_penduduk->id;
            $surat->nama_untuk_penduduk = $request->nama;
            $surat->nik_untuk_penduduk = $request->nik;
            $surat->no_resi = date('Ymdhis') . Str::upper(Str::random(4));;
            $surat->tanggal = date('Y-m-d');
            $surat->status = $SURAT_DI_RT;
            $surat->jenis = SuratDomisili::jenis;
            $surat->created_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = new SuratDomisili();
            $surat_body->surat_id = $surat->id;
            $surat_body->nama = $request->nama;
            $surat_body->tempat_lahir = $request->tempat_lahir;
            $surat_body->tanggal_lahir = $request->tanggal_lahir;
            $surat_body->jenis_kelamin = $request->jenis_kelamin;
            $surat_body->warga_negara = $request->warga_negara;
            $surat_body->negara_nama = $request->negara_nama;
            $surat_body->agama = $request->agama;
            $surat_body->status_kawin = $request->status_kawin;
            $surat_body->pendidikan = $request->pendidikan;
            $surat_body->nik = $request->nik;
            $surat_body->pekerjaan = $request->pekerjaan;
            $surat_body->warga_negara = $request->warga_negara;
            $surat_body->negara_nama = $request->negara_nama;
            $surat_body->alamat = $request->alamat;
            $surat_body->alamat_asal = $request->alamat_asal;
            $surat_body->tinggal_sejak = $request->tinggal_sejak;
            $surat_body->created_by = auth()->user()->id;
            $surat_body->save();

            // simpan dari penduduk ke rt
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = "untuk diperiksa dan disetujui";
            $tracking_surat->waktu = date('Y-m-d H:i:s');
            $tracking_surat->dari_nama = $surat->nama_penduduk;
            $tracking_surat->dari_nip = $surat->nik_penduduk;
            $tracking_surat->ke_nama = $surat->rt_nama;
            $tracking_surat->ke_nip = $surat->rt_nik;
            $tracking_surat->status = $SURAT_DI_RT;
            $tracking_surat->save();

            DB::commit();
            return response()->json(['status' => true]);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function perbaiki_simpan(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
                'surat_detail_id' => ['required', 'integer'],
                'nik' => ['required', 'string'],
                'nama' => ['required', 'string'],
                'tempat_lahir' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'tinggal_sejak' => ['required', 'date'],
                'jenis_kelamin' => ['required', 'string'],
                'agama' => ['required', 'string'],
                'status_kawin' => ['required', 'string'],
                'pendidikan' => ['required', 'string'],
                'pekerjaan' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'alamat_asal' => ['required', 'string'],
                'warga_negara' => ['required', 'string'],
                'negara_nama' => ['required', 'string'],
                'rt' => ['required', 'integer'],
                'rw' => ['required', 'integer'],
            ]);

            DB::beginTransaction();
            $SURAT_DI_RT = config('app.status_surats')[1];

            // simpan header surat
            // penduduk yang membuat surat
            $penduduk = auth()->user()->penduduk;

            // surat untuk penduduk
            $untuk_penduduk = Penduduk::where('nik', $request->nik)->first();

            // validasi rt dan rw
            // cek rt rw
            $rw = Rw::where('nomor', $request->rw)->first();
            if (is_null($rw)) {
                return response()->json([
                    'errors' => [
                        'rw' => ['Nomor RW Tidak Terdaftar']
                    ],
                    'message' => 'Something went wrong',
                ], 422);
            }


            $rt = Rt::where('nomor', $request->rt)->where('rw_id', $rw->id)->first();
            if (is_null($rt)) {
                return response()->json([
                    'errors' => [
                        'rt' => ['Nomor RT Tidak Terdaftar']
                    ],
                    'message' => 'Something went wrong',
                ], 422);
            }

            // kades
            $t_jabatan = PegawaiJabatan::tableName;
            $t_pegawai = Pegawai::tableName;
            $kades = Pegawai::join($t_jabatan, "$t_jabatan.id", '=', "$t_pegawai.jabatan_id")
                ->orderBy("$t_jabatan.urutan")
                ->first();
            $kades_penduduk = Penduduk::find($kades->penduduk_id);

            $surat = Surat::findOrFail($request->id);
            // penduduk yang mengajukan
            $surat->penduduk_id = $penduduk->id;
            $surat->nama_penduduk = $penduduk->nama;
            $surat->nik_penduduk = $penduduk->nik;

            // rt
            $surat->rt_id = $rt->id;
            $surat->rt_pend_id = $rt->ketua->penduduk_id;
            $surat->rt_nik = $rt->ketua->penduduk->nik;
            $surat->rt_nama = $rt->ketua->penduduk->nama;

            // rw
            $surat->rw_id = $rw->id;
            $surat->rw_pend_id = $rw->ketua->penduduk_id;
            $surat->rw_nik = $rw->ketua->penduduk->nik;
            $surat->rw_nama = $rw->ketua->penduduk->nama;

            // kades
            $surat->kades_pend_id = $kades_penduduk->id;
            $surat->kades_nip = $kades->nip;
            $surat->kades_nama = $kades_penduduk->nama;
            $surat->kades_jabatan = $kades->jabatan->nama;

            $surat->untuk_penduduk_id = is_null($untuk_penduduk) ? null : $untuk_penduduk->id;
            $surat->nama_untuk_penduduk = $request->nama;
            $surat->nik_untuk_penduduk = $request->nik;
            $surat->no_resi = date('Ymdhis') . Str::upper(Str::random(4));;
            $surat->tanggal = date('Y-m-d');
            $surat->status = $SURAT_DI_RT;
            $surat->jenis = SuratDomisili::jenis;
            $surat->created_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = SuratDomisili::findOrFail($request->surat_detail_id);
            $surat_body->surat_id = $surat->id;
            $surat_body->nama = $request->nama;
            $surat_body->tempat_lahir = $request->tempat_lahir;
            $surat_body->tanggal_lahir = $request->tanggal_lahir;
            $surat_body->jenis_kelamin = $request->jenis_kelamin;
            $surat_body->warga_negara = $request->warga_negara;
            $surat_body->negara_nama = $request->negara_nama;
            $surat_body->agama = $request->agama;
            $surat_body->status_kawin = $request->status_kawin;
            $surat_body->pendidikan = $request->pendidikan;
            $surat_body->nik = $request->nik;
            $surat_body->pekerjaan = $request->pekerjaan;
            $surat_body->warga_negara = $request->warga_negara;
            $surat_body->negara_nama = $request->negara_nama;
            $surat_body->alamat = $request->alamat;
            $surat_body->alamat_asal = $request->alamat_asal;
            $surat_body->tinggal_sejak = $request->tinggal_sejak;
            $surat_body->created_by = auth()->user()->id;
            $surat_body->save();

            // simpan dari penduduk ke rt
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = "pengajuan kembali";
            $tracking_surat->waktu = date('Y-m-d H:i:s');
            $tracking_surat->dari_nama = $surat->nama_penduduk;
            $tracking_surat->dari_nip = $surat->nik_penduduk;
            $tracking_surat->ke_nama = $surat->rt_nama;
            $tracking_surat->ke_nip = $surat->rt_nik;
            $tracking_surat->status = $SURAT_DI_RT;
            $tracking_surat->save();

            DB::commit();
            return response()->json(['status' => true]);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }


    public function detail(Surat $surat)
    {
        $page_attr = [
            'title' => 'Detail Surat Pengantar Keterangan Domisili',
            'navigation' => 'penduduk.pelacakan',
        ];

        $trackings = $surat->trackings()->orderBy('waktu', 'desc')->get();
        $data = compact('page_attr', 'surat', 'trackings');

        $data['compact'] = $data;
        return view('app.penduduk.surat.domisili.detail', $data);
    }

    public function print(Surat $surat, Request $request)
    {
        $page_attr = [
            'title' => 'Detail Surat Pengantar Keterangan Domisili',
            'navigation' => 'penduduk.pelacakan',
        ];

        $name = "Surat Keterangan Domisili {$surat->nama_untuk_penduduk}.pdf";

        $t_pegawai = Pegawai::tableName;
        $t_jabatan = PegawaiJabatan::tableName;
        $pegawai = Pegawai::join($t_jabatan, "$t_pegawai.jabatan_id", '=', "$t_jabatan.id")->orderBy("$t_jabatan.urutan", 'asc')->first();
        $data = compact('page_attr', 'surat', 'name', 'pegawai');

        $data['compact'] = $data;

        if (is_null($request->html)) {
            $pdf = PDF::loadView('app.penduduk.surat.domisili.print', $data)
                ->setPaper(config('app.paper_size.f4'), 'potrait');
            if ($request->download == 1) {
                return $pdf->download($name);
            } else {
                return $pdf->stream($name);
            }
            exit();
        } else {
            return view('app.penduduk.surat.domisili.print', $data);
        }
    }

    public function perbaiki(Surat $surat)
    {
        if ($surat->status != config('app.status_surats')[0] && !auth()->user()->hasRole(config('app.role_super_admin'))) {
            return abort(404);
        }
        $page_attr = [
            'title' => 'Perbaikan Surat Pengantar Keterangan Domisili',
            'navigation' => 'penduduk.surat',
        ];
        $hub_dgn_kks = config('app.hub_dgn_kks');
        $pendidikans = config('app.pendidikans');
        $pekerjaans = config('app.pekerjaans');
        $agamas = config('app.agamas');

        $nik_ada = Penduduk::where('nik', $surat->nik_untuk_penduduk)->count() > 0;

        // get surat current
        $penduduk = auth()->user()->penduduk;
        $data =  compact('page_attr',  'hub_dgn_kks', 'pendidikans', 'pekerjaans', 'agamas', 'penduduk', 'surat', 'nik_ada');
        $data['compact'] = $data;
        return view('app.penduduk.surat.domisili.perbaikan', $data);
    }
}
