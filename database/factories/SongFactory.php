<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Category;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Song::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'duration' => $this->faker->randomNumber(2),
            'release_date' => $this->faker->date(),
            'album_id' => Album::inRandomOrder()->first()->id ?? Album::factory(),
            'user_id' => 2 ?? User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Song $song) {
            $song->categories()->attach(Category::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        });
    }
}
