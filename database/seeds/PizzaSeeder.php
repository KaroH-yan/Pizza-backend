<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Pizza;
use App\Currency;

class PizzaSeeder extends Seeder
{
    protected $names = [
        'Pepperoni',
        'Palermo',
        'Venice',
        'Diablo',
        'Vegetarian',
        'Neapolitan',
        'Europe',
        'Pizza Di Amanti',
        'Toscana',
        'Margarita',
        'Roman',
        'Corrida',
        'Syracuse',
        'Altono',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $usdCurrency = Currency::where('name','USD')->first();
        $euroCurrency = Currency::where('name','EURO')->first();

        foreach ($this->names as $currency) {

            $euroPrice = rand(5, 20) ;

            Pizza::create([
                'name' => $currency,
                'image'=>'http://www.tashirpizza.am/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/f/i/file_4_5.jpg'
            ])->prices()->createMany([
                [
                    'currency_id' => $usdCurrency->id,
                    'price' => $euroPrice - 1,
                ],
                [
                    'currency_id' => $euroCurrency->id,
                    'price' => $euroPrice,
                ],
            ]);

        }
    }
}
