<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_roles')->delete();
        
        \DB::table('p_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'guard_name' => 'web',
                'created_at' => '2022-08-04 16:05:41',
                'updated_at' => '2022-08-06 14:36:10',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Penduduk',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 01:24:50',
                'updated_at' => '2022-09-07 00:44:29',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Kepala Desa',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 01:25:18',
                'updated_at' => '2022-09-07 00:44:50',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Sekertaris',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 01:25:41',
                'updated_at' => '2022-09-07 00:44:12',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Bendahara',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 01:25:58',
                'updated_at' => '2022-09-07 00:48:13',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Pegawai',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 01:26:14',
                'updated_at' => '2022-09-07 00:48:23',
            ),
            6 => 
            array (
                'id' => 11,
                'name' => 'Rukun Warga',
                'guard_name' => 'web',
                'created_at' => '2022-09-10 07:29:39',
                'updated_at' => '2022-09-10 07:29:39',
            ),
            7 => 
            array (
                'id' => 12,
                'name' => 'Rukun Tetangga',
                'guard_name' => 'web',
                'created_at' => '2022-09-10 07:29:57',
                'updated_at' => '2022-09-10 07:29:57',
            ),
        ));
        
        
    }
}