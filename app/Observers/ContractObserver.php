<?php

namespace App\Observers;

use App\Models\Contract;
use App\Models\Bike;
use Carbon\Carbon;

class ContractObserver
{
    public function retrieved(Contract $contract)
    {
        // $contracts = Contract::with('bike', 'photo')->where('id', '=' , '2')->get();
        
        // foreach ($contracts as $contract) {
        //     $end_date = $contract->data_fine;
        //     $start_date = $contract->data_inizio;

        //     $today = Carbon::today();

        //     if ($today>= $start_date && $today<=$end_date) {
        //         $contract->bike->bloccata = 1;
        //     }

        // }
        
    }









    /**
     * Handle the Contract "created" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function created(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "updated" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function updated(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "deleted" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function deleted(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "restored" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function restored(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "force deleted" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function forceDeleted(Contract $contract)
    {
        //
    }
}
