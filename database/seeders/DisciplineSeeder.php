<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discipline = [
            [
                'libelle' => 'Mathématiques',
                'code' => 'MATH',
                'created_at' => '2021-09-01 00:00:00',
                'updated_at' => '2021-09-01 00:00:00'
            ],
            [
                'libelle' => 'Français',
                'code' => 'FR',
                'created_at' => '2021-09-01 00:00:00',
                'updated_at' => '2021-09-01 00:00:00'
            ],
            [
                'libelle' => 'Anglais',
                'code' => 'ANGL',
                'created_at' => '2021-09-01 00:00:00',
                'updated_at' => '2021-09-01 00:00:00'
            ],
            [
                'libelle' => 'Histoire',
                'code' => 'HIST',
                'created_at' => '2021-09-01 00:00:00',
                'updated_at' => '2021-09-01 00:00:00'
            ],
            [
                'libelle' => 'Géographie',
                'code' => 'GEO',
                'created_at' => '2021-09-01 00:00:00',
                'updated_at' => '2021-09-01 00:00:00'
            ]
        ];
        \App\Models\Discipline::insert($discipline);
    }
}
