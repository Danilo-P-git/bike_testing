<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'quantita',
        'contract_id',
        'bike_id',
    ];

    public function bike()
    {
        return $this->belongsToMany(Bike::class);
    }

    public function contract()
    {
        return $this->belongsToMany(Contract::class);
    }
}
