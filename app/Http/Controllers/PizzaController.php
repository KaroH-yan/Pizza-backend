<?php

namespace App\Http\Controllers;

use App\Http\Resources\PizzaCollection;
use App\Pizza;
use App\Http\Resources\PizzaResource;
use Illuminate\Http\Request;

class PizzaController extends Controller
{

    /**
     * Get pizzas
     *
     * @param Request $request
     * @return PizzaCollection
     */

    public function index(Request $request)
    {
        return new PizzaCollection(Pizza::orderBy('id', 'desc')->paginate(8));
    }

    /**
     * Return pizza for the given id.
     *
     * @param  int  $id
     * @return PizzaResource
     */


    public function show($id)
    {
        return new  PizzaResource(Pizza::whereId($id)->first());
    }

}
