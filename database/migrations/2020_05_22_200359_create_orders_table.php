<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

        //The pre-configured statuses are:
        //
        //C - Confirmed
        //D - Denied
        //F - Completed
        //P - Pending - LOCKED
        //R - Refunded
        //S - Shipped - LOCKED
        //U - Confirmed by Shopper
        //X - Cancelled - LOCKED


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('address');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status',['C','D','F','P','R','S','U','X']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
