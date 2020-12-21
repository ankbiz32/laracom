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
            $table->string('amount');
            $table->string('phone');
            $table->integer('zipcode');
            $table->text('address');
            $table->string('country');
            $table->tinyInteger('ship_to_different_address')->default(0);
            $table->string('ship_phone')->nullable();
            $table->integer('ship_zipcode')->nullable();
            $table->text('ship_address')->nullable();
            $table->string('ship_country')->nullable();
            $table->tinyInteger('is_paid')->default(1);
            $table->string('payment_type')->default('COD');
            $table->string('payment_id')->nullable();
            $table->string('order_status')->default('ORDERED');
            $table->string('note')->nullable();
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
