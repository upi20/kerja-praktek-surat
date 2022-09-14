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
                'id' => 7,
                'role_id' => 3,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            1 => 
            array (
                'id' => 8,
                'role_id' => 4,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            2 => 
            array (
                'id' => 9,
                'role_id' => 5,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            3 => 
            array (
                'id' => 10,
                'role_id' => 6,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            4 => 
            array (
                'id' => 11,
                'role_id' => 1,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            5 => 
            array (
                'id' => 13,
                'role_id' => 3,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            6 => 
            array (
                'id' => 14,
                'role_id' => 4,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            7 => 
            array (
                'id' => 15,
                'role_id' => 5,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            8 => 
            array (
                'id' => 16,
                'role_id' => 6,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            9 => 
            array (
                'id' => 18,
                'role_id' => 1,
                'menu_id' => 411,
                'created_at' => '2022-09-09 13:45:06',
                'updated_at' => '2022-09-09 13:45:06',
            ),
            10 => 
            array (
                'id' => 19,
                'role_id' => 1,
                'menu_id' => 397,
                'created_at' => '2022-09-09 13:45:27',
                'updated_at' => '2022-09-09 13:45:27',
            ),
            11 => 
            array (
                'id' => 20,
                'role_id' => 1,
                'menu_id' => 412,
                'created_at' => '2022-09-09 13:45:50',
                'updated_at' => '2022-09-09 13:45:50',
            ),
            12 => 
            array (
                'id' => 21,
                'role_id' => 1,
                'menu_id' => 345,
                'created_at' => '2022-09-09 13:47:23',
                'updated_at' => '2022-09-09 13:47:23',
            ),
            13 => 
            array (
                'id' => 27,
                'role_id' => 1,
                'menu_id' => 410,
                'created_at' => '2022-09-09 13:50:25',
                'updated_at' => '2022-09-09 13:50:25',
            ),
            14 => 
            array (
                'id' => 28,
                'role_id' => 3,
                'menu_id' => 410,
                'created_at' => '2022-09-09 13:50:25',
                'updated_at' => '2022-09-09 13:50:25',
            ),
            15 => 
            array (
                'id' => 31,
                'role_id' => 3,
                'menu_id' => 390,
                'created_at' => '2022-09-09 13:52:48',
                'updated_at' => '2022-09-09 13:52:48',
            ),
        ));
        
        
    }
}