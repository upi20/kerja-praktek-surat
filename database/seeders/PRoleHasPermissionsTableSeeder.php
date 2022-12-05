<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PRoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_role_has_permissions')->delete();
        
        \DB::table('p_role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 121,
                'role_id' => 3,
            ),
            1 => 
            array (
                'permission_id' => 122,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 123,
                'role_id' => 6,
            ),
            3 => 
            array (
                'permission_id' => 124,
                'role_id' => 5,
            ),
            4 => 
            array (
                'permission_id' => 125,
                'role_id' => 4,
            ),
            5 => 
            array (
                'permission_id' => 135,
                'role_id' => 4,
            ),
            6 => 
            array (
                'permission_id' => 136,
                'role_id' => 4,
            ),
            7 => 
            array (
                'permission_id' => 143,
                'role_id' => 4,
            ),
            8 => 
            array (
                'permission_id' => 144,
                'role_id' => 4,
            ),
            9 => 
            array (
                'permission_id' => 148,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 152,
                'role_id' => 4,
            ),
            11 => 
            array (
                'permission_id' => 156,
                'role_id' => 4,
            ),
            12 => 
            array (
                'permission_id' => 160,
                'role_id' => 4,
            ),
        ));
        
        
    }
}