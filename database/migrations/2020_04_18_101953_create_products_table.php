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
            $table->string('sku')->nullable();
            $table->tinyInteger('in_stock')->default(1);
            $table->tinyInteger('has_discount')->default(0);
            $table->string('discount_type')->nullable();
            $table->string('discount_rate')->nullable();
            $table->smallInteger('max_order_qty')->default(5);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_todays_deal')->default(0);
            $table->string('tags');
            $table->string('url_slug')->nullable();
            $table->string('short_descr')->nullable();
            $table->mediumText('full_descr')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_descr')->nullable();
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
