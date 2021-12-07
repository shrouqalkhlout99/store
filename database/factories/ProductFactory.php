<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category= Category::inRandomOrder()->limit(1)->first(['id']);
        $name=$this->faker->words('2',true);
        $status=['active','draft'];
// بستخدم faker  للحصول على اسماء وهمية
        return [
            'name'=>$name,
            'slug'=>Str::Slug($name),
            'category_id'=>$category? $category->id : null,
            'description'=>$this->faker->words('200',true),
            'image_path'=>$this->faker->imageUrl(),
            'status'=>$status [rand(0,1)],
            'price'=>$this->faker->randomFloat(2,50,20000),
            'quantity'=>$this->faker->randomFloat(0,0,20),

        ];
    }
}
