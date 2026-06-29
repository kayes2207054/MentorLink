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
        Schema::create('session_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('availability_id')->constrained('mentor_availabilities')->cascadeOnDelete();
            $table->date('booking_date');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'cancelled', 'completed'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_bookings');
    }
};
