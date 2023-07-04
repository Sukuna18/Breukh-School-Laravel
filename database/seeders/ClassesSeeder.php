<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'libelle' => 'CI',
                'niveaux_id' => 1,
            ],
            [
                'libelle' => 'CP',
                'niveaux_id' => 1,
            ],
            [
                'libelle' => 'CE1',
                'niveaux_id' => 1,
            ],
            [
                'libelle' => 'CE2',
                'niveaux_id' => 1,
            ],
            [
                'libelle' => 'CM1',
                'niveaux_id' => 1,
            ],
            [
                'libelle' => 'CM2',
                'niveaux_id' => 1,
            ],
            [
                'libelle' => '6ème',
                'niveaux_id' => 2,
            ],
            [
                'libelle' => '5ème',
                'niveaux_id' => 2,
            ],
            [
                'libelle' => '4ème',
                'niveaux_id' => 2,
            ],
            [
                'libelle' => '3ème',
                'niveaux_id' => 2,
            ],
            [
                'libelle' => '2nde',
                'niveaux_id' => 3,
            ],
            [
                'libelle' => '1ère',
                'niveaux_id' => 3,
            ],
            [
                'libelle' => 'Tle',
                'niveaux_id' => 3,
            ],

        ];
        \App\Models\Classes::insert($classes);
    }
}
