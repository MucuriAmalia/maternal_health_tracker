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
        Schema::create('postnatal_care_visits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mother_id')->constrained()->cascadeOnDelete();
            $table->foreignId('delivery_id')->nullable()->constrained()->nullOnDelete();

            $table->date('visit_date');
            $table->time('visit_time')->nullable();

            $table->integer('days_after_delivery')->nullable();

            $table->string('mother_condition')->nullable();
            // Stable, Needs Review, Critical

            $table->string('bleeding_status')->nullable();
            // Normal, Heavy, None

            $table->string('temperature')->nullable();
            $table->string('blood_pressure')->nullable();

            $table->string('breastfeeding_status')->nullable();
            // Exclusive, Mixed, Not Breastfeeding

            $table->string('baby_condition')->nullable();
            // Stable, Sick, Referred

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postnatal_care_visits');
    }
};
