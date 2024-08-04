<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comic>
 */
class ComicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isbn = $this->faker->isbn10();
        return [
            'user_id' => User::factory(),
            'shop_id' => Shop::factory(),
            'id_in_platform' => $isbn,
            'title' => $this->faker->sentence(4),
            'shelf_info' => "(棚: {$this->faker->unique()->numberBetween(1, 99)})",
            'isbn' => $isbn
        ];
    }
}
