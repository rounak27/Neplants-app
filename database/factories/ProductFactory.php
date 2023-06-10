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
    public function definition()
    {
        $name=fake()->name();
        return [
           'name'=>$name,
           'slugs'=>str()->slug($name),
           'description'=> fake()->text(),
            'quantity'=>fake()->numberBetween($int1=0, $int2=10),
            'price'=>fake()-> numberBetween($int1=1000, $int2=100000),
            
        ];
    }
}

