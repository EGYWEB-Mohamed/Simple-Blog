<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('shield:generate --all');
        Artisan::call('db:seed --class=ShieldSeeder');
         $admin = \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@test.com',
         ]);
         $admin->assignRole('super_admin');
         Post::factory()->count(100)->create();
    }
}
