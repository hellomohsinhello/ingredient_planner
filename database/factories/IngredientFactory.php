<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{

    private array $measure = ['kg', 'g', 'l', 'ml', 'unit'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'supplier_id' => SupplierFactory::new(),
            'measure' =>  $this->measure[rand(0,4)]
        ];
    }
}
