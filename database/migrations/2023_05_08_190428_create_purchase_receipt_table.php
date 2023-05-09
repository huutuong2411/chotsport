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
        Schema::create('purchase_receipt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('id_purchase');
            $table->unsignedBiginteger('id_product_detail');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('sum_money');
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
        Schema::dropIfExists('purchase_receipt');
    }
};
