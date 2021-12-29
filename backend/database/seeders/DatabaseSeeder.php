<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NlpPackageGenreTableSeeder::class);
        $this->call(NERLabelSeeder::class);

        $this->call(AppearanceTableSeeder::class);
        $this->call(User_rankTableSeeder::class);
        $this->call(User_roleTableSeeder::class);

        $this->call(Releasenote_genreTableSeeder::class);
        $this->call(ReleasenoteTableSeeder::class);
        $this->call(Osirase_genreTableSeeder::class);
        $this->call(OsiraseTableSeeder::class);

        $this->call(UserTableSeeder::class);
        $this->call(DiaryTableSeeder::class);
    }
}