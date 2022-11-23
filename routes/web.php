<?php

// ====================================================================================================================

use App\Http\Controllers\Admin\Pendaftaran\GFormController;

// ====================================================================================================================
// utility ============================================================================================================
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Controller =========================================================================================================
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LoaderController;

// ====================================================================================================================
// Frontend ===========================================================================================================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\GaleriController as GaleriControllerFrontend;
use App\Http\Controllers\Frontend\ArtikelController;
use App\Models\Penduduk\KetuaRt;
use App\Models\Penduduk\KetuaRw;
use App\Models\Penduduk\Penduduk;
use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

// ====================================================================================================================
// ====================================================================================================================

// auth ===============================================================================================================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name("login");
    Route::get('/migrate', function (Faker $faker) {
        return "Success";
        die;
        // delete
        DB::table(KetuaRt::tableName)->delete();
        DB::table(KetuaRw::tableName)->delete();
        DB::table(Penduduk::tableName)->delete();
        DB::table(Rt::tableName)->delete();
        DB::table(Rw::tableName)->delete();

        $pendidikans = function ($hub = false) use ($faker) {
            if ($hub == 'anak') {
                return $faker->randomElement([
                    'SLTA / SEDERAJAT',
                    'SLTP/SEDERAJAT',
                    'BELUM TAMAT SD/SEDERAJAT',
                    'DIPLOMA IV/ STRATA I',
                    'Akademi/Sarjana Muda',
                    'AKADEMI/ DIPLOMA III/S. MUDA',
                    'DIPLOMA I / II',
                ]);
            } else if ($hub == 'istri') {
                return $faker->randomElement([
                    'TIDAK / BELUM SEKOLAH',
                    'TAMAT SD / SEDERAJAT',
                    'SLTA / SEDERAJAT',
                    'SLTP/SEDERAJAT',
                    'BELUM TAMAT SD/SEDERAJAT',
                    'DIPLOMA IV/ STRATA I',
                    'Akademi/Sarjana Muda',
                    'AKADEMI/ DIPLOMA III/S. MUDA',
                    'DIPLOMA I / II',
                    'STRATA II',
                    'STRATA III',
                ]);
            } else {
                return $faker->randomElement([
                    'TIDAK / BELUM SEKOLAH',
                    'TAMAT SD / SEDERAJAT',
                    'SLTA / SEDERAJAT',
                    'SLTP/SEDERAJAT',
                    'BELUM TAMAT SD/SEDERAJAT',
                    'DIPLOMA IV/ STRATA I',
                    'Akademi/Sarjana Muda',
                    'AKADEMI/ DIPLOMA III/S. MUDA',
                    'DIPLOMA I / II',
                    'STRATA II',
                    'STRATA III',
                ]);
            }
        };

        $pekerjaans = function ($hub = false) use ($faker) {
            if ($hub == 'anak') {
                return $faker->randomElement([
                    'TIDAK BEKERJA',
                    'PEGAWAI SWASTA',
                    'PELAJAR',
                    'MAHASISWA',
                ]);
            } else if ($hub == 'istri') {
                return $faker->randomElement([
                    'IBU RUMAH TANGGA',
                    'PEGAWAI NEGERI SIPIL',
                    'PEGAWAI SWASTA',
                    'PEDAGANG',
                ]);
            } else {
                return $faker->randomElement([
                    'PEGAWAI NEGERI SIPIL',
                    'ABRI/POLRI',
                    'PEGAWAI SWASTA',
                    'PETANI',
                    'PEDAGANG',
                    'PENSIUNAN',
                    'PRA SEKOLAH',
                    'LAINNYA',
                ]);
            }
        };

        $agamas = function () use ($faker) {
            return $faker->randomElement([
                'ISLAM',
                'ISLAM',
                'ISLAM',
                'ISLAM',
                'KRISTEN',
                'KATOLIK',
                'HINDU',
                'BUDHA',
                // 'KEPERCAYAAN TERHADAP TUHAN YME',
            ]);
        };

        $hub_dgn_kks = [
            ['urutan' => 1, 'nama' => 'KEPALA KELUARGA'],
            ['urutan' => 2, 'nama' => 'SUAMI'],
            ['urutan' => 3, 'nama' => 'ISTRI'],
            ['urutan' => 4, 'nama' => 'ANAK'],
            ['urutan' => 5, 'nama' => 'MENANTU'],
            ['urutan' => 6, 'nama' => 'CUCU'],
            ['urutan' => 7, 'nama' => 'ORANG TUA'],
            ['urutan' => 8, 'nama' => 'MERTUA'],
            ['urutan' => 9, 'nama' => 'FAMILI LAIN'],
            ['urutan' => 10, 'nama' => 'PEMBANTU'],
            ['urutan' => 11, 'nama' => 'LAINNYA'],
        ];

        $jml_rw = 20;
        $jml_rt = 10;
        $jml_kk_rt = 12;
        $nik_counter = 1;

        for ($rw_no = 1; $rw_no <= $jml_rw; $rw_no++) {
            $rw = new Rw();
            $rw->nama = "RW $rw_no";
            $rw->nama_ketua = "Ketua RW $rw_no";
            $rw->save();
            for ($rt_no = 1; $rt_no <= $jml_rt; $rt_no++) {
                $rt = new Rt();
                $rt->nama = "RT $rt_no";
                $rt->nama_ketua = "Ketua RT $rt_no / RW $rw_no";
                $rt->nama_daerah = "Kampung RT $rt_no / RW $rw_no";
                $rt->rw_id = $rw->id;
                $rt->save();


                // tambah data penduduk
                for ($kk = 1; $kk <= $jml_kk_rt; $kk++) {
                    // ================================================================================================
                    // kepala keluarga jika rt = 1 maka jadi ketua rw dan yg kedua jadi ketua rt
                    $tanggal_lahir = $faker->dateTimeBetween('-40 years', '1990-01-01 23:59:59');
                    $no_kk = date("simdH")  . date_format($tanggal_lahir, 'His');
                    $agama = $agamas();
                    $alamat = $faker->address();

                    $kepala = new Penduduk();
                    $kepala->nik = str_pad($nik_counter++, 16, '0', STR_PAD_LEFT);;
                    $kepala->nama = $faker->name('male');
                    $kepala->jenis_kelamin = 'LAKI-LAKI';
                    $kepala->tempat_lahir = $faker->city();
                    $kepala->tanggal_lahir = date_format($tanggal_lahir, 'Y-m-d');
                    $kepala->agama = $agama;
                    $kepala->pendidikan = $pendidikans();
                    $kepala->pekerjaan = $pekerjaans();
                    $kepala->status_kawin = 'KAWIN';
                    $kepala->no_kk = $no_kk;
                    $kepala->hub_dgn_kk = 'KEPALA KELUARGA';
                    $kepala->hub_dgn_kk_urutan = 1;
                    $kepala->warga_negara = 'WNI';
                    $kepala->negara_nama = 'INDONESIA';
                    $kepala->rt_id = $rt->id;
                    $kepala->alamat = $alamat;
                    $kepala->save();

                    // ketua rw
                    if ($rt_no == 1 && $kk == 1) {
                        $ketua_rw = new KetuaRw();
                        $ketua_rw->rw_id = $rw->id;
                        $ketua_rw->penduduk_id = $kepala->id;
                        $ketua_rw->save();

                        $rw->nama_ketua = $kepala->nama;
                        $rw->save();
                    }

                    // ketua rt
                    if ($kk == 2) {
                        $ketua_rt = new KetuaRt();
                        $ketua_rt->rt_id = $rt->id;
                        $ketua_rt->penduduk_id = $kepala->id;
                        $ketua_rt->save();

                        $rt->nama_ketua = $kepala->nama;
                        $rt->save();
                    }

                    // ================================================================================================
                    // istri
                    $tanggal_lahir = $faker->dateTimeBetween('-35 years', '1990-01-01 23:59:59');

                    $istri = new Penduduk();
                    $istri->nik = str_pad($nik_counter++, 16, '0', STR_PAD_LEFT);
                    $istri->nama = $faker->name('female');
                    $istri->jenis_kelamin = 'PEREMPUAN';
                    $istri->tempat_lahir = $faker->city();
                    $istri->tanggal_lahir = date_format($tanggal_lahir, 'Y-m-d');
                    $istri->agama = $agama;
                    $istri->pendidikan = $pendidikans('istri');
                    $istri->pekerjaan = $pekerjaans('istri');
                    $istri->status_kawin = 'KAWIN';
                    $istri->no_kk = $no_kk;
                    $istri->hub_dgn_kk = 'ISTRI';
                    $istri->hub_dgn_kk_urutan = 2;
                    $istri->warga_negara = 'WNI';
                    $istri->negara_nama = 'INDONESIA';
                    $istri->rt_id = $rt->id;
                    $istri->alamat = $alamat;
                    $istri->save();

                    // ================================================================================================
                    // anak
                    $tempat_lahir = $faker->city();
                    $jml_anak = $faker->randomElement([1, 2, 3, 4]);
                    for ($anak_ = 1; $anak_ <= $jml_anak; $anak_++) {
                        $gender = $faker->randomElement(['male', 'female']);
                        $tanggal_lahir = $faker->dateTimeBetween('-25 years', '2002-01-01 23:59:59');

                        $anak = new Penduduk();
                        $anak->nik = str_pad($nik_counter++, 16, '0', STR_PAD_LEFT);
                        $anak->nama = $gender == 'male' ? $faker->firstNameMale() : $faker->firstNameFemale();
                        $anak->jenis_kelamin = $gender == 'male' ? 'LAKI-LAKI' : 'PEREMPUAN';
                        $anak->tempat_lahir = $tempat_lahir;
                        $anak->tanggal_lahir = date_format($tanggal_lahir, 'Y-m-d');
                        $anak->agama = $agama;
                        $anak->pendidikan = $pendidikans('anak');
                        $anak->pekerjaan = $pekerjaans('anak');
                        $anak->status_kawin = 'BELUM KAWIN';
                        $anak->no_kk = $no_kk;
                        $anak->hub_dgn_kk = 'ANAK';
                        $anak->hub_dgn_kk_urutan = 3;
                        $anak->warga_negara = 'WNI';
                        $anak->negara_nama = 'INDONESIA';
                        $anak->rt_id = $rt->id;
                        $anak->alamat = $alamat;
                        $anak->save();
                    }
                }
            }
        }

        // rule
        // 1rt = 12 kk
        // 1kk = 3-6 penduduk

        // kk pertama yang ada di rw jadi ketua rw 
        // kk pertama yang ada di rt jadi ketua rt 


        // kepala keluarga
        // nik mmddhhiiss hhiiss 10082000 06

        // [x] rt_id
        // [x] nik
        // [x] nama
        // [x] jenis_kelamin
        // [x] tempat_lahir
        // [x] tanggal_lahir
        // [x] agama
        // [x] pendidikan
        // [x] pekerjaan
        // [x] status_kawin
        // [x] no_kk
        // [x] hub_dgn_kk
        // [x] warga_negara
        // [x] negara_nama
        // [x] no_passport
        // [x] kitas_kitap
        // [x] foto_ktp


        // istri

        // anak

        echo 'Success';
        die;
    })->name("migrate");

    Route::post('/login', 'check_login')->name("login.check_login");
    Route::get('/logout', 'logout')->name("login.logout");
});
// ====================================================================================================================




// home default =======================================================================================================

Route::get('/', function () {
    if (!auth()->user()) return Redirect::route('login');
    if (auth_has_role(config('app.super_admin_role'))) {
        return Redirect::route('admin.dashboard');
    } else if (auth_has_role('Penduduk')) {
        return Redirect::route('penduduk.home');
    } else {
        return Redirect::route('member.dashboard');
    }
})->name("home");
// // home default =======================================================================================================
// Route::controller(HomeController::class)->group(function () {
//     Route::get('/', 'index')->name("home");
// });

// artikel ============================================================================================================
$prefix = 'artikel';
Route::controller(ArtikelController::class)->prefix($prefix)->group(function () use ($prefix) {
    Route::get('/', 'index')->name($prefix);
    Route::get('/{model:slug}', 'detail')->name("$prefix.detail");
});
// ====================================================================================================================



// Kontak =============================================================================================================
$name = 'kontak';
Route::controller(KontakController::class)->prefix($name)->group(function () use ($name) {
    Route::get('/', 'index')->name($name);
    Route::post('/send', 'insert')->name("$name.send");
    Route::get('/faq', 'faq')->name("$name.faq");
});
// ====================================================================================================================


// Galeri =============================================================================================================
$name = 'galeri';
Route::controller(GaleriControllerFrontend::class)->prefix($name)->group(function () use ($name) {
    Route::get('/', 'index')->name($name);
    Route::get('/detail/{model:slug}', 'detail')->name("$name.detail");
});
// ====================================================================================================================




// dashboard ==========================================================================================================
Route::get('/dashboard', function () {
    if (!auth()->user()) return Redirect::route('login');
    if (auth_has_role(config('app.super_admin_role'))) {
        return Redirect::route('admin.dashboard');
    } else {
        return Redirect::route('member.dashboard');
    }
})->name("dashboard");
// ====================================================================================================================

// Utility ============================================================================================================
$prefix = 'loader';
Route::controller(LoaderController::class)->prefix($prefix)->group(function () {
    Route::prefix('js')->group(function () {
        Route::get('/{file}.js', 'js')->name("load_js");
        Route::get('/{f}/{file}.js', 'js_f')->name("load_js_a");
        Route::get('/{f}/{f_a}/{file}.js', 'js_a')->name("load_js_b");
        Route::get('/{f}/{f_a}/{f_b}/{file}.js', 'js_b')->name("load_js_b");
        Route::get('/{f}/{f_a}/{f_b}/{f_c}/{file}.js', 'js_c')->name("load_js_c");
        Route::get('/{f}/{f_a}/{f_b}/{f_c}/{f_d}/{file}.js', 'js_d')->name("load_js_d");
    });
});
// ====================================================================================================================




// laboartorium =======================================================================================================
$prefix = 'lab';
Route::controller(LabController::class)->prefix($prefix)->group(function () {
    Route::get('/phpspreadsheet', 'phpspreadsheet')->name("lab.phpspreadsheet");
    Route::get('/javascript', 'javascript')->name("lab.javascript");
    Route::get('/jstes', 'jstes')->name("lab.jstes");
});
// ====================================================================================================================


// frontend ==========================================================================================================
Route::get('/frontend', [HomeController::class, 'fronted2'])->name('frontend');

// Gform
Route::get('/f/{model:slug}', [GFormController::class, 'frontend_detail'])->name("frontend.gform.detail");
