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
        Schema::create('constructionn', function (Blueprint $table) {
            $table->id();
            $table->string('plot_area');
            $table->string('construction_area');
            $table->string('budget');
            $table->string('location');
            $table->string('your_name');
            $table->string('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constructionn');
    }
};
