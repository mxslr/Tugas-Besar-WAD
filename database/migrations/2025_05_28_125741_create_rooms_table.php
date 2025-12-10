<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('room_code', 20)->unique();
            $table->string('room_name', 100);
            $table->string('building', 50);
            $table->integer('floor');
            $table->integer('capacity');
            $table->json('facilities')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'maintenance', 'unavailable'])->default('available');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};