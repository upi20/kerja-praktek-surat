<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuratKeteranganJenisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('surat_keterangan_jenis')->delete();

        \DB::table('surat_keterangan_jenis')->insert(array(
            0 =>
            array(
                'id' => 1,
                'nama' => 'Surat Keterangan Usaha',
                'created_at' => '2022-12-12 23:12:34',
                'updated_at' => '2022-12-12 23:12:34',
                'updated_by' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'nama' => 'Surat Keterangan Belum Kawin',
                'created_at' => '2022-12-12 23:12:38',
                'updated_at' => '2022-12-12 23:12:38',
                'updated_by' => NULL,
            ),
            2 =>
            array(
                'id' => 3,
                'nama' => 'Surat Keterangan Janda/Duda',
                'created_at' => '2022-12-12 23:12:44',
                'updated_at' => '2022-12-12 23:12:44',
                'updated_by' => NULL,
            ),
            3 =>
            array(
                'id' => 4,
                'nama' => 'Surat Keterangan Tidak Mampu',
                'created_at' => '2022-12-12 23:12:49',
                'updated_at' => '2022-12-12 23:12:49',
                'updated_by' => NULL,
            ),
        ));
    }
}
