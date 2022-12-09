<?php

namespace App\Http\Controllers\App\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Penduduk;
use App\Models\Surat\SuratKeteranganJenis;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{

    public function keterangan(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan',
        ];
        $hub_dgn_kks = config('app.hub_dgn_kks');
        $pendidikans = config('app.pendidikans');
        $pekerjaans = config('app.pekerjaans');
        $agamas = config('app.agamas');

        $jenis_keterangan = SuratKeteranganJenis::orderBy('nama')->get();
        $data =  compact('page_attr', 'jenis_keterangan',  'hub_dgn_kks', 'pendidikans', 'pekerjaans', 'agamas');
        $data['compact'] = $data;
        return view('app.penduduk.surat.keterangan', $data);
    }


    public function kelahiran(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Kelahiran',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.kelahiran', compact(
            'page_attr',
        ));
    }


    public function domisili(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Keterangan Domisili',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.domisili', compact(
            'page_attr',
        ));
    }


    public function kartu_keluarga(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengajuan Kartu Keluarga',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.kartu_keluarga', compact(
            'page_attr',
        ));
    }


    public function pindah(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Pindah',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.pindah', compact(
            'page_attr',
        ));
    }


    public function nikah(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Nikah',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.nikah', compact(
            'page_attr',
        ));
    }


    public function kematian(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan Kematian',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.kematian', compact(
            'page_attr',
        ));
    }

    public function cari_penduduk(Request $request)
    {
        $penduduk = Penduduk::where('nik', $request->nik)->first();
        if (is_null($penduduk)) {
            return response()->json([
                'message' => 'Nomor NIK Tidak Ditemukan'
            ], 400);
        }

        $penduduk->rt->rw;
        return $penduduk;
    }
}
