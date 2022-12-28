<?php

namespace App\Http\Controllers\App\Penduduk\Surat;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Penduduk\Penduduk;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratTracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

class TrackingController extends Controller
{
    private $query = [];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->datatable($request);
        }
        $page_attr = [
            'title' => 'Pelacakan Surat',
            'breadcrumbs' => [
                ['name' => 'Halaman Utama'],
            ]
        ];
        $data =  compact('page_attr');
        $data['compact'] = $data;
        return view('app.penduduk.surat.tracking', $data);
    }

    public function datatable(Request $request): mixed
    {
        $penduduk_id = auth()->user()->penduduk->id;
        // list table
        $table = Surat::tableName;
        $t_penduduk = Penduduk::tableName;
        $t_user = User::tableName;
        $t_tracking = SuratTracking::tableName;

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
        $this->query = array_merge($this->query, $date_format_fun('tanggal', '%W, %d %b %Y', $c_tanggal_str));

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

        // tracking ========
        $tracking_fun = function (string $select, string $alias) use ($table, $t_tracking): array {
            $str = <<<SQL
                (select $select from $t_tracking where $t_tracking.surat_id = $table.id order by $t_tracking.waktu desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_status = 'tracking_status';
        $this->query = array_merge($this->query, $tracking_fun('status', $c_status));

        $c_waktu = 'tracking_waktu';
        $this->query = array_merge($this->query, $tracking_fun('waktu', $c_waktu));

        $c_waktu_format = 'tracking_waktu_format';
        $this->query = array_merge($this->query, $tracking_fun("DATE_FORMAT(waktu,  '%W, %d %b %Y %H:%i:%s')", $c_waktu_format));

        $c_dari_nama = 'tracking_dari_nama';
        $this->query = array_merge($this->query, $tracking_fun('dari_nama', $c_dari_nama));

        $c_ke_nama = 'tracking_ke_nama';
        $this->query = array_merge($this->query, $tracking_fun('ke_nama', $c_ke_nama));

        $c_keterangan = 'tracking_keterangan';
        $this->query = array_merge($this->query, $tracking_fun('keterangan', $c_keterangan));

        $c_status = 'tracking_status';
        $this->query = array_merge($this->query, $tracking_fun('status', $c_status));

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
            $c_status,
            $c_waktu,
            $c_dari_nama,
            $c_ke_nama,
            $c_keterangan,
            $c_waktu_format
        ];

        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);
        // ========================================================================================================


        // Select =====================================================================================================
        $model = Surat::select(array_merge([
            DB::raw("$table.*"),
        ], $to_db_raw))
            ->leftJoin("$t_user as $t_created_by", "$t_created_by.id", '=', "$table.created_by")
            ->leftJoin("$t_user as $t_updated_by", "$t_updated_by.id", '=', "$table.updated_by")
            ->leftJoin($t_penduduk, "$t_penduduk.id", '=', "$table.penduduk_id");
        $model->whereRaw("($table.penduduk_id = '$penduduk_id' or $table.untuk_penduduk_id = '$penduduk_id')");
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
            $search_add = [
                'penduduk_id',
                'untuk_penduduk_id',
                'rt_id',
                'rt_pend_id',
                'rw_pend_id',
                'kades_pend_id',
                'rw_id',
                'nama_penduduk',
                'nik_penduduk',
                'nama_untuk_penduduk',
                'nik_untuk_penduduk',
                'rt_nik',
                'rt_nama',
                'rw_nik',
                'rw_nama',
                'kades_nip',
                'kades_nama',
                'no_surat',
                'no_resi',
                'foto_pbb',
                'foto_kk',
                'reg_no',
                'tanggal',
                'status',
                'jenis',
                'dibatalkan',
                'alasan_dibatalkan',
                'tanggal_dibatalkan',
                'updated_by',
                'created_by'
            ];
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

    public function list_tracking($surat_id)
    {
        $result = $this->get_tracking($surat_id);
        $code = $result->count() > 0 ? 200 : 404;
        return response()->json($result, $code);
    }

    public function list_tracking_api(Request $request)
    {
        $surat = Surat::find($request->surat_id);
        $result = $this->get_tracking($request->surat_id);
        if ($result->count() > 0) {
            return ResponseFormatter::success([
                'surat' => $surat,
                'trackings' => $result
            ]);
        } else {
            return ResponseFormatter::error([
                'message' => 'Not found',
                'error' => null,
            ], 'Not found', 404);
        }
    }

    public function get_tracking($surat_id)
    {
        $table = SuratTracking::tableName;
        $select = <<<SQL
            $table.*,
            DATE_FORMAT(waktu,  '%H:%i %d %b %Y') as waktu,
            $table.waktu as waktu_origin
        SQL;
        $result = SuratTracking::selectRaw($select)->where('surat_id', $surat_id)->orderBy('waktu_origin', 'desc')->get();
        return $result;
    }

    public function batalkan_surat(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
                'alasan_dibatalkan' => ['required', 'string'],
            ]);

            DB::beginTransaction();
            $SURAT_DI_BATALKAN = config('app.status_surats')[5];

            // get surat
            $surat = Surat::findOrFail($request->id);
            $surat->dibatalkan = 1;
            $surat->alasan_dibatalkan = $request->alasan_dibatalkan;
            $surat->tanggal_dibatalkan = date("Y-m-d H:i:s");
            $surat->status = $SURAT_DI_BATALKAN;
            $surat->save();

            // get order terakhir
            $tracking = SuratTracking::where('surat_id', $surat->id)
                ->orderBy('waktu', 'desc')
                ->first();

            // simpan dari penduduk ke rt
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = "Dibatalkan";
            $tracking_surat->waktu = date('Y-m-d H:i:s');
            $tracking_surat->dari_nama = $tracking->ke_nama;
            $tracking_surat->dari_nip = $tracking->ke_nik;

            $tracking_surat->ke_nama = $surat->nama_penduduk;
            $tracking_surat->ke_nip = $surat->nik_penduduk;

            $tracking_surat->status = $SURAT_DI_BATALKAN;
            $tracking_surat->save();

            DB::commit();
            return response()->json(['status' => true]);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }
}
