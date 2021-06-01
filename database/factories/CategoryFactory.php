<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_name = $this->faker->unique()->words($nb=4,$astext=true);
        $slug = Str::slug($category_name);
        return [
            'uuid' => Uuid::generate()->string,
            'name' => $category_name,
            'slug' => $slug
        ];
    }
}
