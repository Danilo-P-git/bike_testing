<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            "MTB" => [
                'base' => 25,
                'twoDay' => 50,
                'threeDay' => 65,
                'fourDay' => 100,
                'fiveDay' => 125,
                'sixDay' => 150,
                'sevenDay' => 170,
                'overprice' => 15,

            ],

            "Full sus. e-mtb" => [
                'base' => 40,
                'twoDay' => 80,
                'threeDay' => 120,
                'fourDay' => 150,
                'fiveDay' => 185,
                'sixDay' => 210,
                'sevenDay' => 240,
                'overprice' => 40,

            ],

            "E-mtb Xduro" => [
                'base' =>  50,
                'twoDay' => 100,
                'threeDay' => 150,
                'fourDay' => 200,
                'fiveDay' => 250,
                'sixDay' => 300,
                'sevenDay' => 350,
                'overprice' => 50,

            ],

            "Ciclotour E-bike" => [
                'base' => 25,
                'twoDay' => 50,
                'threeDay' => 65,
                'fourDay' => 100,
                'fiveDay' => 125,
                'sixDay' => 150,
                'sevenDay' => 170,
                'overprice' => 15,

            ],

            "Gravel" => [
                'base' => 25,
                'twoDay' => 50,
                'threeDay' => 65,
                'fourDay' => 100,
                'fiveDay' => 125,
                'sixDay' => 150,
                'sevenDay' => 170,
                'overprice' => 15,

            ],

        ];



        foreach ($category as $key => $value) {
            $newCategory = new Category;
            $newCategory->tipo = $key;
            $newCategory->base = $value['base'];
            $newCategory->twoDay = $value['twoDay'];
            $newCategory->threeDay = $value['threeDay'];
            $newCategory->fourDay = $value['fourDay'];
            $newCategory->fiveDay = $value['fiveDay'];
            $newCategory->sixDay = $value['sixDay'];
            $newCategory->sevenDay = $value['sevenDay'];
            $newCategory->overprice = $value['overprice'];



            $newCategory->save();
        }
    }
}
