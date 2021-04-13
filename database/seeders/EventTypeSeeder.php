<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


           $type = [
               "music",
               "game",
               "art",
               "sport"
           ];
        foreach ($type as $obj)
            DB::table('event_types')->insert([
                'name' => $obj,
            ]);
    }
}
