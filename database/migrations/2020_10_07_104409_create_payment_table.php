<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{

    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id')->nullable();
            $table->string('vendor');
            $table->string('payment_amount');
            $table->string('vendor_order_id');
            $table->string('vendor_payment_id')->nullable();
            $table->string('vendor_signature')->nullable();
            $table->string('vendor_errors')->nullable();
            $table->string('status');
            $table->string('currency');
            $table->string('hdfc_tracking_id')->nullable();
            $table->string('bank_ref_no')->nullable();
            $table->string('hdfc_pay_mode')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
