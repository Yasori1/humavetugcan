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
        Schema::create('rsvp', function (Blueprint $table) {
            $table->id();
            $table->string("name", 64);
            $table->string("surname", 64);
            $table->boolean("status")->default(false);
            $table->string("guest_count", 16)->default("1");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvp');
    }
};
