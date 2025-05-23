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
        // Schema::create('contacts', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name', 100);
        //     $table->string('email', 150);
        //     $table->string('message', 1000);
        //     $table->timestamps();
        // });

        // Delete the table
        Schema::dropIfExists('contacts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
