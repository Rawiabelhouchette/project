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
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropForeign(['quartier_id']);
            $table->dropColumn('quartier_id');
            $table->foreignId('ville_id')->default(1)->constrained();
            $table->string('quartier')->default('Test');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            // $table->dropColumn('quartier');
            // $table->foreignId('quartier_id')->nullable()->constrained();
        });
    }
};
