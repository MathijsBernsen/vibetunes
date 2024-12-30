<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Album::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'duration' => $this->faker->randomNumber(2),
            'release_date' => $this->faker->date(),
        ];
    }
}
