<?php

namespace App\Http\Controllers\App\Admin\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

class PegawaiController extends Controller
{
    private $validate_model = [
        'nip' => ['nullable', 'integer', ('unique:' . Pegawai::tableName)],
        'jabatan_id' => ['required', 'integer'],
        'penduduk_id' => ['required', 'integer'],
    ];

    private $query = [];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->datatable($request);
        }
        $page_attr = [
            'title' => 'Pegawai',
            'breadcrumbs' => [
                ['name' => 'Kepegawaian'],
            ]
        ];
        $jabatans = PegawaiJabatan::orderBy('urutan')->get();
        $data = compact('page_attr', 'jabatans');
        $data['compact'] = $data;
        return view('app.admin.kepegawaian.pegawai', $data);
    }

    public function insert(Request $request): mixed
    {
        try {
            $request->validate($this->validate_model);
            DB::beginTransaction();
            // pasang role penduduk
            $penduduk = Penduduk::find($request->penduduk_id);
            $penduduk->save();
            $user = $penduduk->user;
            $user->assignRole(config('app.role_desa'));
            $user->save();

            // simpan pegawai
            $model = new Pegawai();
            $model->nip = $request->nip;
            $model->jabatan_id = $request->jabatan_id;
            $model->penduduk_id = $request->penduduk_id;
            $model->created_by = auth()->user()->id;
            $model->save();
            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function update(Request $request): mixed
    {
        try {
            $this->validate_model['nip'] = ['nullable', 'integer', ('unique:' . Pegawai::tableName . ',nip,' . $request->id)];
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));
            DB::beginTransaction();
            $model = Pegawai::findOrFail($request->id);

            // lepas role dari penduduk
            $penduduk = Penduduk::find($model->penduduk_id);
            $penduduk->save();
            $user = $penduduk->user;
            $user->removeRole(config('app.role_desa'));
            $user->save();

            // pasang role penduduk
            $penduduk = Penduduk::find($request->penduduk_id);
            $penduduk->save();
            $user = $penduduk->user;
            $user->assignRole(config('app.role_desa'));
            $user->save();

            $model->nip = $request->nip;
            $model->jabatan_id = $request->jabatan_id;
            $model->penduduk_id = $request->penduduk_id;
            $model->updated_by = auth()->user()->id;
            $model->save();
            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function delete(Pegawai $model): mixed
    {
        try {
            DB::beginTransaction();
            // lepas role dari penduduk
            $penduduk = Penduduk::find($model->penduduk_id);
            $penduduk->save();
            $user = $penduduk->user;
            $user->removeRole(config('app.role_desa'));
            $user->save();

            $model->delete();
            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function find(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->id);
        $pegawai->penduduk;
        $pegawai->jabatan;
        return $pegawai;
    }

    public function datatable(Request $request): mixed
    {
        // list table
        $table = Pegawai::tableName;
        $t_jabatan = PegawaiJabatan::tableName;
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

        $this->query = array_merge($this->query, $date_format_fun('created_at', '%d-%b-%Y', $c_created));
        $this->query = array_merge($this->query, $date_format_fun('created_at', '%W, %d %M %Y %H:%i:%s', $c_created_str));
        $this->query = array_merge($this->query, $date_format_fun('updated_at', '%d-%b-%Y', $c_updated));
        $this->query = array_merge($this->query, $date_format_fun('updated_at', '%W, %d %M %Y %H:%i:%s', $c_updated_str));

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

        // jabatan
        $c_jabatan_nama = 'jabatan_nama';
        $this->query[$c_jabatan_nama] = "$t_jabatan.nama";
        $this->query["{$c_jabatan_nama}_alias"] = $c_jabatan_nama;
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
            $c_penduduk_nama,
            $c_penduduk_nik,
            $c_jabatan_nama,
        ];

        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);
        // ========================================================================================================


        // Select =====================================================================================================
        $model = Pegawai::select(array_merge([
            DB::raw("$table.*"),
        ], $to_db_raw))
            ->leftJoin("$t_user as $t_created_by", "$t_created_by.id", '=', "$table.created_by")
            ->leftJoin("$t_user as $t_updated_by", "$t_updated_by.id", '=', "$table.updated_by")
            ->leftJoin($t_penduduk, "$t_penduduk.id", '=', "$table.penduduk_id")
            ->leftJoin($t_jabatan, "$t_jabatan.id", '=', "$table.jabatan_id");

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
        $filters = ['updated_by', 'created_by', 'jabatan_id'];
        foreach ($filters as  $f) {
            if ($f_c($f) !== false) {
                $model->whereRaw("$table.$f='{$f_c($f)}'");
            }
        }

        $model->orderBy('urutan');
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
            $search_add = ['nip', 'jabatan_id', 'penduduk_id', 'updated_by', 'created_by'];
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

    public function penduduk_select2(Request $request)
    {
        try {
            $table = Penduduk::tableName;
            $_pegawai = Pegawai::tableName;
            $model = DB::table($table)->select(['id', DB::raw("concat($table.nik, ' ', $table.nama) as text")])
                ->whereRaw("(
                    ($table.nama like '%$request->search%' or $table.nik like '%$request->search%' ) and 
                    ($table.id not in (select penduduk_id from $_pegawai))
                )")
                ->limit(20);
            $result = $model->get()->toArray();
            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
