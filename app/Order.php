<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','status','address'
    ];

    public function collections()
    {
        return $this->hasMany(OrderCollection::class);
    }


    public function prices()
    {
        return $this->hasMany(OrderPrice::class);
    }

    public function getStatusAttribute() {
        switch ($this->attributes['status']){
            case 'C':
                return 'Confirmed';
            case 'D':
                return 'Denied';
            case 'F':
                return 'Completed';
            case 'P':
                return 'Pending';
            case 'R':
                return 'Refunded';
            case 'S':
                return 'Shipped';
            case 'U':
                return 'Confirmed By Shopper';
            case 'X':
                return 'Cancelled';

        }

    }

}
