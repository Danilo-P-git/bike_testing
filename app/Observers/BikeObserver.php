<?php

namespace App\Observers;

use App\Models\Bike;
use App\Models\Contract;
use App\Models\Category;
use Illuminate\Http\Request;

use Carbon\Carbon;

class BikeObserver
{
    public $indice = 0;

    public function retrieved(Bike $bike)
    {   
        $today = Carbon::now()->format('Y-m-d');
        if (count($bike->contract)>0) {
            foreach ($bike->contract as $contract) {
                $end_date = $contract->data_fine;
                $carbonEnd = Carbon::createFromFormat('Y-m-d',$end_date);
                $start_date = $contract->data_inizio;
                $carbonStart = Carbon::createFromFormat('Y-m-d',$start_date);
                $check = Carbon::now()->between($carbonStart,$carbonEnd);
                // dd($check);
                if ($check) {
                    $bike->bloccata = 1;
                    
                
                } else {

                    $bike->bloccata = 0;
                }
                $bike->push();
            }
        }
    }
    /**
     * Handle the Bike "created" event.
     *
     * @param  \App\Models\Bike  $bike
     * @return void
     */
    public function created(Bike $bike)
    {
        //
    }

    /**
     * Handle the Bike "updated" event.
     *
     * @param  \App\Models\Bike  $bike
     * @return void
     */
    public function updated(Bike $bike)
    {
        //
    }

    /**
     * Handle the Bike "deleted" event.
     *
     * @param  \App\Models\Bike  $bike
     * @return void
     */
    public function deleted(Bike $bike)
    {
        //
    }

    /**
     * Handle the Bike "restored" event.
     *
     * @param  \App\Models\Bike  $bike
     * @return void
     */
    public function restored(Bike $bike)
    {
        //
    }

    /**
     * Handle the Bike "force deleted" event.
     *
     * @param  \App\Models\Bike  $bike
     * @return void
     */
    public function forceDeleted(Bike $bike)
    {
        //
    }
}
