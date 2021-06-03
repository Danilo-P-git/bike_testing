<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Bike;
use App\Models\Contract;

class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10 ; $i++) { 
            $getCategory = Category::inRandomOrder()->first();
            $getContract = Contract::inRandomOrder()->first();
            // dd($getContract->id);
            $newBike = new Bike;
            $newBike->name = $faker->name();
            $newBike->valore_noleggio = $faker->randomNumber(2,true);
            $newBike->valore_acquisto = $faker->randomNumber(4,true);
            $newBike->valore_vendita = $faker->randomNumber(4,true);
            $newBike->manutenzione = $faker->boolean();
            $newBike->contract_id = $getContract->id;
            $newBike->category_id = $getCategory->id;
            $newBike->save();
        }
    }
}
