<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id')->nullable()->constrained("category_product")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('store_id')->references('id')->on('store')->onDelete('cascade');
            $table->string('name');
            $table->double('weight');
            $table->mediumInteger('stock');
            $table->integer('price');
            $table->string('image');
            $table->text('description');
            $table->softDeletes();
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
        Schema::dropIfExists('product');
    }
};
