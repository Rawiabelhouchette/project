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
        Schema::table('offre_abonnements', function (Blueprint $table) {
            $table->enum('unite_en', ['day', 'week', 'month', 'year'])->default('month');
            $table->enum('unite_fr', ['Jour', 'Semaine', 'Mois', 'Annee'])->default('Mois');
            $table->boolean('is_free')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offre_abonnements', function (Blueprint $table) {
            $table->dropColumn('unite_en');
            $table->dropColumn('unite_fr');
            $table->dropColumn('is_free');
        });
    }
};
