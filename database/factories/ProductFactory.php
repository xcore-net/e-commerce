<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(100, 1000),
            'amount' => $this->faker->numberBetween(1, 100),
            'category' => $this->faker->randomElement(['cat1', 'cat2']),
            'img' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
