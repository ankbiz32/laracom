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
            $table->text('category_id');
            $table->integer('brand_id');
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->smallInteger('max_order_qty')->default(5);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_todays_deal')->default(0);
            $table->string('tags');
            $table->string('url_slug')->nullable();
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
