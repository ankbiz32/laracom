<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('name');
            $table->string('price');
            $table->string('image');
            $table->smallInteger('max_order_qty')->default(5);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_todays_deal')->default(0);
            $table->string('tags');
            $table->string('url_slug')->nullable();
            $table->string('country_iso_code')->default('IN');
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('products');
    }
}
