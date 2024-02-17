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
        Schema::create('reply__comment_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('comments_product_id')->nullable();
            $table->string('reyly')->nullable();
            $table->string('user_id')->nullable();
            $table->string('product_id')->nullable();
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
        Schema::dropIfExists('reply__comment_products');
    }
};
