<?php

namespace App\Http\Controllers\App\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk\Masuk;
use App\Models\Penduduk\Penduduk;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;

class PendudukMasukController extends Controller
{
    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'icon' => ['required', 'string', 'max:255'],
        'url' => ['required', 'string', 'max:255'],
        'keterangan' => ['required', 'string', 'max:255'],
        'status' => ['required', 'int'],
        'order' => ['required', 'int'],
    ];

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
        return view('admin.penduduk.penduduk_masuk', compact('page_attr'));
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);

            $model = new SocialMedia();
            $model->url = $request->url;
            $model->icon = $request->icon;
            $model->nama = $request->nama;
            $model->keterangan = $request->keterangan;
            $model->status = $request->status;
            $model->order = $request->order;
            // $model->created_by = auth()->user()->id;
            $model->save();
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
            $model = SocialMedia::find($request->id);
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));

            $model->url = $request->url;
            $model->icon = $request->icon;
            $model->nama = $request->nama;
            $model->keterangan = $request->keterangan;
            $model->status = $request->status;
            $model->order = $request->order;
            // $model->updated_by = auth()->user()->id;
            $model->save();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function delete(SocialMedia $model)
    {
        try {
            $model->delete();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function select2(Request $request)
    {
        try {
            $model = SocialMedia::select(['id', DB::raw('nama as text')])
                ->whereRaw("(`nama` like '%$request->search%' or `id` like '%$request->search%')")
                ->limit(10);

            $result = $model->get()->toArray();
            if ($request->with_empty && $request->search) {
                $result = array_merge([['id' => $request->search, 'text' => $request->search . ' (Buat Sosial Media Baru)']], $result);
            }

            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }









    public function datatable(Request $request): mixed
    {
        // list table
        $table = Masuk::tableName;
        $t_penduduk = Penduduk::tableName;

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
        $c_tanggal_pakai_dari_str = 'tanggal_pakai_dari_str';
        $c_tanggal_pakai_sampai_str = 'tanggal_pakai_sampai_str';
        $c_tanggal_kirim_str = 'tanggal_kirim_str';
        $c_tanggal_order_str = 'tanggal_order_str';
        $this->query = array_merge($this->query, $date_format_fun('created_at', '%d-%b-%Y', $c_created));
        $this->query = array_merge($this->query, $date_format_fun('created_at', '%W, %d %M %Y %H:%i:%s', $c_created_str));
        $this->query = array_merge($this->query, $date_format_fun('updated_at', '%d-%b-%Y', $c_updated));
        $this->query = array_merge($this->query, $date_format_fun('updated_at', '%W, %d %M %Y %H:%i:%s', $c_updated_str));
        $this->query = array_merge($this->query, $date_format_fun('tanggal_pakai_dari', '%d-%b-%Y', $c_tanggal_pakai_dari_str));
        $this->query = array_merge($this->query, $date_format_fun('tanggal_pakai_sampai', '%d-%b-%Y', $c_tanggal_pakai_sampai_str));
        $this->query = array_merge($this->query, $date_format_fun('tanggal_kirim', '%d-%b-%Y', $c_tanggal_kirim_str));
        $this->query = array_merge($this->query, $date_format_fun('tanggal_order', '%d-%b-%Y', $c_tanggal_order_str));

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

        // customer
        $c_customer_nama = 'customer_nama';
        $this->query[$c_customer_nama] = "$t_customer.nama";
        $this->query["{$c_customer_nama}_alias"] = $c_customer_nama;

        // customer
        $c_customer_alamat = 'customer_alamat';
        $this->query[$c_customer_alamat] = "$t_customer.alamat";
        $this->query["{$c_customer_alamat}_alias"] = $c_customer_alamat;

        // status
        $c_status_str = 'status_str';
        $this->query[$c_status_str] = <<<SQL
            (if($table.status = 1,'Penyewaan Dibuat', 
            if($table.status = 2,'Faktur Dibuat', 
            if($table.status = 3,'Barang Diambil', 
            if($table.status = 4,'Barang Dikembalikan', 
            if($table.status = 5,'Selesai',  
            if($table.status = 9,'Dibatalkan',  'Tidak Diketahui')))))))
        SQL;
        $this->query["{$c_status_str}_alias"] = $c_status_str;

        // status_pembayaran
        $c_status_pembayaran_str = 'status_pembayaran_str';
        $this->query[$c_status_pembayaran_str] = <<<SQL
            (if($table.status_pembayaran = 1,'Lunas', 'Belum Lunas'))
        SQL;
        $this->query["{$c_status_pembayaran_str}_alias"] = $c_status_pembayaran_str;

        // status_pengambilan
        $c_status_pengambilan_str = 'status_pengambilan_str';
        $this->query[$c_status_pengambilan_str] = <<<SQL
            (if($t_surat_jalan.status = 1,'Data Disimpan', 
            if($t_surat_jalan.status = 2,'Barang Dikirim',
            if($t_surat_jalan.status = 3,'Pengembalian Disimpan',
            if($t_surat_jalan.status = 4,'Pengembalian Selesai', 'Data Dibuat')))))
        SQL;
        $this->query["{$c_status_pengambilan_str}_alias"] = $c_status_pengambilan_str;

        // proses_penyewaan
        $c_proses_penyewaan = 'proses_penyewaan';
        $this->query[$c_proses_penyewaan] = <<<SQL
            (if($t_surat_jalan.status = 0,'pengiriman', 
            if($t_surat_jalan.status = 1,'pengiriman',
            if($t_surat_jalan.status = 2,'pengembalian',
            if($t_surat_jalan.status = 3,'pengembalian', 
            if($t_surat_jalan.status = 4,'pengembalian', 'pengiriman'))))))
        SQL;
        $this->query["{$c_proses_penyewaan}_alias"] = $c_proses_penyewaan;

        // status_pengambilan
        $c_status_pengambilan = 'status_pengambilan';
        $this->query[$c_status_pengambilan] = "$t_surat_jalan.status";
        $this->query["{$c_status_pengambilan}_alias"] = $c_status_pengambilan;

        // status_ganti_rugi
        $c_status_ganti_rugi_str = 'status_ganti_rugi_str';
        $this->query[$c_status_ganti_rugi_str] = <<<SQL
                    (if($t_ganti_rugi.status = 0,'Data Dibuat',
                    if($t_ganti_rugi.status = 1,'Proses',
                    if($t_ganti_rugi.status = 2,'Selesai',
                    if($t_ganti_rugi.status is null,'Selesai', 'Tidak diketahui')))))
                SQL;
        $this->query["{$c_status_ganti_rugi_str}_alias"] = $c_status_ganti_rugi_str;

        // status_ganti_rugi
        $c_status_ganti_rugi = 'status_ganti_rugi';
        $this->query[$c_status_ganti_rugi] = <<<SQL
                    (if($t_ganti_rugi.status is null, 2 ,$t_ganti_rugi.status))
                SQL;
        $this->query["{$c_status_ganti_rugi}_alias"] = $c_status_ganti_rugi;

        // sisa
        $c_sisa = 'sisa';
        $this->query[$c_sisa] = <<<SQL
            ifnull(($table.total_harga - $table.dibayar),0)
        SQL;
        $this->query["{$c_sisa}_alias"] = $c_sisa;

        // pakai hari
        $c_pakai_hari = 'pakai_hari';
        $this->query[$c_pakai_hari] = '(DATEDIFF(tanggal_pakai_sampai, tanggal_pakai_dari)+1)';
        $this->query["{$c_pakai_hari}_alias"] = $c_pakai_hari;

        // tanggal_pengambilan
        $c_tanggal_pengambilan = 'tanggal_pengambilan';
        $this->query[$c_tanggal_pengambilan] = "date_format($t_surat_jalan.tanggal, '%d-%b-%Y')";
        $this->query["{$c_tanggal_pengambilan}_alias"] = $c_tanggal_pengambilan;
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
            $c_tanggal_pakai_dari_str,
            $c_tanggal_pakai_sampai_str,
            $c_tanggal_order_str,
            $c_customer_nama,
            $c_pakai_hari,
            $c_tanggal_kirim_str,
            $c_status_str,
            $c_status_pembayaran_str,
            $c_sisa,
            $c_tanggal_pengambilan,
            $c_status_pengambilan,
            $c_status_pengambilan_str,
            $c_proses_penyewaan,
            $c_customer_alamat,
            $c_status_ganti_rugi_str,
            $c_status_ganti_rugi
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
            ->leftJoin($t_surat_jalan, "$t_surat_jalan.penyewaan", '=', "$table.id")
            ->leftJoin($t_ganti_rugi, "$t_ganti_rugi.penyewaan_id", '=', "$table.id")
            ->leftJoin($t_customer, "$t_customer.id", '=', "$table.customer");

        // Filter =====================================================================================================
        // filter check
        $f_c = function (string $param) use ($request): mixed {
            $filter = $request->filter;
            return isset($filter[$param]) ? $filter[$param] : false;
        };

        // filter ini menurut data model filter
        $f = [$c_status_pengambilan_str, $c_proses_penyewaan];
        // loop filter
        foreach ($f as $v) {
            if ($f_c($v)) {
                $model->whereRaw("{$this->query[$v]}='{$f_c($v)}'");
            }
        }

        // filter custom
        $filters = ['updated_by', 'created_by', 'customer', 'status', 'status_pembayaran', 'status_pengembalian'];
        foreach ($filters as  $f) {
            if ($f_c($f) !== false) {
                $model->whereRaw("$table.$f='{$f_c($f)}'");
            }
        }

        $model->where("$table.status", '<>', 0);
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
            $search_add = ['customer', 'lokasi', 'tanggal_kirim', 'tanggal_pakai_dari', 'tanggal_pakai_sampai', 'kepada', 'tanggal_order', 'status', 'total_harga', 'dibayar', 'status_pembayaran', 'batal_keterangan', 'batal_tanggal', 'batal_oleh', 'updated_by', 'created_by', 'number'];
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


    // insert
    // insert data belum ada
    // insert data Sudah ada
    // update hanya tanggal, nama dan keterangan
    // delete
    // cek nik

}
