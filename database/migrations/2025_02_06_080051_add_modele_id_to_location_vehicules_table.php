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
        Schema::table('location_vehicules', function (Blueprint $table) {
            $table->dropColumn('marque');
            $table->dropColumn('modele');
            $table->foreignId('modele_id')->nullable()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_vehicules', function (Blueprint $table) {
            $table->dropColumn('modele_id');
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
        });
    }
};
