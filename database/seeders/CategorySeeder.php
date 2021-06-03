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
            "MTB",
            "Enduro",
            "e-MTB",
            "Classic",
            "Full suspended e-MTB",
            "Extreme"
        ];

        foreach ($category as $key) {
            $newCategory = new Category;
            $newCategory->tipo = $key;
            $newCategory->save();
        }
    }
}
