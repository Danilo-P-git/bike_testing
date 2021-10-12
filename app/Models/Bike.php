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
        'accessory_id',


    ];


    public function contract()
    {
        return $this->belongsToMany(Contract::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
    public function accessori()
    {
        return $this->belongsToMany(Accessory::class);
    }
}
