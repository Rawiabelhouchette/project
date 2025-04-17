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
        // renommer la valeur "Accessoires de cuisines" en "Accessoires de cuisine"
        DB::statement('update annonce_reference_valeur set titre = "Accessoires de cuisine" where titre = "Accessoires de cuisines"');
        DB::statement('update annonce_reference_valeur set slug = "accessoires-de-cuisine" where slug = "accessoires-de-cuisines"');
        DB::statement('update `references` set slug_nom = "accessoires-de-cuisine" where nom = "Accessoires de cuisines"');
        DB::statement('update `references` set nom = "Accessoires de cuisine" where nom = "Accessoires de cuisines"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // renommer la valeur "Accessoires de cuisine" en "Accessoires de cuisines"
        DB::statement('update annonce_reference_valeur set titre = "Accessoires de cuisines" where titre = "Accessoires de cuisine"');
        DB::statement('update annonce_reference_valeur set slug = "accessoires-de-cuisines" where slug = "accessoires-de-cuisine"');
        DB::statement('update `references` set slug_nom = "accessoires-de-cuisines" where nom = "Accessoires de cuisine"');
        DB::statement('update `references` set nom = "Accessoires de cuisines" where nom = "Accessoires de cuisine"');

    }
};
