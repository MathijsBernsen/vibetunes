<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Playlist::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'total_duration' => $this->faker->randomNumber(2),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Playlist $playlist) {
            $playlist->songs()->attach(Song::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        });
    }
}
