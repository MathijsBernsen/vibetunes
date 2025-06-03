<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'song_id' => Song::inRandomOrder()->first()->id ?? Song::factory(),
            'album_id' => Album::inRandomOrder()->first()->id ?? Album::factory(),
            'content' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
