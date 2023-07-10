<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseDisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classeDiscipline =[
            [
                'classes_id' => 1,
                'discipline_id' => 1,
                'evaluation_id' => 1,
                'semestre_id' => 1,
                'max_note' => 20,
            ],
            [
                'classes_id' => 1,
                'discipline_id' => 2,
                'evaluation_id' => 2,
                'semestre_id' => 1,
                'max_note' => 20,
            ],
            [
                'classes_id' => 1,
                'discipline_id' => 3,
                'evaluation_id' => 3,
                'semestre_id' => 1,
                'max_note' => 20,
            ],
            [
                'classes_id' => 1,
                'discipline_id' => 4,
                'evaluation_id' => 4,
                'semestre_id' => 1,
                'max_note' => 20,
            ],
            [
                'classes_id' => 1,
                'discipline_id' => 5,
                'evaluation_id' => 5,
                'semestre_id' => 1,
                'max_note' => 20,
            ],
        ];
        \App\Models\ClasseDiscipline::insert($classeDiscipline);
    }
}
