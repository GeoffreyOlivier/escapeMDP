<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CulturalJourneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('cultural_journey')->insert([
//           'name' => 'Concert'
//        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Théatre'
        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Festival'
        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Jeune public'
        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Danse'
        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Art du spectacle'
        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Exposition'
        ]);
        DB::table('cultural_journey')->insert([
            'name' => 'Art de rue'
        ]);

    }
}
