<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            NiveauxSeeder::class,
            ClassesSeeder::class,
            AnneeScolaireSeeder::class,
            DisciplineSeeder::class,
            EvaluationSeeder::class,
            SemestreSeeder::class,
            ClasseDisciplineSeeder::class,
            UserSeeder::class,
            EventsSeeder::class,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
