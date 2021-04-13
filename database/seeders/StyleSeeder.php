<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $style = ["African", "Asian", 'South and southeast Asian', 'Avant-garde', 'Blues', 'Caribbean and Caribbean-influenced', 'Comedy',
            'Country', 'Easy listening', 'Electronic', 'Folk', 'Hip hop', 'Jazz', 'Latin', 'Pop', 'R&B and soul', 'Rock'];
        foreach ($style as $obj)
            DB::table('style_music')->insert([
                'name' => $obj,
            ]);

    }
}
