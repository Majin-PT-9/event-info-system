<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Event;
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
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EventUserSeeder::class);

    }
}
