<?php

namespace App\Http\Controllers\App\Desa\Surat;

use App\Http\Controllers\Controller;
use App\Models\Desa\Pegawai;
use App\Models\Desa\PegawaiJabatan;
use App\Models\Penduduk\KetuaRw;
use App\Models\Penduduk\Penduduk;
use App\Models\Surat\Surat;
use App\Models\Surat\SuratTracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

class ProsesSuratController extends Controller
{
    private $query = [];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->datatable($request);
        }
        $page_attr = [
            'title' => 'Proses Surat',
            'breadcrumbs' => [
                ['name' => 'Halaman Utama'],
            ]
        ];

        $pegawai = auth()->user()->penduduk->pegawai;

        $data =  compact('page_attr', 'pegawai');
        $data['compact'] = $data;
        return view('app.desa.surat.proses', $data);
    }

    public function simpan(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
                'pegawai_id' => ['required', 'integer'],
                'keterangan' => ['required', 'string'],
                'catatan' => ['nullable', 'string'],
                'selesai' => ['nullable'],
            ]);

            DB::beginTransaction();
            $dari_pegawai = auth()->user()->penduduk->pegawai;
            $ke_pegawai = Pegawai::findOrFail($request->pegawai_id);

            // simpan surat header
            $surat = Surat::findOrFail($request->id);
            $surat->updated_by = auth()->user()->id;
            $surat->save();

            // simpan tracking
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = $request->keterangan;
            $tracking_surat->catatan = $request->catatan;
            $tracking_surat->waktu = date('Y-m-d H:i:s');

            // dari
            $tracking_surat->dari_pegawai_id = $dari_pegawai->id;
            $tracking_surat->dari_nama = $dari_pegawai->penduduk->nama;
            $tracking_surat->dari_nip = $dari_pegawai->nip ?? $dari_pegawai->penduduk->nik;

            // ke
            $tracking_surat->ke_pegawai_id = $ke_pegawai->id;
            $tracking_surat->ke_nama = $ke_pegawai->penduduk->nama;
            $tracking_surat->ke_nip = $ke_pegawai->nip ?? $ke_pegawai->penduduk->nik;

            // set status
            $status = config('app.status_surats');
            // 3 pihak desa, 4 selesai

            $tracking_surat->status = is_null($request->selesai) ? $status[3] : $status[4];
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

    public function simpan_no_surat(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
                'no_surat' => ['required', 'string'],
            ]);

            DB::beginTransaction();
            $dari_pegawai = auth()->user()->penduduk->pegawai;

            // simpan surat header
            $surat = Surat::findOrFail($request->id);
            $surat->no_surat = $request->no_surat;
            $surat->updated_by = auth()->user()->id;
            $surat->save();

            // simpan tracking
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = "Input Nomor Surat : $request->no_surat";
            $tracking_surat->catatan = $request->catatan;
            $tracking_surat->waktu = date('Y-m-d H:i:s');

            // dari
            $tracking_surat->dari_pegawai_id = $dari_pegawai->id;
            $tracking_surat->dari_nama = $dari_pegawai->penduduk->nama;
            $tracking_surat->dari_nip = $dari_pegawai->nip ?? $dari_pegawai->penduduk->nik;

            // ke
            $tracking_surat->ke_pegawai_id = $dari_pegawai->id;
            $tracking_surat->ke_nama = $dari_pegawai->penduduk->nama;
            $tracking_surat->ke_nip = $dari_pegawai->nip ?? $dari_pegawai->penduduk->nik;

            // set status
            $status = config('app.status_surats');
            $pihak_desa = 3;

            $tracking_surat->status = $status[$pihak_desa];
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

    public function selesai(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
            ]);

            DB::beginTransaction();
            $dari_pegawai = auth()->user()->penduduk->pegawai;

            // simpan surat header
            $surat = Surat::findOrFail($request->id);
            $surat->updated_by = auth()->user()->id;
            $surat->save();

            // simpan tracking
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = 'surat selesai dan bisa diambil penduduk.';
            $tracking_surat->waktu = date('Y-m-d H:i:s');

            // dari
            $tracking_surat->dari_pegawai_id = $dari_pegawai->id;
            $tracking_surat->dari_nama = $dari_pegawai->penduduk->nama;
            $tracking_surat->dari_nip = $dari_pegawai->nip ?? $dari_pegawai->penduduk->nik;

            $tracking_surat->ke_pegawai_id = $dari_pegawai->id;
            $tracking_surat->ke_nama = $dari_pegawai->penduduk->nama;
            $tracking_surat->ke_nip = $dari_pegawai->nip ?? $dari_pegawai->penduduk->nik;

            // set status
            $status = config('app.status_surats');
            $tracking_surat->status = $status[4]; // selesai
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

    public function serahkan(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'integer'],
            ]);
            // set status
            $status = config('app.status_surats');

            DB::beginTransaction();
            $dari_pegawai = auth()->user()->penduduk->pegawai;

            // simpan surat header
            $surat = Surat::findOrFail($request->id);
            $surat->status = $status[4]; // selesai
            $surat->updated_by = auth()->user()->id;
            $surat->save();

            // simpan tracking
            $tracking_surat = new SuratTracking();
            $tracking_surat->surat_id = $surat->id;
            $tracking_surat->keterangan = 'Penyerahan surat';
            $tracking_surat->waktu = date('Y-m-d H:i:s');

            // dari
            $tracking_surat->dari_pegawai_id = $dari_pegawai->id;
            $tracking_surat->dari_nama = $dari_pegawai->penduduk->nama;
            $tracking_surat->dari_nip = $dari_pegawai->nip ?? $dari_pegawai->penduduk->nik;

            $tracking_surat->ke_nama = $surat->penduduk->nama;
            $tracking_surat->ke_nip = $surat->penduduk->nik;

            $tracking_surat->status = $status[0]; // selesai
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

    public function pegawai_select2(Request  $request)
    {
        try {
            $table = Pegawai::tableName;
            $t_jabatan = PegawaiJabatan::tableName;
            $t_penduduk = Penduduk::tableName;
            $pegawai = auth()->user()->penduduk->pegawai;

            $model = DB::table($table)->select([DB::raw("$table.id"), DB::raw("concat($t_jabatan.nama, ' | ', $t_penduduk.nama) as text")])
                ->whereRaw("($t_penduduk.nama like '%$request->search%' or $t_jabatan.nama like '%$request->search%' )")
                ->leftJoin($t_jabatan, "$t_jabatan.id", '=', "$table.jabatan_id")
                ->leftJoin($t_penduduk, "$t_penduduk.id", '=', "$table.penduduk_id")
                ->limit(20);
            if ($pegawai != null) {
                $model->where("$table.id", '<>', $pegawai->id);
            }
            $result = $model->get()->toArray();
            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }

    private function datatable(Request $request): mixed
    {
        $surat_status_desa = config('app.status_surats')[3];

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

        $c_catatan = 'tracking_catatan';
        $this->query = array_merge($this->query, $tracking_fun('catatan', $c_catatan));

        $c_pegawai_id = 'tracking_pegawai_id';
        $this->query = array_merge($this->query, $tracking_fun('ke_pegawai_id', $c_pegawai_id));

        $c_id = 'tracking_id';
        $this->query = array_merge($this->query, $tracking_fun('id', $c_id));

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
            $c_waktu_format,
            $c_catatan,
            $c_pegawai_id,
            $c_id
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

        // dan status nya masih di rw
        $model->where("$table.status", $surat_status_desa);

        // Filter =====================================================================================================
        // filter check
        $f_c = function (string $param) use ($request): mixed {
            $filter = $request->filter;
            return isset($filter[$param]) ? $filter[$param] : false;
        };

        // filter ini menurut data model filter
        $f = [$c_pegawai_id];
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
                'rw_id',
                'rw_pend_id',
                'rw_pend_id',
                'kades_pend_id',
                'rw_id',
                'nama_penduduk',
                'nik_penduduk',
                'nama_untuk_penduduk',
                'nik_untuk_penduduk',
                'rw_nik',
                'rw_nama',
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
}
