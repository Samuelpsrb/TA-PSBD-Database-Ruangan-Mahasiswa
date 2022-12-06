<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Sam',
            'email' => 'cge98192@mzico.com',
            'email_verified_at' => NULL,
            'password' => '$2y$10$JjmOYehqh3T8tvfytQKqb.9rxjlTBG7WmPlHfjMvw4sLsvuvzdG2e' 
        ]);
    }
}
