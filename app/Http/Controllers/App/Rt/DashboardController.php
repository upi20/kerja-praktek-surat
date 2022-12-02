<?php

namespace App\Http\Controllers\App\Rt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $page_attr = ['title' => 'Halaman Utama'];

        $data = compact(
            'page_attr',
        );
        $data['compact'] = $data;

        return view('app.rt.dashboard');
    }
}
