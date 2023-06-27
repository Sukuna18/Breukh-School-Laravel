<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $niveaux = [
            [
                "libelle" => "Elementaire"
            ],
            [
                "libelle" => "Secondaire"
            ],
            [
                "libelle" => "Moyen"
            ]
        ];
        \App\Models\Niveaux::insert($niveaux);
    }
}
