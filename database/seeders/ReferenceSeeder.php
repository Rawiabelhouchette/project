<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Commodités hébergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'commodites-hebergement',
        ]);

        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Services',
            'slug_type' => 'hebergement',
            'slug_nom' => 'services',
        ]);

        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Types de lit',
            'slug_type' => 'hebergement',
            'slug_nom' => 'types-de-lit',
        ]);

        // Equipement hébergement
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Equipements hébergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-hebergement',
        ]);

        // Service
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Services',
            'slug_type' => 'hebergement',
            'slug_nom' => 'services',
        ]);

        // Equipement Salle de bain
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Equipements salle de bain',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-salle-de-bain',
        ]);

        // Equipement cuisine
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Equipements cuisine',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-cuisine',
        ]);

    }
}
