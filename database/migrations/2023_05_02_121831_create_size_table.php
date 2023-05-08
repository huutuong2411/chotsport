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
        Schema::create('size', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_brand');
            $table->double('length', 3, 1);
            $table->string('size');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_brand')->references('id')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size');
    }
};
