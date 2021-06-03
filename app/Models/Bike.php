<?php

namespace App\Models;

use App\Observers\BikeObserver;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'valore_noleggio',
        'valore_acquisto',
        'valore_vendita',
        'manutenzione',
        'contract_id',
        'category_id',


    ];


    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
