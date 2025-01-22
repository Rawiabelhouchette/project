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
        Schema::table('annonces', function (Blueprint $table) {
            // add column quartier_id containing the id of the quartier and nullable
            $table->foreignId('quartier_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('ville_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            //
            $table->dropForeign(['quartier_id']);
            $table->dropColumn('quartier_id');

            $table->dropForeign(['ville_id']);
            $table->dropColumn('ville_id');
        });
    }
};
