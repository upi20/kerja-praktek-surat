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
                'id' => 68,
                'role_id' => 6,
                'menu_id' => 425,
                'created_at' => '2022-12-03 00:59:27',
                'updated_at' => '2022-12-03 00:59:27',
            ),
            16 => 
            array (
                'id' => 73,
                'role_id' => 1,
                'menu_id' => 346,
                'created_at' => '2022-12-03 23:57:45',
                'updated_at' => '2022-12-03 23:57:45',
            ),
            17 => 
            array (
                'id' => 76,
                'role_id' => 1,
                'menu_id' => 361,
                'created_at' => '2022-12-04 02:58:32',
                'updated_at' => '2022-12-04 02:58:32',
            ),
            18 => 
            array (
                'id' => 79,
                'role_id' => 4,
                'menu_id' => 423,
                'created_at' => '2022-12-04 14:43:53',
                'updated_at' => '2022-12-04 14:43:53',
            ),
            19 => 
            array (
                'id' => 90,
                'role_id' => 1,
                'menu_id' => 398,
                'created_at' => '2022-12-04 14:53:03',
                'updated_at' => '2022-12-04 14:53:03',
            ),
            20 => 
            array (
                'id' => 91,
                'role_id' => 1,
                'menu_id' => 397,
                'created_at' => '2022-12-04 14:53:21',
                'updated_at' => '2022-12-04 14:53:21',
            ),
            21 => 
            array (
                'id' => 94,
                'role_id' => 1,
                'menu_id' => 367,
                'created_at' => '2022-12-04 14:56:46',
                'updated_at' => '2022-12-04 14:56:46',
            ),
            22 => 
            array (
                'id' => 95,
                'role_id' => 1,
                'menu_id' => 368,
                'created_at' => '2022-12-04 14:59:59',
                'updated_at' => '2022-12-04 14:59:59',
            ),
            23 => 
            array (
                'id' => 97,
                'role_id' => 1,
                'menu_id' => 411,
                'created_at' => '2022-12-04 15:01:13',
                'updated_at' => '2022-12-04 15:01:13',
            ),
            24 => 
            array (
                'id' => 98,
                'role_id' => 1,
                'menu_id' => 402,
                'created_at' => '2022-12-04 15:03:43',
                'updated_at' => '2022-12-04 15:03:43',
            ),
            25 => 
            array (
                'id' => 101,
                'role_id' => 1,
                'menu_id' => 436,
                'created_at' => '2022-12-04 15:06:26',
                'updated_at' => '2022-12-04 15:06:26',
            ),
            26 => 
            array (
                'id' => 102,
                'role_id' => 4,
                'menu_id' => 436,
                'created_at' => '2022-12-04 15:06:26',
                'updated_at' => '2022-12-04 15:06:26',
            ),
            27 => 
            array (
                'id' => 103,
                'role_id' => 1,
                'menu_id' => 437,
                'created_at' => '2022-12-04 15:06:52',
                'updated_at' => '2022-12-04 15:06:52',
            ),
            28 => 
            array (
                'id' => 104,
                'role_id' => 4,
                'menu_id' => 437,
                'created_at' => '2022-12-04 15:06:52',
                'updated_at' => '2022-12-04 15:06:52',
            ),
            29 => 
            array (
                'id' => 105,
                'role_id' => 1,
                'menu_id' => 438,
                'created_at' => '2022-12-04 15:07:07',
                'updated_at' => '2022-12-04 15:07:07',
            ),
            30 => 
            array (
                'id' => 106,
                'role_id' => 4,
                'menu_id' => 438,
                'created_at' => '2022-12-04 15:07:07',
                'updated_at' => '2022-12-04 15:07:07',
            ),
            31 => 
            array (
                'id' => 107,
                'role_id' => 1,
                'menu_id' => 439,
                'created_at' => '2022-12-04 15:07:25',
                'updated_at' => '2022-12-04 15:07:25',
            ),
            32 => 
            array (
                'id' => 108,
                'role_id' => 4,
                'menu_id' => 439,
                'created_at' => '2022-12-04 15:07:25',
                'updated_at' => '2022-12-04 15:07:25',
            ),
            33 => 
            array (
                'id' => 109,
                'role_id' => 1,
                'menu_id' => 414,
                'created_at' => '2022-12-04 19:23:43',
                'updated_at' => '2022-12-04 19:23:43',
            ),
            34 => 
            array (
                'id' => 110,
                'role_id' => 4,
                'menu_id' => 414,
                'created_at' => '2022-12-04 19:23:43',
                'updated_at' => '2022-12-04 19:23:43',
            ),
            35 => 
            array (
                'id' => 111,
                'role_id' => 1,
                'menu_id' => 413,
                'created_at' => '2022-12-04 19:23:51',
                'updated_at' => '2022-12-04 19:23:51',
            ),
            36 => 
            array (
                'id' => 112,
                'role_id' => 4,
                'menu_id' => 413,
                'created_at' => '2022-12-04 19:23:51',
                'updated_at' => '2022-12-04 19:23:51',
            ),
            37 => 
            array (
                'id' => 113,
                'role_id' => 1,
                'menu_id' => 415,
                'created_at' => '2022-12-04 19:24:04',
                'updated_at' => '2022-12-04 19:24:04',
            ),
            38 => 
            array (
                'id' => 114,
                'role_id' => 4,
                'menu_id' => 415,
                'created_at' => '2022-12-04 19:24:04',
                'updated_at' => '2022-12-04 19:24:04',
            ),
            39 => 
            array (
                'id' => 115,
                'role_id' => 1,
                'menu_id' => 369,
                'created_at' => '2022-12-04 19:29:05',
                'updated_at' => '2022-12-04 19:29:05',
            ),
            40 => 
            array (
                'id' => 116,
                'role_id' => 1,
                'menu_id' => 422,
                'created_at' => '2022-12-04 19:33:42',
                'updated_at' => '2022-12-04 19:33:42',
            ),
            41 => 
            array (
                'id' => 117,
                'role_id' => 4,
                'menu_id' => 422,
                'created_at' => '2022-12-04 19:33:42',
                'updated_at' => '2022-12-04 19:33:42',
            ),
            42 => 
            array (
                'id' => 122,
                'role_id' => 1,
                'menu_id' => 429,
                'created_at' => '2022-12-04 22:08:58',
                'updated_at' => '2022-12-04 22:08:58',
            ),
            43 => 
            array (
                'id' => 123,
                'role_id' => 4,
                'menu_id' => 429,
                'created_at' => '2022-12-04 22:08:58',
                'updated_at' => '2022-12-04 22:08:58',
            ),
            44 => 
            array (
                'id' => 124,
                'role_id' => 1,
                'menu_id' => 430,
                'created_at' => '2022-12-04 22:09:08',
                'updated_at' => '2022-12-04 22:09:08',
            ),
            45 => 
            array (
                'id' => 125,
                'role_id' => 4,
                'menu_id' => 430,
                'created_at' => '2022-12-04 22:09:08',
                'updated_at' => '2022-12-04 22:09:08',
            ),
            46 => 
            array (
                'id' => 128,
                'role_id' => 1,
                'menu_id' => 428,
                'created_at' => '2022-12-04 22:10:49',
                'updated_at' => '2022-12-04 22:10:49',
            ),
            47 => 
            array (
                'id' => 129,
                'role_id' => 4,
                'menu_id' => 428,
                'created_at' => '2022-12-04 22:10:49',
                'updated_at' => '2022-12-04 22:10:49',
            ),
            48 => 
            array (
                'id' => 130,
                'role_id' => 1,
                'menu_id' => 421,
                'created_at' => '2022-12-04 22:11:21',
                'updated_at' => '2022-12-04 22:11:21',
            ),
            49 => 
            array (
                'id' => 131,
                'role_id' => 4,
                'menu_id' => 421,
                'created_at' => '2022-12-04 22:11:21',
                'updated_at' => '2022-12-04 22:11:21',
            ),
            50 => 
            array (
                'id' => 134,
                'role_id' => 1,
                'menu_id' => 431,
                'created_at' => '2022-12-05 00:56:31',
                'updated_at' => '2022-12-05 00:56:31',
            ),
            51 => 
            array (
                'id' => 135,
                'role_id' => 4,
                'menu_id' => 431,
                'created_at' => '2022-12-05 00:56:31',
                'updated_at' => '2022-12-05 00:56:31',
            ),
            52 => 
            array (
                'id' => 136,
                'role_id' => 1,
                'menu_id' => 432,
                'created_at' => '2022-12-05 00:56:38',
                'updated_at' => '2022-12-05 00:56:38',
            ),
            53 => 
            array (
                'id' => 137,
                'role_id' => 4,
                'menu_id' => 432,
                'created_at' => '2022-12-05 00:56:38',
                'updated_at' => '2022-12-05 00:56:38',
            ),
            54 => 
            array (
                'id' => 138,
                'role_id' => 1,
                'menu_id' => 433,
                'created_at' => '2022-12-05 00:56:44',
                'updated_at' => '2022-12-05 00:56:44',
            ),
            55 => 
            array (
                'id' => 139,
                'role_id' => 4,
                'menu_id' => 433,
                'created_at' => '2022-12-05 00:56:44',
                'updated_at' => '2022-12-05 00:56:44',
            ),
            56 => 
            array (
                'id' => 140,
                'role_id' => 1,
                'menu_id' => 434,
                'created_at' => '2022-12-05 07:06:14',
                'updated_at' => '2022-12-05 07:06:14',
            ),
            57 => 
            array (
                'id' => 141,
                'role_id' => 1,
                'menu_id' => 416,
                'created_at' => '2022-12-05 09:52:35',
                'updated_at' => '2022-12-05 09:52:35',
            ),
            58 => 
            array (
                'id' => 143,
                'role_id' => 1,
                'menu_id' => 440,
                'created_at' => '2022-12-05 10:09:54',
                'updated_at' => '2022-12-05 10:09:54',
            ),
            59 => 
            array (
                'id' => 145,
                'role_id' => 3,
                'menu_id' => 441,
                'created_at' => '2022-12-13 00:27:02',
                'updated_at' => '2022-12-13 00:27:02',
            ),
            60 => 
            array (
                'id' => 147,
                'role_id' => 6,
                'menu_id' => 442,
                'created_at' => '2022-12-14 16:00:46',
                'updated_at' => '2022-12-14 16:00:46',
            ),
            61 => 
            array (
                'id' => 149,
                'role_id' => 5,
                'menu_id' => 443,
                'created_at' => '2022-12-14 21:09:23',
                'updated_at' => '2022-12-14 21:09:23',
            ),
            62 => 
            array (
                'id' => 150,
                'role_id' => 4,
                'menu_id' => 444,
                'created_at' => '2022-12-14 22:20:26',
                'updated_at' => '2022-12-14 22:20:26',
            ),
            63 => 
            array (
                'id' => 151,
                'role_id' => 1,
                'menu_id' => 373,
                'created_at' => '2022-12-16 00:45:00',
                'updated_at' => '2022-12-16 00:45:00',
            ),
            64 => 
            array (
                'id' => 152,
                'role_id' => 3,
                'menu_id' => 373,
                'created_at' => '2022-12-16 00:45:00',
                'updated_at' => '2022-12-16 00:45:00',
            ),
            65 => 
            array (
                'id' => 153,
                'role_id' => 4,
                'menu_id' => 373,
                'created_at' => '2022-12-16 00:45:00',
                'updated_at' => '2022-12-16 00:45:00',
            ),
            66 => 
            array (
                'id' => 154,
                'role_id' => 5,
                'menu_id' => 373,
                'created_at' => '2022-12-16 00:45:00',
                'updated_at' => '2022-12-16 00:45:00',
            ),
            67 => 
            array (
                'id' => 155,
                'role_id' => 6,
                'menu_id' => 373,
                'created_at' => '2022-12-16 00:45:00',
                'updated_at' => '2022-12-16 00:45:00',
            ),
            68 => 
            array (
                'id' => 159,
                'role_id' => 3,
                'menu_id' => 445,
                'created_at' => '2022-12-28 17:13:35',
                'updated_at' => '2022-12-28 17:13:35',
            ),
        ));
        
        
    }
}