<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = fake()->unique()->sentence(2);
        $images = [
            fake()->imageUrl(640, 480, 'propriete', true, '1', false, 'jpg'),
            fake()->imageUrl(640, 480, 'propriete', true, '2', false, 'jpg'),
            fake()->imageUrl(640, 480, 'propriete', true, '3', false, 'jpg'),
        ];

        return [
            'nom' => $product,
            'slug' => $product,
            'description' => fake()->paragraph(5),
            'prix' => fake()->randomNumber(8, false),
            'type_paiement' => fake()->randomElement(
                ['jour', 'semaine', 'mois', 'an', 'unique']),
            'type' => fake()->randomElement(['location', 'achat']),
            'display_img_url_list' => $images,
            'images_url_list' => $images
        ];
    }
}
