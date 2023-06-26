<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'             => fake()->name(),
            'description'      => fake()->text(),
            'website_url'      => fake()->url(),
            'logo_image_url'   => fake()->imageUrl(),
            'social_media_url' => fake()->url(),
            'status'           => true,
        ];
    }
}
