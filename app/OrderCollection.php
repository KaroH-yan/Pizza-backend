<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCollection extends Model
{
    protected $fillable = [
        'order_id','pizza_id','quantity'
    ];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function prices()
    {

        return $this->pizza->prices;
    }
}
