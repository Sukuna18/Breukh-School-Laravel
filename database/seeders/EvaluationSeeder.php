<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluation = [
            [
                'libelle' => 'Devoir',
                'max_note' => 20
            ],
            [
                'libelle' => 'Interrogation',
                'max_note' => 20
            ],
            [
                'libelle' => 'Composition',
                'max_note' => 20
            ],
            [
                'libelle' => 'Examen',
                'max_note' => 20
            ],
        ];
        \App\Models\Evaluation::insert($evaluation);
    }
}
