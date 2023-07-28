<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semestre = [
            [
                'libelle' => 'semestre 1',
                'statut' => '1'
            ],
            [
                'libelle' => 'semestre 2',
                'statut' => '0'
            ],
            [
                'libelle' => 'semestre 3',
                'statut' => '0'
            ],
        ];
        Semestre::insert($semestre);
    }
}
