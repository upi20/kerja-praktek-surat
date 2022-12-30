<?php

namespace App\Http\Controllers\App\Penduduk\Surat;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratNikah;
use App\Models\Surat\SuratTracking;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Config\Exception\ValidationException;
use PDF;

class NikahController extends Controller
{
    public function index(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Nikah',
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
        return view('app.penduduk.surat.nikah.form', $data);
    }

    public function simpan(Request $request)
    {
        try {
            $request->validate([
                'rt' => ['required', 'integer'],
                'rw' => ['required', 'integer'],
                'calon_a' => ['required', 'string'],
                'calon_b' => ['required', 'string'],
                'tanggal' => ['required', 'date'],
                'waktu' => ['required', 'string'],
                'dengan_seorang' => ['required', 'string'],
                'anak_nik' => ['required', 'string'],
                'anak_no_kk' => ['required', 'string'],
                'anak_nama' => ['required', 'string'],
                'anak_tempat_lahir' => ['required', 'string'],
                'anak_tanggal_lahir' => ['required', 'date'],
                'anak_warga_negara' => ['required', 'string'],
                'anak_negara_nama' => ['required', 'string'],
                'anak_agama' => ['required', 'string'],
                'anak_status_kawin' => ['required', 'string'],
                'anak_pendidikan' => ['required', 'string'],
                'anak_pekerjaan' => ['required', 'string'],
                'anak_alamat' => ['required', 'string'],
                'calon_nik' => ['required', 'string'],
                'calon_no_kk' => ['required', 'string'],
                'calon_nama' => ['required', 'string'],
                'calon_tempat_lahir' => ['required', 'string'],
                'calon_tanggal_lahir' => ['required', 'date'],
                'calon_warga_negara' => ['required', 'string'],
                'calon_negara_nama' => ['required', 'string'],
                'calon_agama' => ['required', 'string'],
                'calon_status_kawin' => ['required', 'string'],
                'calon_pendidikan' => ['required', 'string'],
                'calon_pekerjaan' => ['required', 'string'],
                'calon_alamat' => ['required', 'string'],
                'ayah_nik' => ['required', 'string'],
                'ayah_nama' => ['required', 'string'],
                'ayah_tanggal_lahir' => ['required', 'date'],
                'ayah_warga_negara' => ['required', 'string'],
                'ayah_negara_nama' => ['required', 'string'],
                'ayah_agama' => ['required', 'string'],
                'ayah_pekerjaan' => ['required', 'string'],
                'ayah_alamat' => ['required', 'string'],
                'ibu_nik' => ['required', 'string'],
                'ibu_nama' => ['required', 'string'],
                'ibu_tanggal_lahir' => ['required', 'date'],
                'ibu_warga_negara' => ['required', 'string'],
                'ibu_negara_nama' => ['required', 'string'],
                'ibu_agama' => ['required', 'string'],
                'ibu_pekerjaan' => ['required', 'string'],
                'ibu_alamat' => ['required', 'string'],
            ]);

            DB::beginTransaction();
            $SURAT_DI_RT = config('app.status_surats')[1];

            // simpan header surat
            // penduduk yang membuat surat
            $penduduk = auth()->user()->penduduk;
            // ibu anak ayah calon penduduk_id
            $ayah_penduduk = Penduduk::where('nik', $request->ayah_nik)->first();
            $ibu_penduduk = Penduduk::where('nik', $request->ibu_nik)->first();
            $anak_penduduk = Penduduk::where('nik', $request->anak_nik)->first();
            $calon_penduduk = Penduduk::where('nik', $request->calon_nik)->first();

            // surat untuk penduduk
            $untuk_penduduk = Penduduk::where('nik', $request->ayah_nik)->first();

            $untuk_penduduk = $untuk_penduduk ?? Penduduk::where('nik', $request->ibu_nik)->first();
            $untuk_penduduk = $untuk_penduduk ?? Penduduk::where('nik', $request->anak_nik)->first();

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
            $surat->nama_untuk_penduduk = is_null($untuk_penduduk) ? $request->ayah_nama : $untuk_penduduk->nama;
            $surat->nik_untuk_penduduk = is_null($untuk_penduduk) ? $request->ayah_nik : $untuk_penduduk->nik;

            $surat->no_resi = date('Ymdhis') . Str::upper(Str::random(4));;
            $surat->tanggal = date('Y-m-d');
            $surat->status = $SURAT_DI_RT;
            $surat->jenis = SuratNikah::jenis;
            $surat->created_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = new SuratNikah();
            $surat_body->surat_id = $surat->id;

            // data
            $surat_body->ayah_id = is_null($ayah_penduduk) ? null : $ayah_penduduk->id;
            $surat_body->ibu_id = is_null($ibu_penduduk) ? null : $ibu_penduduk->id;
            $surat_body->anak_id = is_null($anak_penduduk) ? null : $anak_penduduk->id;
            $surat_body->calon_id = is_null($calon_penduduk) ? null : $calon_penduduk->id;

            $surat_body->calon_a = $request->calon_a;
            $surat_body->calon_b = $request->calon_b;
            $surat_body->tanggal = $request->tanggal;
            $surat_body->waktu = $request->waktu;
            $surat_body->dengan_seorang = $request->dengan_seorang;
            $surat_body->anak_nik = $request->anak_nik;
            $surat_body->anak_no_kk = $request->anak_no_kk;
            $surat_body->anak_nama = $request->anak_nama;
            $surat_body->anak_tempat_lahir = $request->anak_tempat_lahir;
            $surat_body->anak_tanggal_lahir = $request->anak_tanggal_lahir;
            $surat_body->anak_warga_negara = $request->anak_warga_negara;
            $surat_body->anak_negara_nama = $request->anak_negara_nama;
            $surat_body->anak_agama = $request->anak_agama;
            $surat_body->anak_status_kawin = $request->anak_status_kawin;
            $surat_body->anak_pendidikan = $request->anak_pendidikan;
            $surat_body->anak_pekerjaan = $request->anak_pekerjaan;
            $surat_body->anak_alamat = $request->anak_alamat;
            $surat_body->calon_nik = $request->calon_nik;
            $surat_body->calon_no_kk = $request->calon_no_kk;
            $surat_body->calon_nama = $request->calon_nama;
            $surat_body->calon_tempat_lahir = $request->calon_tempat_lahir;
            $surat_body->calon_tanggal_lahir = $request->calon_tanggal_lahir;
            $surat_body->calon_warga_negara = $request->calon_warga_negara;
            $surat_body->calon_negara_nama = $request->calon_negara_nama;
            $surat_body->calon_agama = $request->calon_agama;
            $surat_body->calon_status_kawin = $request->calon_status_kawin;
            $surat_body->calon_pendidikan = $request->calon_pendidikan;
            $surat_body->calon_pekerjaan = $request->calon_pekerjaan;
            $surat_body->calon_alamat = $request->calon_alamat;
            $surat_body->ayah_nik = $request->ayah_nik;
            $surat_body->ayah_nama = $request->ayah_nama;
            $surat_body->ayah_tanggal_lahir = $request->ayah_tanggal_lahir;
            $surat_body->ayah_warga_negara = $request->ayah_warga_negara;
            $surat_body->ayah_negara_nama = $request->ayah_negara_nama;
            $surat_body->ayah_agama = $request->ayah_agama;
            $surat_body->ayah_pekerjaan = $request->ayah_pekerjaan;
            $surat_body->ayah_alamat = $request->ayah_alamat;
            $surat_body->ibu_nik = $request->ibu_nik;
            $surat_body->ibu_nama = $request->ibu_nama;
            $surat_body->ibu_tanggal_lahir = $request->ibu_tanggal_lahir;
            $surat_body->ibu_warga_negara = $request->ibu_warga_negara;
            $surat_body->ibu_negara_nama = $request->ibu_negara_nama;
            $surat_body->ibu_agama = $request->ibu_agama;
            $surat_body->ibu_pekerjaan = $request->ibu_pekerjaan;
            $surat_body->ibu_alamat = $request->ibu_alamat;

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
            $surat->jenis = SuratNikah::jenis;
            $surat->created_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = SuratNikah::findOrFail($request->surat_detail_id);
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
            'title' => 'Detail Surat Pengantar Keterangan Nikah',
            'navigation' => 'penduduk.pelacakan',
        ];

        $trackings = $surat->trackings()->orderBy('waktu', 'desc')->get();
        $ayah_umur = age(new DateTime($surat->nikah->ayah_tanggal_lahir), new DateTime($surat->tanggal));
        $ibu_umur = age(new DateTime($surat->nikah->ibu_tanggal_lahir), new DateTime($surat->tanggal));

        $data = compact('page_attr', 'surat', 'trackings', 'ayah_umur', 'ibu_umur');

        $data['compact'] = $data;
        return view('app.penduduk.surat.nikah.detail', $data);
    }

    public function print(Surat $surat)
    {
        $page_attr = [
            'title' => 'Detail Surat Pengantar Keterangan Nikah',
            'navigation' => 'penduduk.pelacakan',
        ];

        $name = "Surat Keterangan Nikah {$surat->nama_untuk_penduduk}.pdf";

        $ayah_umur = age(new DateTime($surat->nikah->ayah_tanggal_lahir), new DateTime($surat->tanggal));
        $ibu_umur = age(new DateTime($surat->nikah->ibu_tanggal_lahir), new DateTime($surat->tanggal));

        $data = compact('page_attr', 'surat', 'name',  'ayah_umur', 'ibu_umur');

        $data['compact'] = $data;


        return view('app.penduduk.surat.nikah.print', $data);
        view()->share('app.penduduk.surat.nikah.print', $data);
        $pdf = PDF::loadView('app.penduduk.surat.nikah.print', $data)
            ->setPaper(config('app.paper_size.f4'), 'potrait');

        return $pdf->stream($name);
        exit();
    }

    public function perbaiki(Surat $surat)
    {
        if ($surat->status != config('app.status_surats')[0]) {
            return abort(404);
        }
        $page_attr = [
            'title' => 'Perbaikan Surat Pengantar Keterangan Nikah',
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
        return view('app.penduduk.surat.nikah.perbaikan', $data);
    }
}
