<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

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
        $product_name = $this->faker->unique()->words($nb=4,$astext=true);
        $slug = Str::slug($product_name);
        return [
            'uuid' => Uuid::generate()->string,
            'name' => $product_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'price' => $this->faker->numberBetween(10,500),
            'image' => 'digital_0'.$this->faker->numberBetween(1,9).'.jpg',
            'category_id' => $this->faker->numberBetween(1,5)
        ];
    }
}
