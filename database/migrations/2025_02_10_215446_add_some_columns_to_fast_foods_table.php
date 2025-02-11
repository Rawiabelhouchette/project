<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fast_foods', function (Blueprint $table) {
            $table->string('nom_produit')->nullable();
            $table->string('accompagnement_produit')->nullable();
            $table->double('prix_produit')->nullable();
            $table->string('image_produit')->nullable();

            // remove prix min and max
            $table->dropColumn('prix_min');
            $table->dropColumn('prix_max');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fast_foods', function (Blueprint $table) {
            $table->dropColumn('nom_produit');
            $table->dropColumn('accompagnement_produit');
            $table->dropColumn('prix_produit');
            $table->dropColumn('image_produit');

            $table->integer('prix_min')->nullable();
            $table->integer('prix_max')->nullable();
        });
    }
};
