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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->unsignedBigInteger("member_id")->nullable();
            $table->string("service")->nullable();
            $table->string("equipment")->nullable();
            $table->string("burnisher")->nullable();
            $table->string("supplies")->nullable();
            $table->string("service_rating")->nullable();
            $table->string("equipment_rating")->nullable();
            $table->string("burnisher_rating")->nullable();
            $table->string("supplies_rating")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
