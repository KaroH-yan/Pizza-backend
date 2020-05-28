<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Currency;

class CurrencySeeder extends Seeder
{

    protected $names = [
        'USD',
        'EURO'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->names as $currency) {

            Currency::create([
                'name' => $currency
            ]);

        }
    }
}
