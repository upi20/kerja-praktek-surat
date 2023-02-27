<?php

namespace App\Http\Controllers\App\Penduduk\Surat;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratPindah;
use App\Models\Surat\SuratPindahPengikut;
use App\Models\Surat\SuratTracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Config\Exception\ValidationException;
use PDF;

class PindahController extends Controller
{

    public function index(Request $request)
    {
        // penduduk yang membuat surat
        $penduduk = auth()->user()->penduduk;
        $SURAT_BARU_DIBUAT = config('app.status_surats')[6];

        $jenis = SuratPindah::jenis;
        $surat = Surat::where('status', $SURAT_BARU_DIBUAT)
            ->where('penduduk_id', $penduduk->id)
            ->where('jenis', $jenis)->first();

        if (is_null($surat)) {
            $surat = new Surat();
            // penduduk yang mengajukan
            $surat->penduduk_id = $penduduk->id;
            $surat->nama_penduduk = $penduduk->nama;
            $surat->nik_penduduk = $penduduk->nik;

            $surat->status = $SURAT_BARU_DIBUAT;
            $surat->jenis = SuratPindah::jenis;
            $surat->created_by = auth()->user()->id;
            $surat->save();


            $surat_body = new SuratPindah();
            $surat_body->surat_id = $surat->id;
            $surat_body->created_by = auth()->user()->id;
            $surat_body->save();

            $surat = Surat::find($surat->id);
        }

        return $this->form_surat($surat, $request);
    }

    public function simpan(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
                'surat_detail_id' => ['required', 'integer'],
                'rt' => ['required', 'integer'],
                'rw' => ['required', 'integer'],
                'nik' => ['required', 'string'],
                'nama' => ['required', 'string'],
                'jenis_kelamin' => ['required', 'string'],
                'tempat_lahir' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'warga_negara' => ['required', 'string'],
                'negara_nama' => ['required', 'string'],
                'agama' => ['required', 'string'],
                'pendidikan' => ['required', 'string'],
                'pekerjaan' => ['required', 'string'],
                'status_kawin' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'ke_alamat_lengkap' => ['required', 'string'],
                'ke_rt' => ['required', 'integer'],
                'ke_rw' => ['required', 'integer'],
                'ke_desa_kel' => ['required', 'string'],
                'ke_kecamatan' => ['required', 'string'],
                'ke_kab_kota' => ['required', 'string'],
                'ke_provinsi' => ['required', 'string'],
                'alasan_pindah' => ['required', 'string'],
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
            if (is_null($rw) ? true : is_null($rw->ketua)) {
                return response()->json([
                    'errors' => [
                        'rw' => ['Nomor RW Tidak Terdaftar']
                    ],
                    'message' => 'Ada yang salah, Mohon periksa kembali !',
                ], 422);
            }


            $rt = Rt::where('nomor', $request->rt)->where('rw_id', $rw->id)->first();
            if (is_null($rt) ? true : is_null($rt->ketua)) {
                return response()->json([
                    'errors' => [
                        'rt' => ['Nomor RT Tidak Terdaftar']
                    ],
                    'message' => 'Ada yang salah, Mohon periksa kembali !',
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
            $surat->jenis = SuratPindah::jenis;
            $surat->updated_by = auth()->user()->id;
            $surat->save();

            // body
            $surat_body = SuratPindah::findOrFail($request->surat_detail_id);
            $surat_body->surat_id = $surat->id;

            $surat_body->nama = $request->nama;
            $surat_body->jenis_kelamin = $request->jenis_kelamin;
            $surat_body->tempat_lahir = $request->tempat_lahir;
            $surat_body->tanggal_lahir = $request->tanggal_lahir;
            $surat_body->warga_negara = $request->warga_negara;
            $surat_body->negara_nama = $request->negara_nama;
            $surat_body->agama = $request->agama;
            $surat_body->pendidikan = $request->pendidikan;
            $surat_body->pekerjaan = $request->pekerjaan;
            $surat_body->status_kawin = $request->status_kawin;
            $surat_body->alamat = $request->alamat;
            $surat_body->ke_alamat_lengkap = $request->ke_alamat_lengkap;
            $surat_body->ke_rt = $request->ke_rt;
            $surat_body->ke_rw = $request->ke_rw;
            $surat_body->ke_desa_kel = $request->ke_desa_kel;
            $surat_body->ke_kecamatan = $request->ke_kecamatan;
            $surat_body->ke_kab_kota = $request->ke_kab_kota;
            $surat_body->ke_provinsi = $request->ke_provinsi;
            $surat_body->alasan_pindah = $request->alasan_pindah;

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
                'message' => 'Ada yang salah, Mohon periksa kembali !',
                'error' => $error,
            ], 500);
        }
    }

    public function detail(Surat $surat)
    {
        $page_attr = [
            'title' => 'Detail Surat Pengantar Keterangan Pindah',
            'navigation' => 'penduduk.pelacakan',
        ];

        $trackings = $surat->trackings()->orderBy('waktu', 'desc')->get();
        $data = compact('page_attr', 'surat', 'trackings');

        $data['compact'] = $data;
        return view('app.penduduk.surat.pindah.detail', $data);
    }

    public function print(Surat $surat, Request $request)
    {
        $page_attr = [
            'title' => 'Detail Surat Pengantar Keterangan Pindah',
            'navigation' => 'penduduk.pelacakan',
        ];

        $name = "Surat Keterangan Pindah {$surat->nama_untuk_penduduk}.pdf";

        $t_pegawai = Pegawai::tableName;
        $t_jabatan = PegawaiJabatan::tableName;
        $pegawai = Pegawai::join($t_jabatan, "$t_pegawai.jabatan_id", '=', "$t_jabatan.id")->orderBy("$t_jabatan.urutan", 'asc')->first();
        $data = compact('page_attr', 'surat', 'name', 'pegawai');

        $data['compact'] = $data;

        if (is_null($request->html)) {
            $pdf = PDF::loadView('app.penduduk.surat.pindah.print', $data)
                ->setPaper(config('app.paper_size.f4'), 'potrait');
            if ($request->download == 1) {
                return $pdf->download($name);
            } else {
                return $pdf->stream($name);
            }
            exit();
        } else {
            return view('app.penduduk.surat.pindah.print', $data);
        }
    }

    public function form_surat(Surat $surat, Request $request)
    {
        $is_super_admin = auth()->user()->hasRole(config('app.role_super_admin'));
        $SURAT_STATUS_PENDUDUK = config('app.status_surats')[0];
        $SURAT_STATUS_BARU_DIBUAT = config('app.status_surats')[6];

        if (!in_array($surat->status, [$SURAT_STATUS_BARU_DIBUAT, $SURAT_STATUS_PENDUDUK]) && !$is_super_admin) {
            return abort(404);
        }

        $page_attr = [
            'title' => ((($SURAT_STATUS_BARU_DIBUAT == $surat->status) ? 'Form' : 'Perbaikan') . ' Surat Pengantar Keterangan Pindah'),
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
        return view('app.penduduk.surat.pindah.form', $data);
    }


    // pengikut =======================================================================================================
    public function pengikut_simpan(Request $request)
    {
        try {
            $request->validate([
                'surat_pindah_id' => ['required', 'integer'],
                'nik' => ['required', 'string'],
                'nama' => ['required', 'string'],
                'jenis_kelamin' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'pendidikan' => ['required', 'string'],
                'pekerjaan' => ['required', 'string'],
                'keterangan' => ['nullable', 'string'],
            ]);

            DB::beginTransaction();
            $penduduk = Penduduk::where('nik', $request->nik)->first();

            $pengikut = new SuratPindahPengikut();
            $pengikut->penduduk_id = is_null($penduduk) ? null : $penduduk->id;
            $pengikut->surat_pindah_id = $request->surat_pindah_id;
            $pengikut->nik = $request->nik;
            $pengikut->nama = $request->nama;
            $pengikut->jenis_kelamin = $request->jenis_kelamin;
            $pengikut->tanggal_lahir = $request->tanggal_lahir;
            $pengikut->pendidikan = $request->pendidikan;
            $pengikut->pekerjaan = $request->pekerjaan;
            $pengikut->keterangan = $request->keterangan;
            $pengikut->created_by = auth()->user()->id;
            $pengikut->save();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Ada yang salah, Mohon periksa kembali !',
                'error' => $error,
            ], 500);
        }
    }

    public function pengikut_update(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
                'surat_pindah_id' => ['required', 'integer'],
                'nik' => ['required', 'string'],
                'nama' => ['required', 'string'],
                'jenis_kelamin' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'pendidikan' => ['required', 'string'],
                'pekerjaan' => ['required', 'string'],
                'keterangan' => ['nullable', 'string'],
            ]);

            DB::beginTransaction();
            $penduduk = Penduduk::where('nik', $request->nik)->first();
            $pengikut = SuratPindahPengikut::findOrFail($request->id);
            $pengikut->penduduk_id = is_null($penduduk) ? null : $penduduk->id;
            $pengikut->surat_pindah_id = $request->surat_pindah_id;
            $pengikut->nik = $request->nik;
            $pengikut->nama = $request->nama;
            $pengikut->jenis_kelamin = $request->jenis_kelamin;
            $pengikut->tanggal_lahir = $request->tanggal_lahir;
            $pengikut->pendidikan = $request->pendidikan;
            $pengikut->pekerjaan = $request->pekerjaan;
            $pengikut->keterangan = $request->keterangan;
            $pengikut->created_by = auth()->user()->id;
            $pengikut->save();
            DB::commit();
            return response()->json(['status' => true]);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Ada yang salah, Mohon periksa kembali !',
                'error' => $error,
            ], 500);
        }
    }

    public function pengikut_list(Surat $surat)
    {
        $pengikuts = $surat->pindah->pengikuts->map(function ($pengikut) {
            $pengikut->umur = Carbon::parse($pengikut->tanggal_lahir)->age;
            unset($pengikut->created_at);
            unset($pengikut->updated_at);
            unset($pengikut->created_by);
            unset($pengikut->updated_by);
            $result = $pengikut;
            return $result;
        });
        return response()->json(['pengikuts' => $pengikuts, 'jumlah' => $pengikuts->count()]);
    }


    public function pengikut_hapus(SuratPindahPengikut $pengikut)
    {
        try {
            $pengikut->delete();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Ada yang salah, Mohon periksa kembali !',
                'error' => $error,
            ], 500);
        }
    }
}
