<?php

namespace App\Http\Controllers\App\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaSuratController extends Controller
{
    private $folder_logo = '/assets/setting/admin/logo';
    private $folder_meta_logo = '/assets/setting/admin/meta';
    private $key = 'setting.penerimma_surat.pegawai_id';

    public function index(Request $request)
    {
        $page_attr = [
            'title' => 'Pengaturan',
        ];
        $pegawai_id = settings()->get($this->key);
        $pegawai = Pegawai::find($pegawai_id);
        $data = compact('page_attr', 'pegawai_id', 'pegawai');
        $data['compact'] = $data;

        return view('app.admin.pengaturan.penerima_surat',  $data);
    }

    public function simpan(Request $request)
    {
        $pegawai_id = $request->pegawai_id;
        $result = settings()->set($this->key, $pegawai_id)->save();
        return response()->json($result);
    }

    public function pegawai_select2(Request  $request)
    {
        try {
            $table = Pegawai::tableName;
            $t_jabatan = PegawaiJabatan::tableName;
            $t_penduduk = Penduduk::tableName;

            $model = DB::table($table)->select([DB::raw("$table.id"), DB::raw("concat($t_jabatan.nama, ' | ', $t_penduduk.nama) as text")])
                ->whereRaw("(
                    ($t_penduduk.nama like '%$request->search%' or $t_jabatan.nama like '%$request->search%' )
                )")
                ->leftJoin($t_jabatan, "$t_jabatan.id", '=', "$table.jabatan_id")
                ->leftJoin($t_penduduk, "$t_penduduk.id", '=', "$table.penduduk_id")
                ->limit(20);
            $result = $model->get()->toArray();
            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
