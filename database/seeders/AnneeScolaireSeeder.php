<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $annees = [
            [
                'libelle' => '2020-2021',
                'statut' => 0,
            ],
            [
                'libelle' => '2021-2022',
                'statut' => 0,
            ],
            [
                'libelle' => '2022-2023',
                'statut' => 1,
            ]

        ];
        \App\Models\AnneeScolaire::insert($annees);
    }
}
