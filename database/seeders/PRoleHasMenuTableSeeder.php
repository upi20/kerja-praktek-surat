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
                'id' => 18,
                'role_id' => 1,
                'menu_id' => 411,
                'created_at' => '2022-09-09 13:45:06',
                'updated_at' => '2022-09-09 13:45:06',
            ),
            6 => 
            array (
                'id' => 19,
                'role_id' => 1,
                'menu_id' => 397,
                'created_at' => '2022-09-09 13:45:27',
                'updated_at' => '2022-09-09 13:45:27',
            ),
            7 => 
            array (
                'id' => 20,
                'role_id' => 1,
                'menu_id' => 412,
                'created_at' => '2022-09-09 13:45:50',
                'updated_at' => '2022-09-09 13:45:50',
            ),
            8 => 
            array (
                'id' => 31,
                'role_id' => 3,
                'menu_id' => 390,
                'created_at' => '2022-09-09 13:52:48',
                'updated_at' => '2022-09-09 13:52:48',
            ),
            9 => 
            array (
                'id' => 35,
                'role_id' => 1,
                'menu_id' => 361,
                'created_at' => '2022-12-03 00:21:05',
                'updated_at' => '2022-12-03 00:21:05',
            ),
            10 => 
            array (
                'id' => 36,
                'role_id' => 1,
                'menu_id' => 416,
                'created_at' => '2022-12-03 00:21:37',
                'updated_at' => '2022-12-03 00:21:37',
            ),
            11 => 
            array (
                'id' => 42,
                'role_id' => 1,
                'menu_id' => 422,
                'created_at' => '2022-12-03 00:22:45',
                'updated_at' => '2022-12-03 00:22:45',
            ),
            12 => 
            array (
                'id' => 43,
                'role_id' => 1,
                'menu_id' => 345,
                'created_at' => '2022-12-03 00:24:13',
                'updated_at' => '2022-12-03 00:24:13',
            ),
            13 => 
            array (
                'id' => 45,
                'role_id' => 1,
                'menu_id' => 424,
                'created_at' => '2022-12-03 00:28:18',
                'updated_at' => '2022-12-03 00:28:18',
            ),
            14 => 
            array (
                'id' => 47,
                'role_id' => 5,
                'menu_id' => 426,
                'created_at' => '2022-12-03 00:42:51',
                'updated_at' => '2022-12-03 00:42:51',
            ),
            15 => 
            array (
                'id' => 49,
                'role_id' => 4,
                'menu_id' => 427,
                'created_at' => '2022-12-03 00:44:56',
                'updated_at' => '2022-12-03 00:44:56',
            ),
            16 => 
            array (
                'id' => 50,
                'role_id' => 3,
                'menu_id' => 417,
                'created_at' => '2022-12-03 00:45:10',
                'updated_at' => '2022-12-03 00:45:10',
            ),
            17 => 
            array (
                'id' => 51,
                'role_id' => 6,
                'menu_id' => 418,
                'created_at' => '2022-12-03 00:45:54',
                'updated_at' => '2022-12-03 00:45:54',
            ),
            18 => 
            array (
                'id' => 52,
                'role_id' => 5,
                'menu_id' => 419,
                'created_at' => '2022-12-03 00:46:13',
                'updated_at' => '2022-12-03 00:46:13',
            ),
            19 => 
            array (
                'id' => 53,
                'role_id' => 4,
                'menu_id' => 423,
                'created_at' => '2022-12-03 00:46:29',
                'updated_at' => '2022-12-03 00:46:29',
            ),
            20 => 
            array (
                'id' => 54,
                'role_id' => 1,
                'menu_id' => 420,
                'created_at' => '2022-12-03 00:46:49',
                'updated_at' => '2022-12-03 00:46:49',
            ),
            21 => 
            array (
                'id' => 55,
                'role_id' => 4,
                'menu_id' => 420,
                'created_at' => '2022-12-03 00:46:49',
                'updated_at' => '2022-12-03 00:46:49',
            ),
            22 => 
            array (
                'id' => 56,
                'role_id' => 1,
                'menu_id' => 414,
                'created_at' => '2022-12-03 00:46:58',
                'updated_at' => '2022-12-03 00:46:58',
            ),
            23 => 
            array (
                'id' => 57,
                'role_id' => 4,
                'menu_id' => 414,
                'created_at' => '2022-12-03 00:46:58',
                'updated_at' => '2022-12-03 00:46:58',
            ),
            24 => 
            array (
                'id' => 60,
                'role_id' => 1,
                'menu_id' => 415,
                'created_at' => '2022-12-03 00:47:20',
                'updated_at' => '2022-12-03 00:47:20',
            ),
            25 => 
            array (
                'id' => 61,
                'role_id' => 4,
                'menu_id' => 415,
                'created_at' => '2022-12-03 00:47:20',
                'updated_at' => '2022-12-03 00:47:20',
            ),
            26 => 
            array (
                'id' => 62,
                'role_id' => 1,
                'menu_id' => 421,
                'created_at' => '2022-12-03 00:47:29',
                'updated_at' => '2022-12-03 00:47:29',
            ),
            27 => 
            array (
                'id' => 63,
                'role_id' => 4,
                'menu_id' => 421,
                'created_at' => '2022-12-03 00:47:29',
                'updated_at' => '2022-12-03 00:47:29',
            ),
            28 => 
            array (
                'id' => 64,
                'role_id' => 3,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            29 => 
            array (
                'id' => 65,
                'role_id' => 4,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            30 => 
            array (
                'id' => 66,
                'role_id' => 5,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            31 => 
            array (
                'id' => 67,
                'role_id' => 6,
                'menu_id' => 373,
                'created_at' => '2022-12-03 00:57:46',
                'updated_at' => '2022-12-03 00:57:46',
            ),
            32 => 
            array (
                'id' => 68,
                'role_id' => 6,
                'menu_id' => 425,
                'created_at' => '2022-12-03 00:59:27',
                'updated_at' => '2022-12-03 00:59:27',
            ),
            33 => 
            array (
                'id' => 69,
                'role_id' => 1,
                'menu_id' => 413,
                'created_at' => '2022-12-03 01:14:50',
                'updated_at' => '2022-12-03 01:14:50',
            ),
            34 => 
            array (
                'id' => 70,
                'role_id' => 4,
                'menu_id' => 413,
                'created_at' => '2022-12-03 01:14:50',
                'updated_at' => '2022-12-03 01:14:50',
            ),
        ));
        
        
    }
}