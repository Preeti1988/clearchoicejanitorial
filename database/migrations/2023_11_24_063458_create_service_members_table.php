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
        Schema::create('service_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("member_id")->nullable();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->time("shift_start_time")->nullable();
            $table->time("shift_end_time")->nullable();
            $table->string("status")->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_members');
    }
};
