<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['startup', 'digital']);

        return [
            'title'       => fake()->name(),
            'slug'        => Str::slug(fake()->name()),
            'type'        => $type,
            'image'       => 'image.jpg',
            'content'     => fake()->sentence(),
            'status'      => 1,
            'features'    => null,
            'options'     => null,
            'language_id' => 1,
        ];
    }
}
