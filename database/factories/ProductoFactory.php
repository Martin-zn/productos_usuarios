<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{

    protected $model = \App\Models\Producto::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'precio' => $this->faker->numberBetween(1000,500000),
            'descripcion' => $this->faker->sentence(),
            'imagen' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
