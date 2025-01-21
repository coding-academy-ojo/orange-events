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
        Schema::create('attendee_tokens', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('attendee_id');
            $table->foreign('attendee_id')->references('id')->on('attendees');

            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');

            $table->string('token')->unique();

            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendee_tokens');
    }
};
