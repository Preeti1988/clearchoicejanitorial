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
        Schema::create('service_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->unsignedBigInteger("member_id")->nullable();
            $table->unsignedBigInteger("service_item_id")->nullable();
            $table->integer("rating")->nullable();
            $table->text("review")->nullable();
            $table->string("status")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_ratings');
    }
};
