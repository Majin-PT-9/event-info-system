<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $users = User::all();

        foreach ($events as $event) {
            //Add from 1 to 5 users
            foreach ($users->random(rand(1,5)) as $user) {
                $event->users()->attach($user->id,[
                    'maybe' => fake()->boolean(),
                ]);
            }
        }
    }
}
