<?php

namespace Database\Seeders;

use App\Models\Reference;
use App\Models\User;
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
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Services',
            'slug_type' => 'hebergement',
            'slug_nom' => 'services',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Types de lit',
            'slug_type' => 'hebergement',
            'slug_nom' => 'types-de-lit',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement hébergement
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Equipements hébergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-hebergement',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Service
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Services',
            'slug_type' => 'hebergement',
            'slug_nom' => 'services',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement Salle de bain
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Equipements salle de bain',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-salle-de-bain',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement cuisine
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Equipements cuisine',
            'slug_type' => 'hebergement',
            'slug_nom' => 'equipements-cuisine',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);
    }
}
