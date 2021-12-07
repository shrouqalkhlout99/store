<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $category=DB::table('categories')->inRandomOrder()->limit(1)->first(['id']);
        $name=$this->faker->words('2',true);
        $status=['active','draft'];

        return [
            'name'=>$name,
            'slug'=>Str::Slug($name),
            'parent_id'=>$category? $category->id : null,
            'description'=>$this->faker->words('200',true),
            'image_path'=>$this->faker->imageUrl(),
            'status'=>$status [rand(0,1)],
        ];
    }
}
