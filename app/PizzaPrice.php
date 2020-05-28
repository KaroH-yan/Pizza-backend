<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaPrice extends Model
{
    protected $fillable = [
        'price', 'pizza_id', 'currency_id'
    ];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

}
