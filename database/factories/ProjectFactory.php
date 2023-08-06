<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'            => fake()->name(),
            'client_name'      => fake()->firstName(),
            'slug'             => 'project-1',
            'link'             => fake()->url(),
            'content'          => fake()->sentence(),
            'status'           => true,
            'image'            => 'image.jpg',
            'gallery'          => 'image.jpg',
            'meta_title'       => fake()->name(),
            'meta_description' => fake()->sentence(),
            'service_id'       => 1,
            'page_id'          => null,
            'language_id'      => 1,
        ];
    }
}
