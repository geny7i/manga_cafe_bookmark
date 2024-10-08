<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'platform_id' => 1, // NOTE: 快活のみ想定
            'id_in_platform' => (string) $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'name' => "快活CLUB {$this->faker->city()}店"
        ];
    }
}
