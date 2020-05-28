<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Pizza;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helpers;


class OrderController extends Controller
{

    /**
     * Return orders for the auth user.
     *
     * @return OrderCollection
     */

    public function index()
    {
        return new OrderCollection(Auth::user()->orders);
    }

    /**
     * Store a new Order.
     *
     * @param Request $request
     * @return OrderResource
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'pizzas' => 'required|array|min:1',
            'pizzas.*.pizza_id' => 'required|exists:App\Pizza,id',
            'pizzas.*.quantity' => 'required|integer|min:1'
        ], [
            'required' => 'The field is required.',
            'array' => 'The field must be an array.',
            'exists' => 'The selected field is invalid',
            'integer' => 'The field must be an integer',
        ]);


        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $error) {
                $errors = array_merge($errors, Helpers::array_undot($key, $error));
            }

            return response()->json($errors, 411);
        }

        $validatedData = $request->all();

        $order = Order::create([
            'status' => 'C',
            'address' => $validatedData['address'],
            'user_id' => Auth::check() ? Auth::id() : null
        ]);

        $order->collections()->createMany($validatedData['pizzas']);

        $orderPrices = [];

        foreach ($validatedData['pizzas'] as $key => $data) {
            foreach (Pizza::whereId($data['pizza_id'])->first()->prices as $item) {
                if (!isset($orderPrices[$item->currency->name])) {
                    $orderPrices[$item->currency->name] = [];
                    $orderPrices[$item->currency->name]['currency_id'] = $item->currency_id;
                    $orderPrices[$item->currency->name]['price'] = 0;
                }

                $orderPrices[$item->currency->name]['price'] += $item->price * $data['quantity'];
            }
        }

        $order->prices()->createMany(array_values($orderPrices));

        return new OrderResource($order);

    }

    /**
     * Return order for the given id.
     *
     * @param int $id
     * @return OrderResource
     */

    public function show($id)
    {
        return new OrderResource(Order::whereId($id)->first());
    }

}
