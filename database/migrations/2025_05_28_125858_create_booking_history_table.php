<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_history', function (Blueprint $table) {
            $table->id('history_id');
            $table->foreignId('booking_id')->constrained('bookings', 'booking_id')->onDelete('cascade');
            $table->foreignId('changed_by')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('old_status', 20);
            $table->string('new_status', 20);
            $table->text('notes')->nullable();
            $table->timestamp('changed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_history');
    }
};