<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\VehiclesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

   
    $this->call(VehiclesSeeder::class);
}
}