<?php

namespace App\Http\Controllers\App\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Masuk;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PendudukMasukController extends Controller
{
    private $validate_model = [
        'nik' => ['required', 'string'],
        'no_kk' => ['required', 'string'],
        'hub_dgn_kk' => ['required', 'string'],
        'nama' => ['required', 'string'],
        'tempat_lahir' => ['required', 'string'],
        'tanggal_lahir' => ['required', 'date'],
        'jenis_kelamin' => ['required', 'string'],
        'agama' => ['required', 'string'],
        'pendidikan' => ['required', 'string'],
        'pekerjaan' => ['required', 'string'],
        'status_kawin' => ['required', 'string'],
        'warga_negara' => ['required', 'string'],
        'negara_nama' => ['required', 'string'],
        'rt' => ['required', 'integer'],
        'rw' => ['required', 'integer'],
        'alamat' => ['required', 'string'],
        'tanggal' => ['required', 'date'],
        'masuk_nama' => ['required', 'string'],
        'masuk_keterangan' => ['nullable', 'string'],
    ];

    private $query = [];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->datatable($request);
        }
        $page_attr = [
            'title' => 'Data Penduduk Masuk',
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
        return view('app.admin.penduduk.penduduk_masuk', $data);
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);
            DB::beginTransaction();

            // cek nik
            $penduduk = Penduduk::where('nik', $request->nik)->first();
            $new_penduduk = false;
            if (is_null($penduduk)) {
                $penduduk = new Penduduk();
                $penduduk->created_by = auth()->user()->id;
                $new_penduduk = true;
            } else {
                $penduduk->updated_by = auth()->user()->id;
            }

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
            // set urutan hub dgn kk
            $hub_dgn_kk_urutan = 0;

            foreach (config('app.hub_dgn_kks') as $v) {
                if ($v['nama'] == $request->hub_dgn_kk) {
                    $hub_dgn_kk_urutan = $v['urutan'];
                }
            }

            // simpan data penduduk
            $penduduk->nik = $request->nik;
            $penduduk->no_kk = $request->no_kk;
            $penduduk->hub_dgn_kk = $request->hub_dgn_kk;
            $penduduk->hub_dgn_kk_urutan = $hub_dgn_kk_urutan;
            $penduduk->nama = $request->nama;
            $penduduk->tempat_lahir = $request->tempat_lahir;
            $penduduk->tanggal_lahir = $request->tanggal_lahir;
            $penduduk->jenis_kelamin = $request->jenis_kelamin;
            $penduduk->agama = $request->agama;
            $penduduk->pendidikan = $request->pendidikan;
            $penduduk->pekerjaan = $request->pekerjaan;
            $penduduk->status_kawin = $request->status_kawin;
            $penduduk->warga_negara = $request->warga_negara;
            $penduduk->negara_nama = $request->negara_nama;
            $penduduk->rt_id = $rt->id;
            $penduduk->alamat = $request->alamat;
            $penduduk->penduduk_ada = 'Ada';
            $penduduk->save();

            // catat penduduk masuk
            $masuk = new Masuk();
            $masuk->penduduk_id = $penduduk->id;
            $masuk->tanggal = $request->tanggal;
            $masuk->nama = $request->masuk_nama;
            $masuk->keterangan = $request->masuk_keterangan;
            $masuk->alamat = $request->alamat_asal;
            $masuk->created_by = auth()->user()->id;
            $masuk->save();

            // buat user untuk penduduk login
            if ($new_penduduk) {
                $user = new User();
                $user->name = $penduduk->nama;
                $user->nik = $penduduk->nik;
                $user->penduduk_id = $penduduk->id;
                $user->password = bcrypt(config('app.password_default'));
                $user->active = 1;
                $user->created_by = auth()->user()->id;
                $user->save();
                $user->assignRole('Penduduk');
            }
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

            // set urutan hub dgn kk
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));
            $masuk = Masuk::findOrFail($request->id);
            $masuk->tanggal = $request->tanggal;
            $masuk->nama = $request->masuk_nama;
            $masuk->keterangan = $request->masuk_keterangan;
            $masuk->alamat = $request->alamat_asal;
            $masuk->updated_by = auth()->user()->id;
            $masuk->save();

            // set urutan hub dgn kk
            $hub_dgn_kk_urutan = 0;

            foreach (config('app.hub_dgn_kks') as $v) {
                if ($v['nama'] == $request->hub_dgn_kk) {
                    $hub_dgn_kk_urutan = $v['urutan'];
                }
            }
            $penduduk = $masuk->penduduk;
            $penduduk->nik = $request->nik;
            $penduduk->no_kk = $request->no_kk;
            $penduduk->hub_dgn_kk = $request->hub_dgn_kk;
            $penduduk->hub_dgn_kk_urutan = $hub_dgn_kk_urutan;
            $penduduk->nama = $request->nama;
            $penduduk->tempat_lahir = $request->tempat_lahir;
            $penduduk->tanggal_lahir = $request->tanggal_lahir;
            $penduduk->jenis_kelamin = $request->jenis_kelamin;
            $penduduk->agama = $request->agama;
            $penduduk->pendidikan = $request->pendidikan;
            $penduduk->pekerjaan = $request->pekerjaan;
            $penduduk->status_kawin = $request->status_kawin;
            $penduduk->warga_negara = $request->warga_negara;
            $penduduk->negara_nama = $request->negara_nama;
            $penduduk->rt_id = $rt->id;
            $penduduk->alamat = $request->alamat;
            $penduduk->penduduk_ada = 'Ada';
            $penduduk->updated_by = auth()->user()->id;
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

    public function delete(Masuk $model)
    {
        try {
            DB::beginTransaction();
            $penduduk = $model->penduduk;
            $model->delete();

            if ($penduduk->masuks->count() < 1) {
                $penduduk->delete();
            }

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
        $table = Masuk::tableName;
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
        $model = Masuk::select(array_merge([
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
        $masuk = Masuk::with('penduduk')->findOrFail($request->id);
        $masuk->penduduk->rt->rw;
        return $masuk;
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
