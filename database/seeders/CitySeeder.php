<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = 'ville_35.json';
        $content = json_decode(file_get_contents($path), true);
        foreach ($content as $obj)
            DB::table('city')->insert(array(
                'Nom_commune' => $obj["Nom_commune"],
                'Code_postal' => $obj["Code_postal"],
            ));

    }
}

