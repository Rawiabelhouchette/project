<?php

use App\Models\Reference;
use App\Models\ReferenceValeur;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $references = Reference::whereBetween('id', [16, 17])->get();

        foreach ($references as $reference) {
            ReferenceValeur::where('reference_id', $reference->id)->delete();
            $reference->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
