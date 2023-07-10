<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'libelle' => 'Fosco',
                'user_id' => 1,
                'date_debut' => '2021-07-07',
                'date_fin' => '2021-07-07',
            ],
            [
                'libelle' => 'Composition',
                'user_id' => 2,
                'date_debut' => '2021-07-07',
                'date_fin' => '2021-07-07',
            ],
            [
                'libelle' => 'Sortie',
                'user_id' => 3,
                'date_debut' => '2021-07-07',
                'date_fin' => '2021-07-07',
            ],
        ];
        \App\Models\Events::insert($events);
    }
}
