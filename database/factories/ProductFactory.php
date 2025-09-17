<?php
namespace Database\Factories;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'image' => 'https://picsum.photos/400/300?random=' . $this->faker->unique()->numberBetween(1001, 2000),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        ];
    }
} 