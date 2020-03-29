<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubCategoris extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $ids = [1,2,3,4,5,6,7,8,9];
        for ($i = 0 ;$i< 30 ;$i++) {
            $array = [
                'name' => $faker->word,
                'meta_keywords' => $faker->name,
                'meta_des' => $faker->name,
            ];
            $subcat=\App\Models\SubCategory::create($array);
            // $subcat->cat()->sync(array_rand($ids , 1));
        }
    }
}
