<?php

namespace App\Http\Controllers\App\Desa\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Keluar;
use App\Models\Penduduk\Masuk;
use App\Models\Penduduk\Penduduk;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\SocialMedia;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;

class PendudukKeluarController extends Controller
{
    private $validate_model = [
        'nik' => ['required', 'string'],
        'tanggal' => ['required', 'date'],
        'keluar_nama' => ['required', 'string'],
        'keluar_keterangan' => ['nullable', 'string'],
    ];

    private $query = [];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->datatable($request);
        }
        $page_attr = [
            'title' => 'Data Penduduk Keluar',
            'breadcrumbs' => [
                ['name' => 'Dashboard'],
            ]
        ];
        $hub_dgn_kks = config('app.hub_dgn_kks');
        $pendidikans = config('app.pendidikans');
        $pekerjaans = config('app.pekerjaans');

        $agamas = config('app.agamas');
        $data = compact('page_attr', 'hub_dgn_kks', 'pendidikans', 'pekerjaans', 'agamas');
        $data['compact'] = $data;
        return view('app.desa.penduduk.penduduk_keluar', $data);
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);
            DB::beginTransaction();

            // cek nik
            $penduduk = Penduduk::where('nik', $request->nik)->first();
            if (is_null($penduduk)) {
                return response()->json([
                    'errors' => [
                        'nik' => ['Nik Tidak Terdaftar']
                    ],
                    'message' => 'Something went wrong',
                ], 422);
            }

            // simpan data penduduk
            $penduduk->updated_by = auth()->user()->id;
            $penduduk->penduduk_ada = 'Tidak Ada';
            $penduduk->save();

            // catat penduduk keluar
            $keluar = new Keluar();
            $keluar->penduduk_id = $penduduk->id;
            $keluar->tanggal = $request->tanggal;
            $keluar->nama = $request->keluar_nama;
            $keluar->keterangan = $request->keluar_keterangan;
            $keluar->created_by = auth()->user()->id;
            $keluar->save();

            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));
            $keluar = Keluar::findOrFail($request->id);
            $keluar->tanggal = $request->tanggal;
            $keluar->nama = $request->keluar_nama;
            $keluar->keterangan = $request->keluar_keterangan;
            $keluar->save();

            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function delete(Keluar $model)
    {
        // bandingkan ambil data keluar terbaru dan data masuk terbaru
        // jika data yang paling baru adalah data keluar maka
        // status penduduk ada = "Tidak Ada"
        // begitupun sebaliknya
        // jika sama dengan bandingkan created_at nya
        try {
            DB::beginTransaction();
            $penduduk = $model->penduduk;
            $model->delete();

            $masuk = Masuk::where('penduduk_id', 1)->orderBy('tanggal', 'desc')->first();
            $keluar = Keluar::where('penduduk_id', 1)->orderBy('tanggal', 'desc')->first();

            $penduduk_ada = "Tidak Ada";
            if (is_null($keluar)) {
                $penduduk_ada = "Ada";
            } else {
                $keluar_tanggal = new DateTime($keluar->tanggal);
                $masuk_tanggal = new DateTime($masuk->tanggal);
                if ($masuk_tanggal > $keluar_tanggal) {
                    $penduduk_ada = "Ada";
                } else if ($masuk_tanggal == $keluar_tanggal) {
                    $penduduk_ada = "Sama";
                    $keluar_created_at = new DateTime($keluar->created_at);
                    $masuk_created_at = new DateTime($masuk->created_at);
                    if ($keluar_created_at > $masuk_created_at) {
                        $penduduk_ada = "Tidak Ada";
                    } else {
                        $penduduk_ada = "Ada";
                    }
                } else {
                    $penduduk_ada = "Tidak Ada";
                }
            }

            $penduduk = $model->penduduk;
            $penduduk->updated_by = auth()->user()->id;
            $penduduk->penduduk_ada = $penduduk_ada;
            $penduduk->save();

            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function datatable(Request $request): mixed
    {
        // list table
        $table = Keluar::tableName;
        $t_penduduk = Penduduk::tableName;
        $t_user = User::tableName;

        // cusotm query
        // ========================================================================================================
        // creted at and updated at
        $date_format_fun = function (string $select, string $format, string $alias) use ($table): array {
            $str = <<<SQL
                (DATE_FORMAT($table.$select, '$format'))
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };

        $c_created = 'created';
        $c_created_str = 'created_str';
        $c_updated = 'updated';
        $c_updated_str = 'updated_str';
        $c_tanggal_str = 'tanggal_str';

        $this->query = array_merge($this->query, $date_format_fun('created_at', '%d-%b-%Y', $c_created));
        $this->query = array_merge($this->query, $date_format_fun('created_at', '%W, %d %M %Y %H:%i:%s', $c_created_str));
        $this->query = array_merge($this->query, $date_format_fun('updated_at', '%d-%b-%Y', $c_updated));
        $this->query = array_merge($this->query, $date_format_fun('updated_at', '%W, %d %M %Y %H:%i:%s', $c_updated_str));
        $this->query = array_merge($this->query, $date_format_fun('tanggal', '%d-%b-%Y', $c_tanggal_str));

        // created_by
        $c_created_by = 'created_by_str';
        $t_created_by = 'b';
        $this->query[$c_created_by] = "$t_created_by.name";
        $this->query["{$c_created_by}_alias"] = $c_created_by;

        // updated_by
        $c_updated_by = 'updated_by_str';
        $t_updated_by = 'c';
        $this->query[$c_updated_by] = "$t_updated_by.name";
        $this->query["{$c_updated_by}_alias"] = $c_updated_by;

        // penduduk
        $c_penduduk_nama = 'penduduk_nama';
        $this->query[$c_penduduk_nama] = "$t_penduduk.nama";
        $this->query["{$c_penduduk_nama}_alias"] = $c_penduduk_nama;

        $c_penduduk_nik = 'penduduk_nik';
        $this->query[$c_penduduk_nik] = "$t_penduduk.nik";
        $this->query["{$c_penduduk_nik}_alias"] = $c_penduduk_nik;
        // ========================================================================================================


        // ========================================================================================================
        // select raw as alias
        $sraa = function (string $col): string {
            return $this->query[$col] . ' as ' . $this->query[$col . '_alias'];
        };
        $model_filter = [
            $c_created,
            $c_created_str,
            $c_updated,
            $c_updated_str,
            $c_created_by,
            $c_updated_by,
            $c_tanggal_str,
            $c_penduduk_nama,
            $c_penduduk_nik
        ];

        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);
        // ========================================================================================================


        // Select =====================================================================================================
        $model = Keluar::select(array_merge([
            DB::raw("$table.*"),
        ], $to_db_raw))
            ->leftJoin("$t_user as $t_created_by", "$t_created_by.id", '=', "$table.created_by")
            ->leftJoin("$t_user as $t_updated_by", "$t_updated_by.id", '=', "$table.updated_by")
            ->leftJoin($t_penduduk, "$t_penduduk.id", '=', "$table.penduduk_id");

        // Filter =====================================================================================================
        // filter check
        $f_c = function (string $param) use ($request): mixed {
            $filter = $request->filter;
            return isset($filter[$param]) ? $filter[$param] : false;
        };

        // filter ini menurut data model filter
        $f = [];
        // loop filter
        foreach ($f as $v) {
            if ($f_c($v)) {
                $model->whereRaw("{$this->query[$v]}='{$f_c($v)}'");
            }
        }

        // filter custom
        $filters = ['updated_by', 'created_by'];
        foreach ($filters as  $f) {
            if ($f_c($f) !== false) {
                $model->whereRaw("$table.$f='{$f_c($f)}'");
            }
        }
        // ========================================================================================================


        // ========================================================================================================
        $datatable = Datatables::of($model)->addIndexColumn();

        // search
        // ========================================================================================================
        $query_filter = $this->query;
        $datatable->filter(function ($query) use ($model_filter, $query_filter, $table) {
            $search = request('search');
            $search = isset($search['value']) ? $search['value'] : null;
            if ((is_null($search) || $search == '') && count($model_filter) > 0) return false;

            // tambah pencarian
            $search_add = ['penduduk_id', 'nama', 'keterangan', 'tanggal'];
            $search_add = array_map(function ($v) use ($table) {
                return "$table.$v";
            }, $search_add);
            $search_arr = array_merge($model_filter, $search_add);

            // pake or where
            $search_str = "(";
            foreach ($search_arr as $k => $v) {
                $or = (($k + 1) < count($search_arr)) ? 'or' : '';
                $column = isset($query_filter[$v]) ? $query_filter[$v] : $v;
                $search_str .= "$column like '%$search%' $or ";
            }

            $search_str .= ")";
            $query->whereRaw($search_str);
        });

        // create datatable
        return $datatable->make(true);
    }

    public function find(Request $request)
    {
        $keluar = Keluar::with('penduduk')->findOrFail($request->id);
        $keluar->penduduk->rt->rw;
        return $keluar;
    }

    public function find_by_nik(Request $request)
    {
        $penduduk = Penduduk::where('nik', $request->nik)->first();
        if (is_null($penduduk)) {
            return response()->json(['message' => 'Nik Tidak Ditemukan'], 400);
        }

        $penduduk->rt->rw;
        return $penduduk;
    }
}
