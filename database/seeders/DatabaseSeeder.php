<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory(10)->create();

        $this->call([

            LanguagesSeeder::class,
            CategorySeeder::class,
            SectionSeeder::class,
            SettingSeeder::class,
            // FeaturedBannerSeeder::class,
            BlogSeeder::class,
            SliderSeeder::class,
            PermissionSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            PartnerSeeder::class,

        ]);
    }
}
