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
        Schema::create('programme_electeur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id')->constrained();
            $table->foreignId('electeur_id')->constrained();
            $table->enum('action', ['like', 'dislike']); // Utilisation d'une colonne enum pour les actions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_electeur');
    }
};
