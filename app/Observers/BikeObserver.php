<?php

namespace App\Observers;

use App\Models\Bike;
use Carbon\Carbon;
class BikeObserver
{


    public function retrieved(Bike $bike)
    {
        if ($bike->contract_id!= NULL) {
            $data_fine = $bike->contract->data_fine;
            $today = Carbon::today();
            if ($data_fine < $today) {
                $bike->contract_id = NULL;
                $bike->save();
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
