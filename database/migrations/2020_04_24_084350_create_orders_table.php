<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->text('email');
            $table->string('phone');
            $table->integer('zipcode');
            $table->text('address');
            $table->string('country');
            $table->string('amount');
            $table->tinyInteger('is_paid');
            $table->string('payment_type');
            $table->integer('payment_id')->nullable();
            $table->string('order_status')->default('ORDERED');
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
