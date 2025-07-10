<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::factory(20)->create();
        $this->call(ProductSeeder::class);

        /*  User::factory()->create([
              'name' => 'Test User',
              'email' => 'test@example.com',
          ]);*/
    }
}
