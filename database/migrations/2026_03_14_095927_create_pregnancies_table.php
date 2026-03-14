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
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mother_id')->constrained()->cascadeOnDelete();
            $table->string('pregnancy_number')->unique();
            $table->date('booking_date')->nullable();
            $table->date('lmp')->nullable();
            $table->date('edd')->nullable();
            $table->unsignedTinyInteger('gravida')->nullable();
            $table->unsignedTinyInteger('para')->nullable();
            $table->unsignedTinyInteger('gestational_age_at_booking')->nullable();
            $table->enum('risk_level', ['low', 'moderate', 'high'])->default('low');
            $table->enum('status', ['active', 'delivered', 'referred', 'lost_follow_up'])->default('active');
            $table->string('referral_source')->nullable();
            $table->boolean('anc_profile_completed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnancies');
    }
};