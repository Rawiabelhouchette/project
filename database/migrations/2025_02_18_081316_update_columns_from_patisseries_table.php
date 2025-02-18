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
        Schema::table('patisseries', function (Blueprint $table) {
            $table->string('nom_produit')->nullable();
            $table->string('accompagnement_produit')->nullable();
            $table->string('prix_produit')->nullable();
            $table->string('image_produit')->nullable();

            $table->dropColumn('ingredients');
            $table->dropColumn('accompagnement');
            $table->dropColumn('prix_min');
            $table->dropColumn('prix_max');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patisseries', function (Blueprint $table) {
            $table->dropColumn('nom_produit');
            $table->dropColumn('accompagnement_produit');
            $table->dropColumn('prix_produit');
            $table->dropColumn('image_produit');

            $table->string('ingredients')->nullable();
            $table->string('accompagnement')->nullable();
            $table->string('prix_min')->nullable();
            $table->string('prix_max')->nullable();
        });
    }
};
