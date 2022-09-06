<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PMenuFrontendsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('p_menu_frontends')->delete();
        
        \DB::table('p_menu_frontends')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'title' => 'Home',
                'icon' => NULL,
                'route' => '__base_url__',
                'sequence' => 1,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-20 14:26:10',
                'updated_at' => '2022-08-20 14:30:13',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'title' => 'Tentang Kami',
                'icon' => NULL,
                'route' => '#',
                'sequence' => 3,
                'active' => 0,
                'type' => 1,
                'created_at' => '2022-08-20 14:30:39',
                'updated_at' => '2022-08-22 01:33:54',
            ),
            2 => 
            array (
                'id' => 16,
                'parent_id' => NULL,
                'title' => 'Galery',
                'icon' => NULL,
                'route' => 'galeri',
                'sequence' => 16,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-20 14:46:53',
                'updated_at' => '2022-08-22 20:39:16',
            ),
            3 => 
            array (
                'id' => 18,
                'parent_id' => NULL,
                'title' => 'Contak',
                'icon' => NULL,
                'route' => 'kontak',
                'sequence' => 18,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-20 14:47:10',
                'updated_at' => '2022-08-22 20:39:05',
            ),
            4 => 
            array (
                'id' => 19,
                'parent_id' => NULL,
                'title' => 'FAQ',
                'icon' => NULL,
                'route' => 'kontak.faq',
                'sequence' => 18,
                'active' => 1,
                'type' => 1,
                'created_at' => '2022-08-22 20:45:46',
                'updated_at' => '2022-08-22 21:26:12',
            ),
        ));
        
        
    }
}