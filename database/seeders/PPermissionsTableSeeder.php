<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_permissions')->delete();
        
        \DB::table('p_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin.dashboard',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'admin.user',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin.user.excel',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'admin.user.store',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'admin.user.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'admin.user.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'admin.user.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'admin.artikel.data',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'admin.artikel.data.add',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'admin.artikel.data.edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'admin.artikel.data.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'admin.artikel.data.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'admin.artikel.data.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'admin.artikel.kategori',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'admin.artikel.kategori.select2',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'admin.artikel.kategori.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'admin.artikel.kategori.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'admin.artikel.kategori.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'admin.artikel.tag',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'admin.artikel.tag.select2',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'admin.artikel.tag.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'admin.artikel.tag.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'admin.artikel.tag.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'admin.galeri',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'admin.galeri.select2',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'admin.galeri.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'admin.galeri.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'admin.galeri.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'admin.social_media',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'admin.social_media.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'admin.social_media.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'admin.social_media.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'admin.pendaftaran.gform',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'admin.pendaftaran.gform.member',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'admin.pendaftaran.gform.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'admin.pendaftaran.gform.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'admin.pendaftaran.gform.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'admin.pendaftaran.gform.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'admin.utility.notif_depan_atas',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'admin.utility.notif_depan_atas.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'admin.utility.notif_depan_atas.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'admin.utility.notif_depan_atas.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'admin.utility.notif_depan_atas.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'admin.utility.notif_admin_atas',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'admin.utility.notif_admin_atas.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'admin.utility.notif_admin_atas.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'admin.utility.notif_admin_atas.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'admin.utility.notif_admin_atas.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'admin.utility.hari_besar_nasional',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'admin.utility.hari_besar_nasional.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'admin.utility.hari_besar_nasional.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'admin.utility.hari_besar_nasional.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'admin.utility.hari_besar_nasional.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'admin.utility.hari_besar_nasional.list_error',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'admin.user_access.permission',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'admin.user_access.permission.store',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'admin.user_access.permission.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'admin.user_access.permission.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'admin.user_access.role',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'admin.user_access.role.create',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'admin.user_access.role.edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'admin.user_access.role.store',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'admin.user_access.role.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'admin.user_access.role.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'admin.menu.admin',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'admin.menu.admin.save',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'admin.menu.admin.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'admin.menu.admin.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'admin.menu.admin.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'admin.menu.admin.list',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'admin.menu.admin.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'admin.menu.admin.parent_list',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'admin.menu.frontend',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'admin.menu.frontend.save',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'admin.menu.frontend.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'admin.menu.frontend.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'admin.menu.frontend.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'admin.menu.frontend.list',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'admin.menu.frontend.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'admin.menu.frontend.parent_list',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'admin.setting.admin',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'admin.setting.admin.save.app',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'admin.setting.admin.save.meta',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'admin.setting.admin.meta',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'admin.setting.admin.meta.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'admin.setting.admin.meta.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'admin.setting.admin.meta.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'admin.setting.front',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'admin.setting.front.save.app',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'admin.setting.front.save.meta',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'admin.setting.front.meta',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'admin.setting.front.meta.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'admin.setting.front.meta.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'admin.setting.front.meta.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'admin.setting.home',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'admin.setting.home.hero',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'admin.setting.home.poesaka',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'admin.setting.home.visi_misi',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'admin.setting.home.struktur_anggota',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'admin.setting.home.kata_alumni',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'admin.setting.home.galeri_kegiatan',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'admin.setting.home.artikel',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'admin.setting.home.sensus',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'admin.kontak.faq',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'admin.kontak.faq.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'admin.kontak.faq.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'admin.kontak.faq.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'admin.kontak.faq.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'admin.kontak.faq.setting',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'admin.kontak.list',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'admin.kontak.list.find',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'admin.kontak.list.insert',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'admin.kontak.list.update',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'admin.kontak.list.delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'admin.kontak.list.setting',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'admin.kontak.message',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'admin.kontak.message.setting',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'member.dashboard',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'password',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => '2022-12-03 00:55:50',
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'password.save',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => '2022-12-03 00:55:55',
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'penduduk',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'penduduk.home',
                'guard_name' => 'web',
                'created_at' => '2022-12-03 00:52:09',
                'updated_at' => '2022-12-03 00:52:09',
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'rt.home',
                'guard_name' => 'web',
                'created_at' => '2022-12-03 00:52:14',
                'updated_at' => '2022-12-03 00:52:14',
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'rw.home',
                'guard_name' => 'web',
                'created_at' => '2022-12-03 00:52:19',
                'updated_at' => '2022-12-03 00:52:19',
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'desa.home',
                'guard_name' => 'web',
                'created_at' => '2022-12-03 00:52:23',
                'updated_at' => '2022-12-03 00:52:23',
            ),
            125 => 
            array (
                'id' => 135,
                'name' => 'admin.penduduk',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:12',
                'updated_at' => '2022-12-04 19:27:12',
            ),
            126 => 
            array (
                'id' => 136,
                'name' => 'admin.penduduk.masuk',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:17',
                'updated_at' => '2022-12-04 19:27:17',
            ),
            127 => 
            array (
                'id' => 137,
                'name' => 'admin.penduduk.masuk.insert',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:22',
                'updated_at' => '2022-12-04 19:27:22',
            ),
            128 => 
            array (
                'id' => 138,
                'name' => 'admin.penduduk.masuk.update',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:27',
                'updated_at' => '2022-12-04 19:27:27',
            ),
            129 => 
            array (
                'id' => 139,
                'name' => 'admin.penduduk.masuk.delete',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:31',
                'updated_at' => '2022-12-04 19:27:31',
            ),
            130 => 
            array (
                'id' => 140,
                'name' => 'admin.penduduk.keluar.delete',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:36',
                'updated_at' => '2022-12-04 19:27:36',
            ),
            131 => 
            array (
                'id' => 141,
                'name' => 'admin.penduduk.keluar.insert',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:41',
                'updated_at' => '2022-12-04 19:27:41',
            ),
            132 => 
            array (
                'id' => 142,
                'name' => 'admin.penduduk.keluar.update',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:46',
                'updated_at' => '2022-12-04 19:27:46',
            ),
            133 => 
            array (
                'id' => 143,
                'name' => 'admin.penduduk.keluar',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 19:27:51',
                'updated_at' => '2022-12-04 19:27:51',
            ),
            134 => 
            array (
                'id' => 144,
                'name' => 'admin.kepegawaian.jabatan',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 20:15:18',
                'updated_at' => '2022-12-04 20:15:18',
            ),
            135 => 
            array (
                'id' => 145,
                'name' => 'admin.kepegawaian.jabatan.insert',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 20:15:23',
                'updated_at' => '2022-12-04 20:15:23',
            ),
            136 => 
            array (
                'id' => 146,
                'name' => 'admin.kepegawaian.jabatan.update',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 20:15:30',
                'updated_at' => '2022-12-04 20:15:30',
            ),
            137 => 
            array (
                'id' => 147,
                'name' => 'admin.kepegawaian.jabatan.delete',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 20:15:34',
                'updated_at' => '2022-12-04 20:15:34',
            ),
            138 => 
            array (
                'id' => 148,
                'name' => 'admin.kepegawaian.pegawai',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 22:06:52',
                'updated_at' => '2022-12-04 22:06:52',
            ),
            139 => 
            array (
                'id' => 149,
                'name' => 'admin.kepegawaian.pegawai.insert',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 22:06:57',
                'updated_at' => '2022-12-04 22:06:57',
            ),
            140 => 
            array (
                'id' => 150,
                'name' => 'admin.kepegawaian.pegawai.update',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 22:07:03',
                'updated_at' => '2022-12-04 22:07:03',
            ),
            141 => 
            array (
                'id' => 151,
                'name' => 'admin.kepegawaian.pegawai.delete',
                'guard_name' => 'web',
                'created_at' => '2022-12-04 22:07:10',
                'updated_at' => '2022-12-04 22:07:10',
            ),
            142 => 
            array (
                'id' => 152,
                'name' => 'admin.rt',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:57:26',
                'updated_at' => '2022-12-05 00:57:26',
            ),
            143 => 
            array (
                'id' => 153,
                'name' => 'admin.rt.insert',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:57:31',
                'updated_at' => '2022-12-05 00:57:31',
            ),
            144 => 
            array (
                'id' => 154,
                'name' => 'admin.rt.update',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:57:35',
                'updated_at' => '2022-12-05 00:57:35',
            ),
            145 => 
            array (
                'id' => 155,
                'name' => 'admin.rt.delete',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:57:41',
                'updated_at' => '2022-12-05 00:57:41',
            ),
            146 => 
            array (
                'id' => 156,
                'name' => 'admin.rw',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:57:55',
                'updated_at' => '2022-12-05 00:57:55',
            ),
            147 => 
            array (
                'id' => 157,
                'name' => 'admin.rw.insert',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:58:00',
                'updated_at' => '2022-12-05 00:58:00',
            ),
            148 => 
            array (
                'id' => 158,
                'name' => 'admin.rw.update',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:58:04',
                'updated_at' => '2022-12-05 00:58:04',
            ),
            149 => 
            array (
                'id' => 159,
                'name' => 'admin.rw.delete',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 00:58:09',
                'updated_at' => '2022-12-05 00:58:09',
            ),
            150 => 
            array (
                'id' => 160,
                'name' => 'admin.setting.penerima_surat',
                'guard_name' => 'web',
                'created_at' => '2022-12-05 08:01:41',
                'updated_at' => '2022-12-05 08:01:41',
            ),
            151 => 
            array (
                'id' => 161,
                'name' => 'penduduk.surat.keterangan',
                'guard_name' => 'web',
                'created_at' => '2022-12-13 14:23:02',
                'updated_at' => '2022-12-13 14:23:02',
            ),
            152 => 
            array (
                'id' => 162,
                'name' => 'penduduk.pelacakan',
                'guard_name' => 'web',
                'created_at' => '2022-12-13 14:23:12',
                'updated_at' => '2022-12-13 14:23:12',
            ),
            153 => 
            array (
                'id' => 163,
                'name' => 'rt.surat.proses',
                'guard_name' => 'web',
                'created_at' => '2022-12-14 21:38:31',
                'updated_at' => '2022-12-14 21:38:31',
            ),
            154 => 
            array (
                'id' => 164,
                'name' => 'rw.surat.proses',
                'guard_name' => 'web',
                'created_at' => '2022-12-14 21:38:38',
                'updated_at' => '2022-12-14 21:38:38',
            ),
            155 => 
            array (
                'id' => 165,
                'name' => 'desa.surat.proses',
                'guard_name' => 'web',
                'created_at' => '2022-12-14 22:21:47',
                'updated_at' => '2022-12-14 22:21:47',
            ),
            156 => 
            array (
                'id' => 166,
                'name' => 'penduduk.surat.domisili',
                'guard_name' => 'web',
                'created_at' => '2023-01-01 20:28:32',
                'updated_at' => '2023-01-01 20:28:32',
            ),
            157 => 
            array (
                'id' => 167,
                'name' => 'penduduk.surat.nikah',
                'guard_name' => 'web',
                'created_at' => '2023-01-01 20:28:40',
                'updated_at' => '2023-01-01 20:28:40',
            ),
            158 => 
            array (
                'id' => 168,
                'name' => 'penduduk.surat.kelahiran',
                'guard_name' => 'web',
                'created_at' => '2023-01-01 20:28:46',
                'updated_at' => '2023-01-01 20:28:46',
            ),
            159 => 
            array (
                'id' => 169,
                'name' => 'penduduk.surat.pindah',
                'guard_name' => 'web',
                'created_at' => '2023-01-01 20:28:52',
                'updated_at' => '2023-01-01 20:28:52',
            ),
            160 => 
            array (
                'id' => 170,
                'name' => 'penduduk.surat.kk',
                'guard_name' => 'web',
                'created_at' => '2023-01-01 20:28:57',
                'updated_at' => '2023-01-01 20:28:57',
            ),
        ));
        
        
    }
}