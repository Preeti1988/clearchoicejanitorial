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
        Schema::create('timesheet_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("member_id")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->integer("duration")->nullable();
            $table->string("status")->nullable();
            $table->text("details")->nullable();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheet_requests');
    }
};
