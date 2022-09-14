<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page_attr = ['title' => 'Halaman Utama'];
        return view('penduduk.home', compact(
            'page_attr',
        ));
    }
}
