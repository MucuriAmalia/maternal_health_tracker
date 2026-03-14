<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investigations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anc_visit_id')->constrained()->cascadeOnDelete();

            $table->string('investigation_type'); // Urine, HB, Blood Group, VDRL, HIV, Ultrasound, etc
            $table->string('result')->nullable();
            $table->string('status')->default('pending'); // pending, done, reviewed
            $table->date('investigation_date')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investigations');
    }
};
