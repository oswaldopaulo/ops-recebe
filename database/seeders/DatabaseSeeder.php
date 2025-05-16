<?php

namespace Database\Seeders;

use App\Models\MenuMenu;
use App\Models\MenuSession;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@tester.com',
            'password' => bcrypt('test'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        MenuSession::create([
            'description'=>'Admin',
            'role'=>'admin',
            'tooltips'=>'Admin'
        ]);


        MenuMenu::create([
            'session_id'=>MenuSession::where('description','Admin')->first()->id,
            'description'=>'Profile',
            'route'=>'profile',
        ]);


    }
}
