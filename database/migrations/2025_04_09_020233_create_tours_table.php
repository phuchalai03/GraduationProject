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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title',256);
            $table->text('description');
            $table->string('image', 256);
            $table->integer('quantity');
            $table->double('priceAdult');
            $table->double('priceChild');
            $table->string('duration', 256);
            $table->string('destination', 256);
            $table->tinyInteger('availability');
            $table->string('itinerary');
            $table->string('reviews', 256);
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
