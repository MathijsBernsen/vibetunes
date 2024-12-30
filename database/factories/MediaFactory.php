<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'location' => $this->faker->url,
            'type' => $this->faker->randomElement(['image', 'video'])
        ];
    }
}
