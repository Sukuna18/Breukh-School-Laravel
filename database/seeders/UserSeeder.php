<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'admin1',
                'email'=> 'admin1@gmail.com'
            ],
            [
                'name' => 'admin2',
                'email'=> 'admin2@gmail.com'
            ],
            [
                'name' => 'admin3',
                'email'=> 'admin3@gmail.com'
            ],
        ];
        \App\Models\User::insert($user);
    }
}
