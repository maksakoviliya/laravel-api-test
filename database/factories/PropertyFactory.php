<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price' => mt_rand(100000, 999999),
            'bedrooms' => mt_rand(0, 10),
            'bathrooms' => mt_rand(0, 10),
            'storeys' => mt_rand(0, 10),
            'garages' => mt_rand(0, 10),
        ];
    }
}
