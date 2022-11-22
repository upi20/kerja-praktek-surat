<?php

namespace Database\Seeders;

use App\Models\Penduduk\Rt;
use App\Models\Penduduk\Rw;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::create([
        //     'name' => 'Isep Lutpi Nur',
        //     'email' => 'iseplutpinur7@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'active' => '1'
        // ]);
        // \App\Models\User::factory(150)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(ArtikelTableSeeder::class);
        $this->call(ArtikelTagTableSeeder::class);
        $this->call(ArtikelKategoriTableSeeder::class);
        $this->call(ArtikelTagItemTableSeeder::class);
        $this->call(ArtikelKategoriItemTableSeeder::class);
        $this->call(GaleriTableSeeder::class);
        $this->call(GaleriTagMemberTableSeeder::class);
        $this->call(SocialMediaTableSeeder::class);
        $this->call(GFormsTableSeeder::class);
        $this->call(PRolesTableSeeder::class);
        $this->call(PPermissionsTableSeeder::class);
        $this->call(PMenuTableSeeder::class);
        $this->call(PModelHasPermissionsTableSeeder::class);
        $this->call(PModelHasRolesTableSeeder::class);
        $this->call(PRoleHasPermissionsTableSeeder::class);
        $this->call(PRoleHasMenuTableSeeder::class);
        $this->call(PMenuFrontendsTableSeeder::class);
        $this->call(NotifAdminAtasTableSeeder::class);
        $this->call(NotifDepanAtasTableSeeder::class);
        $this->call(HariBesarNasionalsTableSeeder::class);
        $this->call(ContactListTableSeeder::class);
        $this->call(ContactMessagesTableSeeder::class);
        $this->call(FaqTableSeeder::class);

        $this->call(PendudukSeeder::class);
    }
}
