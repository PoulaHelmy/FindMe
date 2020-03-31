<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Inputs extends Seeder
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

            ];
            $input=\App\Models\Input::create($array);
            //$input->subcat()->sync(array_rand($ids , 1));
        }
    }
}
