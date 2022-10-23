<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AppearanceTableSeeder::class);
        $this->call(UserRankTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);

        $this->call(ReleasenoteGenreTableSeeder::class);
        $this->call(ReleasenoteTableSeeder::class);
        $this->call(OsiraseGenreTableSeeder::class);
        $this->call(OsiraseTableSeeder::class);
        if (app()->isLocal() || app()->runningUnitTests()) {
            $this->call(UserTableSeeder::class);
            $this->call(userReadNotificationTableSeeder::class);
            $this->call(DiaryTableSeeder::class);
            $this->call(OperationCoreTransitionPerHourTableSeeder::class);
        }
        $this->call(NERLabelSeeder::class);
        if (app()->isLocal() || app()->runningUnitTests()) {
            $this->call(NlpPackageGenreTableSeeder::class);
            $this->call(NlpPackageNameTableSeeder::class);
            $this->call(PackageNERTableSeeder::class);
            $this->call(NlpPackageUserTableSeeder::class);
            $this->call(CustomNERTableSeeder::class);
        }
    }
}
