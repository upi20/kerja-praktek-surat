<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_menu')->delete();
        
        \DB::table('p_menu')->insert(array (
            0 => 
            array (
                'id' => 345,
                'parent_id' => NULL,
                'title' => 'Halaman Utama',
                'icon' => 'fas fa-home',
                'route' => 'admin.dashboard',
                'sequence' => 2,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-03 00:24:20',
            ),
            1 => 
            array (
                'id' => 346,
                'parent_id' => NULL,
                'title' => 'Pengguna',
                'icon' => 'fas fa-users',
                'route' => 'admin.user',
                'sequence' => 29,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:05:05',
            ),
            2 => 
            array (
                'id' => 351,
                'parent_id' => NULL,
                'title' => 'Article',
                'icon' => 'fas fa-file-alt',
                'route' => NULL,
                'sequence' => 40,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            3 => 
            array (
                'id' => 352,
                'parent_id' => 351,
                'title' => 'Data',
                'icon' => NULL,
                'route' => 'admin.artikel.data',
                'sequence' => 41,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            4 => 
            array (
                'id' => 353,
                'parent_id' => 351,
                'title' => 'Category',
                'icon' => NULL,
                'route' => 'admin.artikel.kategori',
                'sequence' => 42,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            5 => 
            array (
                'id' => 354,
                'parent_id' => 351,
                'title' => 'Tag',
                'icon' => NULL,
                'route' => 'admin.artikel.tag',
                'sequence' => 43,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            6 => 
            array (
                'id' => 360,
                'parent_id' => NULL,
                'title' => 'Galeri',
                'icon' => 'fas fa-images',
                'route' => 'admin.galeri',
                'sequence' => 44,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            7 => 
            array (
                'id' => 361,
                'parent_id' => NULL,
                'title' => 'Menu Management',
                'icon' => 'fas fa-stream',
                'route' => 'admin.menu.admin',
                'sequence' => 33,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:05:05',
            ),
            8 => 
            array (
                'id' => 363,
                'parent_id' => NULL,
                'title' => 'Sosial Media',
                'icon' => 'fas fa-share-alt',
                'route' => 'admin.social_media',
                'sequence' => 46,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            9 => 
            array (
                'id' => 364,
                'parent_id' => NULL,
                'title' => 'Contact',
                'icon' => 'fas fa-phone',
                'route' => NULL,
                'sequence' => 47,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            10 => 
            array (
                'id' => 367,
                'parent_id' => NULL,
                'title' => 'Akses Pengguna',
                'icon' => 'fas fa-user-check',
                'route' => NULL,
                'sequence' => 30,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:05:05',
            ),
            11 => 
            array (
                'id' => 368,
                'parent_id' => 367,
                'title' => 'Perizinan Fitur',
                'icon' => NULL,
                'route' => 'admin.user_access.permission',
                'sequence' => 31,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:05:05',
            ),
            12 => 
            array (
                'id' => 369,
                'parent_id' => 367,
                'title' => 'Izin Fitur Jabatan',
                'icon' => NULL,
                'route' => 'admin.user_access.role',
                'sequence' => 32,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 19:29:05',
            ),
            13 => 
            array (
                'id' => 373,
                'parent_id' => NULL,
                'title' => 'Ganti Password',
                'icon' => 'fas fa-key',
                'route' => 'password',
                'sequence' => 34,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:50:28',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            14 => 
            array (
                'id' => 386,
                'parent_id' => NULL,
                'title' => 'Logout',
                'icon' => 'fas fa-sign-out-alt',
                'route' => 'logout',
                'sequence' => 35,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-05 23:54:09',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            15 => 
            array (
                'id' => 390,
                'parent_id' => NULL,
                'title' => 'Halaman Utama',
                'icon' => 'fas fa-home',
                'route' => 'penduduk.home',
                'sequence' => 10,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-06 15:16:19',
                'updated_at' => '2022-12-03 00:58:31',
            ),
            16 => 
            array (
                'id' => 392,
                'parent_id' => NULL,
                'title' => 'Google Forms',
                'icon' => 'fas fa-user-edit',
                'route' => 'admin.pendaftaran.gform',
                'sequence' => 45,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-08 16:14:54',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            17 => 
            array (
                'id' => 393,
                'parent_id' => NULL,
                'title' => 'Utility',
                'icon' => 'fas fa-tools',
                'route' => NULL,
                'sequence' => 37,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-08 22:41:26',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            18 => 
            array (
                'id' => 394,
                'parent_id' => 393,
                'title' => 'Frontend Notification',
                'icon' => NULL,
                'route' => 'admin.utility.notif_depan_atas',
                'sequence' => 38,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-08 22:41:53',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            19 => 
            array (
                'id' => 397,
                'parent_id' => NULL,
                'title' => 'Pengaturan',
                'icon' => 'fas fa-wrench',
                'route' => NULL,
                'sequence' => 22,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-14 21:10:57',
                'updated_at' => '2022-12-04 14:53:21',
            ),
            20 => 
            array (
                'id' => 398,
                'parent_id' => 397,
                'title' => 'Aplikasi',
                'icon' => NULL,
                'route' => 'admin.setting.admin',
                'sequence' => 23,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-14 21:11:42',
                'updated_at' => '2022-12-04 14:53:03',
            ),
            21 => 
            array (
                'id' => 401,
                'parent_id' => 393,
                'title' => 'Hari Besar Nasional',
                'icon' => NULL,
                'route' => 'admin.utility.hari_besar_nasional',
                'sequence' => 39,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-17 21:19:05',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            22 => 
            array (
                'id' => 402,
                'parent_id' => 397,
                'title' => 'Notifikasi',
                'icon' => NULL,
                'route' => 'admin.utility.notif_admin_atas',
                'sequence' => 26,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-18 16:42:00',
                'updated_at' => '2022-12-04 15:03:43',
            ),
            23 => 
            array (
                'id' => 404,
                'parent_id' => 403,
                'title' => 'Anggota',
                'icon' => NULL,
                'route' => 'admin.lapooran.anggota',
                'sequence' => 41,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-18 18:55:08',
                'updated_at' => '2022-08-20 14:04:25',
            ),
            24 => 
            array (
                'id' => 407,
                'parent_id' => 364,
                'title' => 'Message',
                'icon' => NULL,
                'route' => 'admin.kontak.message',
                'sequence' => 48,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-21 08:38:20',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            25 => 
            array (
                'id' => 408,
                'parent_id' => 364,
                'title' => 'FAQ',
                'icon' => NULL,
                'route' => 'admin.kontak.faq',
                'sequence' => 49,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-21 08:39:18',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            26 => 
            array (
                'id' => 409,
                'parent_id' => 364,
                'title' => 'List',
                'icon' => NULL,
                'route' => 'admin.kontak.list',
                'sequence' => 50,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-21 08:40:08',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            27 => 
            array (
                'id' => 411,
                'parent_id' => NULL,
                'title' => 'Media Dan Informasi',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 36,
                'active' => 0,
                'type' => 0,
                'created_at' => '2022-09-09 13:45:06',
                'updated_at' => '2022-12-04 15:03:28',
            ),
            28 => 
            array (
                'id' => 412,
                'parent_id' => NULL,
                'title' => 'Peralatan',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 28,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-09-09 13:45:50',
                'updated_at' => '2022-12-04 15:04:42',
            ),
            29 => 
            array (
                'id' => 413,
                'parent_id' => NULL,
                'title' => 'Penduduk Masuk',
                'icon' => 'fas fa-sign-in-alt',
                'route' => 'admin.penduduk.masuk',
                'sequence' => 13,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:18:41',
                'updated_at' => '2022-12-04 19:23:51',
            ),
            30 => 
            array (
                'id' => 414,
                'parent_id' => NULL,
                'title' => 'Penduduk',
                'icon' => 'fas fa-users',
                'route' => 'admin.penduduk',
                'sequence' => 12,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:19:21',
                'updated_at' => '2022-12-04 19:23:43',
            ),
            31 => 
            array (
                'id' => 415,
                'parent_id' => NULL,
                'title' => 'Penduduk Keluar',
                'icon' => 'fas fa-sign-out-alt',
                'route' => 'admin.penduduk.keluar',
                'sequence' => 14,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:19:41',
                'updated_at' => '2022-12-04 19:24:04',
            ),
            32 => 
            array (
                'id' => 416,
                'parent_id' => NULL,
                'title' => 'Menu Administrator',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 1,
                'active' => 0,
                'type' => 0,
                'created_at' => '2022-12-03 00:21:37',
                'updated_at' => '2022-12-04 14:43:22',
            ),
            33 => 
            array (
                'id' => 417,
                'parent_id' => NULL,
                'title' => 'Menu Penduduk',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 9,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-12-03 00:21:48',
                'updated_at' => '2022-12-03 00:58:31',
            ),
            34 => 
            array (
                'id' => 418,
                'parent_id' => NULL,
                'title' => 'Menu Rukun Tetangga',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 7,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-12-03 00:21:57',
                'updated_at' => '2022-12-03 00:58:31',
            ),
            35 => 
            array (
                'id' => 419,
                'parent_id' => NULL,
                'title' => 'Menu Rukun Warga',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 5,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-12-03 00:22:13',
                'updated_at' => '2022-12-03 00:58:31',
            ),
            36 => 
            array (
                'id' => 420,
                'parent_id' => NULL,
                'title' => 'Data Kependudukan',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 11,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-12-03 00:22:26',
                'updated_at' => '2022-12-03 00:43:35',
            ),
            37 => 
            array (
                'id' => 421,
                'parent_id' => NULL,
                'title' => 'Laporan',
                'icon' => 'fas fa-file-alt',
                'route' => NULL,
                'sequence' => 27,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:22:36',
                'updated_at' => '2022-12-04 22:11:21',
            ),
            38 => 
            array (
                'id' => 422,
                'parent_id' => NULL,
                'title' => 'Menu Administrasi',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 15,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-12-03 00:22:45',
                'updated_at' => '2022-12-04 14:46:29',
            ),
            39 => 
            array (
                'id' => 423,
                'parent_id' => NULL,
                'title' => 'Menu Pihak Desa',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 3,
                'active' => 1,
                'type' => 0,
                'created_at' => '2022-12-03 00:27:20',
                'updated_at' => '2022-12-04 14:43:53',
            ),
            40 => 
            array (
                'id' => 425,
                'parent_id' => NULL,
                'title' => 'Halaman Utama',
                'icon' => 'fas fa-home',
                'route' => 'rt.home',
                'sequence' => 8,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:42:38',
                'updated_at' => '2022-12-03 00:58:31',
            ),
            41 => 
            array (
                'id' => 426,
                'parent_id' => NULL,
                'title' => 'Halaman Utama',
                'icon' => 'fas fa-home',
                'route' => 'rw.home',
                'sequence' => 6,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:42:51',
                'updated_at' => '2022-12-03 00:58:31',
            ),
            42 => 
            array (
                'id' => 427,
                'parent_id' => NULL,
                'title' => 'Halaman Utama',
                'icon' => 'fas fa-home',
                'route' => 'desa.home',
                'sequence' => 4,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-03 00:43:00',
                'updated_at' => '2022-12-03 00:58:30',
            ),
            43 => 
            array (
                'id' => 428,
                'parent_id' => NULL,
                'title' => 'Kepegawaian',
                'icon' => 'fas fa-id-card-alt',
                'route' => NULL,
                'sequence' => 16,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:48:01',
                'updated_at' => '2022-12-04 22:10:49',
            ),
            44 => 
            array (
                'id' => 429,
                'parent_id' => 428,
                'title' => 'Jabatan',
                'icon' => NULL,
                'route' => 'admin.kepegawaian.jabatan',
                'sequence' => 17,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:48:36',
                'updated_at' => '2022-12-04 20:15:54',
            ),
            45 => 
            array (
                'id' => 430,
                'parent_id' => 428,
                'title' => 'Pegawai',
                'icon' => NULL,
                'route' => 'admin.kepegawaian.pegawai',
                'sequence' => 18,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:48:47',
                'updated_at' => '2022-12-04 22:06:25',
            ),
            46 => 
            array (
                'id' => 431,
                'parent_id' => NULL,
                'title' => 'RT/RW',
                'icon' => 'fas fa-user-edit',
                'route' => NULL,
                'sequence' => 19,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:51:02',
                'updated_at' => '2022-12-04 14:51:46',
            ),
            47 => 
            array (
                'id' => 432,
                'parent_id' => 431,
                'title' => 'Rukun Warga',
                'icon' => NULL,
                'route' => 'admin.rw',
                'sequence' => 20,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:51:22',
                'updated_at' => '2022-12-05 00:56:13',
            ),
            48 => 
            array (
                'id' => 433,
                'parent_id' => 431,
                'title' => 'Rukun Tetangga',
                'icon' => NULL,
                'route' => 'admin.rt',
                'sequence' => 21,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:51:36',
                'updated_at' => '2022-12-05 00:56:23',
            ),
            49 => 
            array (
                'id' => 434,
                'parent_id' => 397,
                'title' => 'Pegawai Penerima Surat',
                'icon' => NULL,
                'route' => 'admin.setting.penerima_surat',
                'sequence' => 25,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 14:54:11',
                'updated_at' => '2022-12-05 07:06:14',
            ),
            50 => 
            array (
                'id' => 436,
                'parent_id' => 421,
                'title' => 'Surat Menyurat',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 50,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 15:06:26',
                'updated_at' => '2022-12-04 15:06:26',
            ),
            51 => 
            array (
                'id' => 437,
                'parent_id' => 421,
                'title' => 'Penduduk',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 51,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 15:06:52',
                'updated_at' => '2022-12-04 15:06:52',
            ),
            52 => 
            array (
                'id' => 438,
                'parent_id' => 421,
                'title' => 'Penduduk Masuk',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 52,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 15:07:07',
                'updated_at' => '2022-12-04 15:07:07',
            ),
            53 => 
            array (
                'id' => 439,
                'parent_id' => 421,
                'title' => 'Penduduk Keluar',
                'icon' => NULL,
                'route' => NULL,
                'sequence' => 53,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-12-04 15:07:25',
                'updated_at' => '2022-12-04 15:07:25',
            ),
        ));
        
        
    }
}