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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_address');
            $table->string('name'); 
            $table->string('phone');
            $table->string('email');
            $table->text('note')->nullable();
            $table->integer('status')->comment('0:created,1:approved,2:successful,3:Cancelled');
            $table->integer('sum_money');
            $table->integer('payment_status')->comment('0:postpay,1:prepay');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_address')->references('id')->on('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
