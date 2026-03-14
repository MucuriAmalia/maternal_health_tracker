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
    Schema::create('deliveries', function (Blueprint $table) {
        $table->id();

        $table->foreignId('mother_id')->constrained()->cascadeOnDelete();
        $table->foreignId('anc_visit_id')->nullable()->constrained()->nullOnDelete();

        $table->date('delivery_date');
        $table->time('delivery_time')->nullable();

        $table->string('delivery_type'); 
        // Normal, Caesarean, Assisted

        $table->string('baby_gender');
        // Male, Female

        $table->decimal('baby_weight', 5, 2)->nullable();

        $table->string('delivery_outcome')->default('Alive');
        // Alive / Stillbirth

        $table->text('notes')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
