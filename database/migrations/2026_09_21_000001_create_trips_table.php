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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('destination', 150);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('jumlah_orang')->default(1);
            $table->decimal('budget', 15, 2);
            $table->json('preferences')->nullable();
            $table->text('context')->nullable();
            $table->text('summary')->nullable();
            $table->json('budget_breakdown')->nullable();
            $table->json('itinerary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
