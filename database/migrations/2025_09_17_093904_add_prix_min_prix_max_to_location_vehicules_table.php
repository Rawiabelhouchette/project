<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrixMinPrixMaxToLocationVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('location_vehicules', function (Blueprint $table) {
            $table->unsignedBigInteger('prix_min')->default(0)->after('nombre_places');
            $table->unsignedBigInteger('prix_max')->nullable()->after('prix_min');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_vehicules', function (Blueprint $table) {
            $table->dropColumn(['prix_min', 'prix_max']);
        });
    }
}
