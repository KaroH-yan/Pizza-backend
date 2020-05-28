<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPrice extends Model
{
    protected $fillable = [
        'order_id','price','currency_id'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

}
