<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'user_name' => 'ruslan',
            'full_name' => 'abbasov ruslan',
            'email' => 'abbasov3232@inbox.ru',
            'password' => Hash::make("R1994Abbasov"),
            'isActive' => '1',
        ]);
    }
}
