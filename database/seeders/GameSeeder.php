<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $game = ["Jeux de société",
            "Jeux multijoueur",
            "Jeux en pleine air",
            "Jeux en ligne"
        ];
        foreach ($game as $obj)
            DB::table('game')->insert([
                'name' => $obj,
            ]);
    }
}
