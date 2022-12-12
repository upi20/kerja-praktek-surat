<?php

namespace App\Http\Controllers\API\Penduduk\Surat;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratKeterangan;
use App\Models\Surat\SuratKeteranganJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KeteranganController extends Controller
{
    public function simpan(Request $request)
    {
        DB::beginTransaction();

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
        $surat->kades_nik = $kades_penduduk->nik;
        $surat->kades_nama = $kades_penduduk->nama;

        $surat->untuk_penduduk_id = is_null($untuk_penduduk) ? null : $untuk_penduduk->id;
        $surat->nama_untuk_penduduk = $request->nama;
        $surat->nik_untuk_penduduk = $request->nik;
        $surat->no_resi = date('Ymdhis') . Str::upper(Str::random(4));;
        $surat->tanggal = date('Y-m-d');
        $surat->status = config('app.status_surats')[1]; // rt yang bersangkutan
        $surat->jenis = SuratKeterangan::jenis;
        $surat->created_by = auth()->user()->id;
        $surat->save();

        // body
        $surat_keterangan = new SuratKeterangan();
        $surat_keterangan->surat_id = $surat->id;
        $surat_keterangan->jenis_surat_keterangan_id = $request->jenis_surat;

        // di dalam surat
        $surat_keterangan->nama = $request->nama;
        $surat_keterangan->tempat_lahir = $request->tempat_lahir;
        $surat_keterangan->tanggal_lahir = $request->tanggal_lahir;
        $surat_keterangan->jenis_kelamin = $request->jenis_kelamin;
        $surat_keterangan->warga_negara = $request->warga_negara;
        $surat_keterangan->negara_nama = $request->negara_nama;
        $surat_keterangan->agama = $request->agama;
        $surat_keterangan->status_kawin = $request->status_kawin;
        $surat_keterangan->pendidikan = $request->pendidikan;
        $surat_keterangan->nik = $request->nik;
        $surat_keterangan->pekerjaan = $request->pekerjaan;
        $surat_keterangan->alamat = $request->alamat;
        $surat_keterangan->created_by = auth()->user()->id;
        $surat_keterangan->save();
        DB::commit();
        return response()->json(['status' => true]);
    }

    public function jenisSuratKeterangan(Request $request)
    {
    }
}
