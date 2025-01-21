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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            
            $table->string('title');
            $table->string('location');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled']); //Check 
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
