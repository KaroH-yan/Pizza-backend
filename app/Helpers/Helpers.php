<?php

namespace App\Helpers;
use Illuminate\Support\Arr;

class Helpers {

    public static function array_undot($dotted,$value , $initialArray = [])
    {
        Arr::set($initialArray, $dotted, $value);

        return $initialArray;
    }
}
