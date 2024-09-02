<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                  => fake()->words(rand(1,4), true),
            'street'                => fake()->streetName(),
            'house_number'          => fake()->buildingNumber(),
            'house_number_addition' => fake()->buildingNumber() % 2 == 0 ? fake()->buildingNumber() : null,
            'zip_code'              => fake()->postcode(),
            'city'                  => fake()->city(),
            'country_code'          => fake()->countryCode(),
            'phone'                 => fake()->randomDigitNotNull() % 2 == 0  ? fake()->phoneNumber() : null,
            'email'                 => fake()->randomDigitNotNull() % 2 == 0  ? fake()->email() : null,
            'website'               => fake()->randomDigitNotNull() % 2 == 0  ? fake()->url() : null,
            'created_at'            => fake()->dateTimeBetween('-30 days', '-20 days'),
            'updated_at'            => fake()->dateTimeBetween('-19 days', 'now'),
        ];
    }
}
