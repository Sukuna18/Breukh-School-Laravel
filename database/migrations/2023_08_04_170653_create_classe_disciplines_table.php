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
        Schema::create('classe_disciplines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Classes::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Discipline::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Evaluation::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Semestre::class)->constrained()->cascadeOnDelete();

            $table->string('max_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_disciplines');
    }
};
