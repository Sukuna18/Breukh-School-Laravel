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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 50)->unique();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->foreignId('niveaux_id')->constrained('niveaux')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['niveau_id']);
        });
    }
};
