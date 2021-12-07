<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {//ORM: eloquent model
        Category::create([
            'name'=>'model category',
            'slug'=>'model category',
            'description'=>'model category',
            'status'=>'draft',
        ]);
        return;

        //Query Builder
        DB::connection('mysql')->table('categories')->insert([
            'name'=>'first category',
            'slug'=>'first category',
            'description'=>'first category',
            'status'=>'active',
        ]);
        DB::connection('mysql')->table('categories')->insert([
            'name'=>'tow category',
            'slug'=>'tow category',
            'description'=>'tow category',
            'parent_id'=> 1,
            'status'=>'active',
        ]);

    }
}
