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
        // \App\Models\User::factory(10)->create();
        $this->call(CitySeeder::class);
        $this->call(CulturalJourneySeeder::class);
        $this->call(SportSeeder::class);
        $this->call(StyleSeeder::class);
        $this->call(SubStyleSeeder::class);
        $this->call(GameSeeder::class);
        $this->call(EventTypeSeeder::class);

    }
}
