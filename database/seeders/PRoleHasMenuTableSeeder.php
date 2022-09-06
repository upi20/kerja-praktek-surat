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
                'id' => 2,
                'role_id' => 3,
                'menu_id' => 390,
                'created_at' => '2022-08-22 21:07:20',
                'updated_at' => '2022-08-22 21:07:20',
            ),
            1 => 
            array (
                'id' => 3,
                'role_id' => 4,
                'menu_id' => 390,
                'created_at' => '2022-08-22 21:07:20',
                'updated_at' => '2022-08-22 21:07:20',
            ),
            2 => 
            array (
                'id' => 4,
                'role_id' => 5,
                'menu_id' => 390,
                'created_at' => '2022-08-22 21:07:20',
                'updated_at' => '2022-08-22 21:07:20',
            ),
            3 => 
            array (
                'id' => 5,
                'role_id' => 6,
                'menu_id' => 390,
                'created_at' => '2022-08-22 21:07:20',
                'updated_at' => '2022-08-22 21:07:20',
            ),
            4 => 
            array (
                'id' => 7,
                'role_id' => 3,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            5 => 
            array (
                'id' => 8,
                'role_id' => 4,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            6 => 
            array (
                'id' => 9,
                'role_id' => 5,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            7 => 
            array (
                'id' => 10,
                'role_id' => 6,
                'menu_id' => 373,
                'created_at' => '2022-08-22 21:07:42',
                'updated_at' => '2022-08-22 21:07:42',
            ),
            8 => 
            array (
                'id' => 11,
                'role_id' => 1,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            9 => 
            array (
                'id' => 13,
                'role_id' => 3,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            10 => 
            array (
                'id' => 14,
                'role_id' => 4,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            11 => 
            array (
                'id' => 15,
                'role_id' => 5,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
            12 => 
            array (
                'id' => 16,
                'role_id' => 6,
                'menu_id' => 386,
                'created_at' => '2022-08-22 21:07:56',
                'updated_at' => '2022-08-22 21:07:56',
            ),
        ));
        
        
    }
}