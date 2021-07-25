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
        $dataInizio = [
            "2021-06-03",
            "2021-06-02",
            "2021-06-05",
            "2021-06-04",
            "2021-06-09",
            "2021-06-08",
            "2021-06-07",
            "2021-06-03",
            "2021-06-04",
            "2021-06-05",

        ];
        $dataFine = [
            "2021-06-09",
            "2021-06-05",
            "2021-06-10",
            "2021-06-02",
            "2021-06-11",
            "2021-06-25",
            "2021-06-15",
            "2021-06-04",
            "2021-06-05",
            "2021-06-06",
        ];

        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10 ; $i++) {
            $getCategory = Category::inRandomOrder()->first();
            // $getContract = Contract::inRandomOrder()->first();
            // dd($getContract->id);
            $newBike = new Bike;
            $newBike->name = $faker->name();
            // $newBike->valore_noleggio = $faker->randomNumber(2,true);
            $newBike->valore_acquisto = $faker->randomNumber(4,true);
            $newBike->valore_vendita = $faker->randomNumber(4,true);
            $newBike->manutenzione = $faker->boolean();
            // $newBike->contract_id = $getContract->id;
            $newBike->category_id = $getCategory->id;
            $newBike->save();

            // $newContract = new Contract;
            // $newContract->data_inizio = $dataInizio[$i];
            // $newContract->data_fine = $dataFine[$i];
            // $newContract->nome = $faker->word();
            // $newContract->cognome = $faker->word();
            // $newContract->tel = "3452776597";
            // $newContract->mail = "danilopatane98@gmail.com";
            // $newContract->nato_a = $faker->word();
            // $newContract->nato_il = $faker->date();
            // $newContract->comune_residenza = $faker->word();
            // $newContract->via_residenza = "via ingegnere 92";
            // $newContract->n_documento = $faker->randomNumber(4,true);
            // $newContract->data_documento = $faker->date();
            // $newContract->ente_documento = $faker->word();
            // $newContract->residenza_temp = $faker->word();

            // $newContract->save();





        }

        // for ($i=0; $i < 10 ; $i++) {
        //     $bike = Bike::inRandomOrder()->first();
        //     $contract = Contract::inRandomOrder()->first();
        //     $bike->contract()->attach($contract->id);
        // }
    }
}
