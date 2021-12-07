<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       // Category::factory(10)->create();
        product::factory(30)->create();
        $this->call([
           // CategoriseTableSeeder::class,
          //  UserSeederTable::class,
        ]);
    }
}
