<?php

namespace App\Http\Controllers\App\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{

    public function keterangan(Request $request)
    {
        $page_attr = [
            'title' => 'Form Surat Pengantar Keterangan',
            'navigation' => 'penduduk.home'
        ];
        return view('penduduk.form_surat.keterangan', compact(
            'page_attr',
        ));
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
}
