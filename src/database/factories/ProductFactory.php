<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $photo = UploadedFile::fake()->create('createOrUpdate.png');
        
        return [
            'code' => $this->faker->randomNumber(),
            'name' => $this->faker->sentence(),
            'photo' => $photo,
            'price' => $this->faker->randomFloat(2, 0, 20),
            'type' => $this->faker->randomElement(['pasteis', 'bebidas', 'sobremesas']),
        ];
    }
}
