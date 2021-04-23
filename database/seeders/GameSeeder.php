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
            "Jeux de plateau",
            "Jeux de cartes",
            "Jeux de dés",
            "Jeux de logique",
            "Jeux multijoueur",
            "Jeux coopératifs",
            "Jeux en équipe",
            "Jeux en pleine air",
            "Jeux en ligne",
            "Jeux vidéos",
            "Jeux action",
            "Jeux d'aventure",
            "Jeux de guerre",
            "Jeux de sport",
            "Jeux de réflexion",
            "Jeux de voiture",
            "Jeux d’ambiance",
            "Jeux d’apéro",
            "Jeux en binôme"
        ];
        foreach ($game as $obj)
            DB::table('game')->insert([
                'name' => $obj,
            ]);
    }
}
