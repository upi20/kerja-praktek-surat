<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Penduduk\Penduduk;
use League\Config\Exception\ValidationException;

class UtilityController extends Controller
{
    public function getPendudukByNik(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required|integer'
            ]);

            $penduduk = Penduduk::where('nik', $request->nik)->first();
            if (is_null($penduduk)) {
                return ResponseFormatter::error([
                    'nik' => $request->nik
                ], "Penduduk dengan NIK $request->nik Tidak ditemukan", 404);
            }

            // ambil data rt rw, user
            $rt = $penduduk->rt;
            $user = $penduduk->user;
            $rw = $rt->rw;

            // unset dari data penduduk dan rt
            unset($penduduk->rt);
            unset($penduduk->user);
            unset($rt->rw);

            // buat data untuk response
            $data = [
                'penduduk' => $penduduk,
                'rt' => $rt,
                'rw' => $rw,
                'user' => $user,
            ];

            return ResponseFormatter::success($data, 'Authenticated');
        } catch (ValidationException $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Something went wrong', 500);
        }
    }
}
