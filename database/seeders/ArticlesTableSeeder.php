<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Article;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 
    public function run()
    {
         Article::factory(10)->create(); 
        // factory(App\Article::class,10)->create;
    }
}
