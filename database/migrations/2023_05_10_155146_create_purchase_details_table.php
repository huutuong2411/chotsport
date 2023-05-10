<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_purchase');
            $table->unsignedBigInteger('id_product_detail');
            $table->integer('qty');
            $table->integer('sum_money');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_purchase')->references('id')->on('purchase');
            $table->foreign('id_product_detail')->references('id')->on('product_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
