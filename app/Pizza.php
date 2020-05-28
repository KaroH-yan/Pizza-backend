<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = [
        'name','image'
    ];

    public function prices()
    {
        return $this->hasMany(PizzaPrice::class);
    }

    public function priceByCurrency(Currency $currency)
    {

        return $this->hasOne(PizzaPrice::class)->where('currency_id',$currency->id);
    }

}
