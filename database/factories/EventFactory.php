<?php

namespace Database\Factories;

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
        // Set Faker locale to Dutch
        $faker = \Faker\Factory::create('nl_NL');

        return [
            'name' => $faker->sentence,
            'location' => $faker->address,
            'ticket_url' => $faker->url,
        ];
    }
}
