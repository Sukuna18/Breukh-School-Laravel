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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Inscriptions::class)->constrained('inscriptions')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\ClasseDiscipline::class)->constrained('classe_disciplines')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AnneeScolaire::class)->constrained('annee_scolaires')->cascadeOnDelete();
            $table->integer('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
