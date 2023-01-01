<?php

namespace App\Http\Controllers\App\Penduduk\Surat;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratKelahiran;
use App\Models\Surat\SuratTracking;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Config\Exception\ValidationException;
use PDF;

class KelahiranController extends Controller
{
    public function index(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Kelahiran',
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
        return view('app.penduduk.surat.kelahiran.form', $data);
    }

    public function simpan(Request $request)
    {
        try {
            $request->validate([
                'rt' => ['required', 'integer'],
                'rw' => ['required', 'integer'],
                'nama_anak' => ['required', 'string'],
                'tempat_lahir' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'waktu_lahir' => ['required', 'string'],
                'jenis_kelamin' => ['required', 'string'],
                'anak_ke' => ['required', 'integer', 'min:1'],
                'berat' => ['required', 'integer', 'min:1'],
                'panjang' => ['required', 'integer', 'min:1'],
                'ayah_nik' => ['required', 'string'],
                'ayah_nama' => ['required', 'string'],
                'ayah_tempat_lahir' => ['required', 'string'],
                'ayah_tanggal_lahir' => ['required', 'date'],
                'ayah_agama' => ['required', 'string'],
                'ayah_pekerjaan' => ['required', 'string'],
                'ayah_alamat' => ['required', 'string'],
                'ibu_nik' => ['required', 'string'],
                'ibu_nama' => ['required', 'string'],
                'ibu_tempat_lahir' => ['required', 'string'],
                'ibu_tanggal_lahir' => ['required', 'date'],
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

            // surat untuk penduduk
            $untuk_penduduk = Penduduk::where('nik', $request->ayah_nik)->first();
            $untuk_penduduk = $untuk_penduduk ?? Penduduk::where('nik', $request->ibu_nik)->first();

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
            $surat->jenis = SuratKelahiran::jenis;
            $surat->created_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = new SuratKelahiran();
            $surat_body->surat_id = $surat->id;

            // data
            $surat_body->ayah_id = is_null($ayah_penduduk) ? null : $ayah_penduduk->id;
            $surat_body->ibu_id = is_null($ibu_penduduk) ? null : $ibu_penduduk->id;

            $surat_body->nama_anak = $request->nama_anak;
            $surat_body->tempat_lahir = $request->tempat_lahir;
            $surat_body->tanggal_lahir = $request->tanggal_lahir;
            $surat_body->waktu_lahir = $request->waktu_lahir;
            $surat_body->jenis_kelamin = $request->jenis_kelamin;
            $surat_body->anak_ke = $request->anak_ke;
            $surat_body->berat = $request->berat;
            $surat_body->panjang = $request->panjang;
            $surat_body->ayah_nik = $request->ayah_nik;
            $surat_body->ayah_nama = $request->ayah_nama;
            $surat_body->ayah_tempat_lahir = $request->ayah_tempat_lahir;
            $surat_body->ayah_tanggal_lahir = $request->ayah_tanggal_lahir;
            $surat_body->ayah_agama = $request->ayah_agama;
            $surat_body->ayah_pekerjaan = $request->ayah_pekerjaan;
            $surat_body->ayah_alamat = $request->ayah_alamat;
            $surat_body->ibu_nik = $request->ibu_nik;
            $surat_body->ibu_nama = $request->ibu_nama;
            $surat_body->ibu_tempat_lahir = $request->ibu_tempat_lahir;
            $surat_body->ibu_tanggal_lahir = $request->ibu_tanggal_lahir;
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
                'rt' => ['required', 'integer'],
                'rw' => ['required', 'integer'],
                'nama_anak' => ['required', 'string'],
                'tempat_lahir' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'waktu_lahir' => ['required', 'string'],
                'jenis_kelamin' => ['required', 'string'],
                'anak_ke' => ['required', 'integer', 'min:1'],
                'berat' => ['required', 'integer', 'min:1'],
                'panjang' => ['required', 'integer', 'min:1'],
                'ayah_nik' => ['required', 'string'],
                'ayah_nama' => ['required', 'string'],
                'ayah_tempat_lahir' => ['required', 'string'],
                'ayah_tanggal_lahir' => ['required', 'date'],
                'ayah_agama' => ['required', 'string'],
                'ayah_pekerjaan' => ['required', 'string'],
                'ayah_alamat' => ['required', 'string'],
                'ibu_nik' => ['required', 'string'],
                'ibu_nama' => ['required', 'string'],
                'ibu_tempat_lahir' => ['required', 'string'],
                'ibu_tanggal_lahir' => ['required', 'date'],
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
            $surat->nama_untuk_penduduk = is_null($untuk_penduduk) ? $request->ayah_nama : $untuk_penduduk->nama;
            $surat->nik_untuk_penduduk = is_null($untuk_penduduk) ? $request->ayah_nik : $untuk_penduduk->nik;

            $surat->no_resi = date('Ymdhis') . Str::upper(Str::random(4));;
            $surat->tanggal = date('Y-m-d');
            $surat->status = $SURAT_DI_RT;
            $surat->jenis = SuratKelahiran::jenis;
            $surat->updated_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = SuratKelahiran::findOrFail($request->surat_detail_id);
            $surat_body->surat_id = $surat->id;

            // data
            $surat_body->ayah_id = is_null($ayah_penduduk) ? null : $ayah_penduduk->id;
            $surat_body->ibu_id = is_null($ibu_penduduk) ? null : $ibu_penduduk->id;

            $surat_body->nama_anak = $request->nama_anak;
            $surat_body->tempat_lahir = $request->tempat_lahir;
            $surat_body->tanggal_lahir = $request->tanggal_lahir;
            $surat_body->waktu_lahir = $request->waktu_lahir;
            $surat_body->jenis_kelamin = $request->jenis_kelamin;
            $surat_body->anak_ke = $request->anak_ke;
            $surat_body->berat = $request->berat;
            $surat_body->panjang = $request->panjang;
            $surat_body->ayah_nik = $request->ayah_nik;
            $surat_body->ayah_nama = $request->ayah_nama;
            $surat_body->ayah_tempat_lahir = $request->ayah_tempat_lahir;
            $surat_body->ayah_tanggal_lahir = $request->ayah_tanggal_lahir;
            $surat_body->ayah_agama = $request->ayah_agama;
            $surat_body->ayah_pekerjaan = $request->ayah_pekerjaan;
            $surat_body->ayah_alamat = $request->ayah_alamat;
            $surat_body->ibu_nik = $request->ibu_nik;
            $surat_body->ibu_nama = $request->ibu_nama;
            $surat_body->ibu_tempat_lahir = $request->ibu_tempat_lahir;
            $surat_body->ibu_tanggal_lahir = $request->ibu_tanggal_lahir;
            $surat_body->ibu_agama = $request->ibu_agama;
            $surat_body->ibu_pekerjaan = $request->ibu_pekerjaan;
            $surat_body->ibu_alamat = $request->ibu_alamat;

            $surat_body->updated_by = auth()->user()->id;
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
            'title' => 'Detail Surat Pengantar Keterangan Kelahiran',
            'navigation' => 'penduduk.pelacakan',
        ];

        $trackings = $surat->trackings()->orderBy('waktu', 'desc')->get();

        $data = compact('page_attr', 'surat', 'trackings');

        $data['compact'] = $data;
        return view('app.penduduk.surat.kelahiran.detail', $data);
    }

    public function print(Surat $surat, Request $request)
    {
        $page_attr = [
            'title' => 'Detail Surat Pengantar Keterangan Kelahiran',
            'navigation' => 'penduduk.pelacakan',
        ];

        $name = "Surat Keterangan Kelahiran {$surat->nama_untuk_penduduk}.pdf";

        $data = compact('page_attr', 'surat', 'name');

        $data['compact'] = $data;


        if (is_null($request->html)) {
            $pdf = PDF::loadView('app.penduduk.surat.kelahiran.print', $data)
                ->setPaper(config('app.paper_size.f4'), 'potrait');
            if ($request->download == 1) {
                return $pdf->download($name);
            } else {
                return $pdf->stream($name);
            }
            exit();
        } else {
            return view('app.penduduk.surat.kelahiran.print', $data);
        }
    }

    public function perbaiki(Surat $surat)
    {
        if ($surat->status != config('app.status_surats')[0]) {
            return abort(404);
        }
        $page_attr = [
            'title' => 'Perbaikan Surat Pengantar Keterangan Kelahiran',
            'navigation' => 'penduduk.surat',
        ];
        $hub_dgn_kks = config('app.hub_dgn_kks');
        $pendidikans = config('app.pendidikans');
        $pekerjaans = config('app.pekerjaans');
        $agamas = config('app.agamas');

        $nik_ayah_ada = Penduduk::where('nik', $surat->kelahiran->ayah_nik)->count() > 0;
        $nik_ibu_ada = Penduduk::where('nik', $surat->kelahiran->ibu_nik)->count() > 0;

        // get surat current
        $penduduk = auth()->user()->penduduk;
        $data =  compact('page_attr', 'hub_dgn_kks', 'pendidikans', 'pekerjaans', 'agamas', 'penduduk', 'surat',  'nik_ibu_ada', 'nik_ayah_ada');
        $data['compact'] = $data;
        return view('app.penduduk.surat.kelahiran.perbaikan', $data);
    }
}
