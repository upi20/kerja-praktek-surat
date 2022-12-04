<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PRoleHasMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_role_has_menu')->delete();
        
        \DB::table('p_role_has_menu')->insert(array (
            0 => 
            array (
                'id' => 11,
                'role_id' => 1,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            1 => 
            array (
                'id' => 13,
                'role_id' => 3,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            2 => 
            array (
                'id' => 14,
                'role_id' => 4,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            3 => 
            array (
                'id' => 15,
                'role_id' => 5,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            4 => 
            array (
                'id' => 16,
                'role_id' => 6,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            5 => 
            array (
                'id' => 20,
                'role_id' => 1,
                'menu_id' => 412,
                'created_at' => '2022-09-09 13:45:50',
                'updated_at' => '2022-09-09 13:45:50',
            ),
            6 => 
            array (
                'id' => 31,
                'role_id' => 3,
                'menu_id' => 390,
                'created_at' => '2022-09-09 13:52:48',
                'updated_at' => '2022-09-09 13:52:48',
            ),
            7 => 
            array (
                'id' => 43,
                'role_id' => 1,
                'menu_id' => 345,
                'created_at' => '2022-12-03 00:24:13',
                'updated_at' => '2022-12-03 00:24:13',
            ),
            8 => 
            array (
                'id' => 47,
                'role_id' => 5,
                'menu_id' => 426,
                'created_at' => '2022-12-03 00:42:51',
                'updated_at' => '2022-12-03 00:42:51',
            ),
            9 => 
            array (
                'id' => 49,
                'role_id' => 4,
                'menu_id' => 427,
                'created_at' => '2022-12-03 00:44:56',
                'updated_at' => '2022-12-03 00:44:56',
            ),
            10 => 
            array (
                'id' => 50,
                'role_id' => 3,
                'menu_id' => 417,
                'created_at' => '2022-12-03 00:45:10',
                'updated_at' => '2022-12-03 00:45:10',
            ),
            11 => 
            array (
                'id' => 51,
                'role_id' => 6,
                'menu_id' => 418,
                'created_at' => '2022-12-03 00:45:54',
                'updated_at' => '2022-12-03 00:45:54',
            ),
            12 => 
            array (
                'id' => 52,
                'role_id' => 5,
                'menu_id' => 419,
                'created_at' => '2022-12-03 00:46:13',
                'updated_at' => '2022-12-03 00:46:13',
            ),
            13 => 
            array (
                'id' => 54,
                'role_id' => 1,
                'menu_id' => 420,
                'created_at' => '2022-12-03 00:46:49',
                'updated_at' => '2022-12-03 00:46:49',
            ),
            14 => 
            array (
                'id' => 55,
                'role_id' => 4,
                'menu_id' => 420,
                'created_at' => '2022-12-03 00:46:49',
                'updated_at' => '2022-12-03 00:46:49',
            ),
            15 => 
            array (
                'id' => 64,
                'role_id' => 3,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            16 => 
            array (
                'id' => 65,
                'role_id' => 4,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            17 => 
            array (
                'id' => 66,
                'role_id' => 5,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            18 => 
            array (
                'id' => 67,
                'role_id' => 6,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            19 => 
            array (
                'id' => 68,
                'role_id' => 6,
                'menu_id' => 425,
                'created_at' => '2022-12-03 00:59:27',
                'updated_at' => '2022-12-03 00:59:27',
            ),
            20 => 
            array (
                'id' => 73,
                'role_id' => 1,
                'menu_id' => 346,
                'created_at' => '2022-12-03 23:57:45',
                'updated_at' => '2022-12-03 23:57:45',
            ),
            21 => 
            array (
                'id' => 76,
                'role_id' => 1,
                'menu_id' => 361,
                'created_at' => '2022-12-04 02:58:32',
                'updated_at' => '2022-12-04 02:58:32',
            ),
            22 => 
            array (
                'id' => 77,
                'role_id' => 1,
                'menu_id' => 416,
                'created_at' => '2022-12-04 14:43:22',
                'updated_at' => '2022-12-04 14:43:22',
            ),
            23 => 
            array (
                'id' => 79,
                'role_id' => 4,
                'menu_id' => 423,
                'created_at' => '2022-12-04 14:43:53',
                'updated_at' => '2022-12-04 14:43:53',
            ),
            24 => 
            array (
                'id' => 81,
                'role_id' => 1,
                'menu_id' => 428,
                'created_at' => '2022-12-04 14:48:01',
                'updated_at' => '2022-12-04 14:48:01',
            ),
            25 => 
            array (
                'id' => 83,
                'role_id' => 1,
                'menu_id' => 430,
                'created_at' => '2022-12-04 14:48:47',
                'updated_at' => '2022-12-04 14:48:47',
            ),
            26 => 
            array (
                'id' => 84,
                'role_id' => 1,
                'menu_id' => 429,
                'created_at' => '2022-12-04 14:48:57',
                'updated_at' => '2022-12-04 14:48:57',
            ),
            27 => 
            array (
                'id' => 87,
                'role_id' => 1,
                'menu_id' => 431,
                'created_at' => '2022-12-04 14:51:02',
                'updated_at' => '2022-12-04 14:51:02',
            ),
            28 => 
            array (
                'id' => 88,
                'role_id' => 1,
                'menu_id' => 432,
                'created_at' => '2022-12-04 14:51:22',
                'updated_at' => '2022-12-04 14:51:22',
            ),
            29 => 
            array (
                'id' => 89,
                'role_id' => 1,
                'menu_id' => 433,
                'created_at' => '2022-12-04 14:51:36',
                'updated_at' => '2022-12-04 14:51:36',
            ),
            30 => 
            array (
                'id' => 90,
                'role_id' => 1,
                'menu_id' => 398,
                'created_at' => '2022-12-04 14:53:03',
                'updated_at' => '2022-12-04 14:53:03',
            ),
            31 => 
            array (
                'id' => 91,
                'role_id' => 1,
                'menu_id' => 397,
                'created_at' => '2022-12-04 14:53:21',
                'updated_at' => '2022-12-04 14:53:21',
            ),
            32 => 
            array (
                'id' => 92,
                'role_id' => 1,
                'menu_id' => 434,
                'created_at' => '2022-12-04 14:54:11',
                'updated_at' => '2022-12-04 14:54:11',
            ),
            33 => 
            array (
                'id' => 93,
                'role_id' => 1,
                'menu_id' => 435,
                'created_at' => '2022-12-04 14:54:45',
                'updated_at' => '2022-12-04 14:54:45',
            ),
            34 => 
            array (
                'id' => 94,
                'role_id' => 1,
                'menu_id' => 367,
                'created_at' => '2022-12-04 14:56:46',
                'updated_at' => '2022-12-04 14:56:46',
            ),
            35 => 
            array (
                'id' => 95,
                'role_id' => 1,
                'menu_id' => 368,
                'created_at' => '2022-12-04 14:59:59',
                'updated_at' => '2022-12-04 14:59:59',
            ),
            36 => 
            array (
                'id' => 97,
                'role_id' => 1,
                'menu_id' => 411,
                'created_at' => '2022-12-04 15:01:13',
                'updated_at' => '2022-12-04 15:01:13',
            ),
            37 => 
            array (
                'id' => 98,
                'role_id' => 1,
                'menu_id' => 402,
                'created_at' => '2022-12-04 15:03:43',
                'updated_at' => '2022-12-04 15:03:43',
            ),
            38 => 
            array (
                'id' => 99,
                'role_id' => 1,
                'menu_id' => 421,
                'created_at' => '2022-12-04 15:06:04',
                'updated_at' => '2022-12-04 15:06:04',
            ),
            39 => 
            array (
                'id' => 100,
                'role_id' => 4,
                'menu_id' => 421,
                'created_at' => '2022-12-04 15:06:04',
                'updated_at' => '2022-12-04 15:06:04',
            ),
            40 => 
            array (
                'id' => 101,
                'role_id' => 1,
                'menu_id' => 436,
                'created_at' => '2022-12-04 15:06:26',
                'updated_at' => '2022-12-04 15:06:26',
            ),
            41 => 
            array (
                'id' => 102,
                'role_id' => 4,
                'menu_id' => 436,
                'created_at' => '2022-12-04 15:06:26',
                'updated_at' => '2022-12-04 15:06:26',
            ),
            42 => 
            array (
                'id' => 103,
                'role_id' => 1,
                'menu_id' => 437,
                'created_at' => '2022-12-04 15:06:52',
                'updated_at' => '2022-12-04 15:06:52',
            ),
            43 => 
            array (
                'id' => 104,
                'role_id' => 4,
                'menu_id' => 437,
                'created_at' => '2022-12-04 15:06:52',
                'updated_at' => '2022-12-04 15:06:52',
            ),
            44 => 
            array (
                'id' => 105,
                'role_id' => 1,
                'menu_id' => 438,
                'created_at' => '2022-12-04 15:07:07',
                'updated_at' => '2022-12-04 15:07:07',
            ),
            45 => 
            array (
                'id' => 106,
                'role_id' => 4,
                'menu_id' => 438,
                'created_at' => '2022-12-04 15:07:07',
                'updated_at' => '2022-12-04 15:07:07',
            ),
            46 => 
            array (
                'id' => 107,
                'role_id' => 1,
                'menu_id' => 439,
                'created_at' => '2022-12-04 15:07:25',
                'updated_at' => '2022-12-04 15:07:25',
            ),
            47 => 
            array (
                'id' => 108,
                'role_id' => 4,
                'menu_id' => 439,
                'created_at' => '2022-12-04 15:07:25',
                'updated_at' => '2022-12-04 15:07:25',
            ),
            48 => 
            array (
                'id' => 109,
                'role_id' => 1,
                'menu_id' => 414,
                'created_at' => '2022-12-04 19:23:43',
                'updated_at' => '2022-12-04 19:23:43',
            ),
            49 => 
            array (
                'id' => 110,
                'role_id' => 4,
                'menu_id' => 414,
                'created_at' => '2022-12-04 19:23:43',
                'updated_at' => '2022-12-04 19:23:43',
            ),
            50 => 
            array (
                'id' => 111,
                'role_id' => 1,
                'menu_id' => 413,
                'created_at' => '2022-12-04 19:23:51',
                'updated_at' => '2022-12-04 19:23:51',
            ),
            51 => 
            array (
                'id' => 112,
                'role_id' => 4,
                'menu_id' => 413,
                'created_at' => '2022-12-04 19:23:51',
                'updated_at' => '2022-12-04 19:23:51',
            ),
            52 => 
            array (
                'id' => 113,
                'role_id' => 1,
                'menu_id' => 415,
                'created_at' => '2022-12-04 19:24:04',
                'updated_at' => '2022-12-04 19:24:04',
            ),
            53 => 
            array (
                'id' => 114,
                'role_id' => 4,
                'menu_id' => 415,
                'created_at' => '2022-12-04 19:24:04',
                'updated_at' => '2022-12-04 19:24:04',
            ),
            54 => 
            array (
                'id' => 115,
                'role_id' => 1,
                'menu_id' => 369,
                'created_at' => '2022-12-04 19:29:05',
                'updated_at' => '2022-12-04 19:29:05',
            ),
            55 => 
            array (
                'id' => 116,
                'role_id' => 1,
                'menu_id' => 422,
                'created_at' => '2022-12-04 19:33:42',
                'updated_at' => '2022-12-04 19:33:42',
            ),
            56 => 
            array (
                'id' => 117,
                'role_id' => 4,
                'menu_id' => 422,
                'created_at' => '2022-12-04 19:33:42',
                'updated_at' => '2022-12-04 19:33:42',
            ),
        ));
        
        
    }
}