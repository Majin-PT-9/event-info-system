<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_id'    => Address::inRandomOrder()->first()->id,
            'name'          => fake()->words(3, true),
            'description'   => fake()->text(),
            'starts_at'     => fake()->dateTimeBetween('now', '+1 weeks'),
            'ends_at'       => fake()->dateTimeBetween('+2 weeks', '+3 weeks'),
            'published'     => fake()->boolean(),
            'created_at'    => fake()->dateTimeBetween('-30 days', '-20 days'),
            'updated_at'    => fake()->dateTimeBetween('-19 days', 'now'),
        ];
    }
}
