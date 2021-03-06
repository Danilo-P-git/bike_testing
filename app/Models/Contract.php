<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\ContractObserver;

class Contract extends Model
{
    use HasFactory;


    public function bike()
    {
        return $this->belongsToMany(Bike::class);
    }

    public function accessori()
    {
        return $this->belongsToMany(Accessory::class);
    }

}
