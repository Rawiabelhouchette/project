<?php

namespace Database\Seeders;

use App\Models\Reference;
use App\Models\ReferenceValeur;
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

        // Type hebergement
        Reference::updateOrCreate([
            'type' => 'hebergement',
            'nom' => 'Types hebergement',
            'slug_type' => 'hebergement',
            'slug_nom' => 'types-hebergement',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement véhicule
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Types de véhicule',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'types-de-vehicule',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Equipement véhicule
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Equipements véhicule',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'equipements-vehicule',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // // Carte de consommation
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Carte de consommation',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'carte-de-consommation',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // Boite de vitesse
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Boite de vitesses',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'boite-de-vitesses',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Conditions de location
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Conditions de location',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'conditions-de-location',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // Marque de véhicule
        Reference::updateOrCreate([
            'type' => 'Marque',
            'nom' => 'Marques de véhicule',
            'slug_type' => 'marque',
            'slug_nom' => 'marques-de-vehicule',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // // Commodités entreprise
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Commodités entreprise',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'commodites-entreprise',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // // Equipement restauration
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Equipements restauration',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'equipements-restauration',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // // Equipement vie nocturne
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Equipements vie nocturne',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'equipements-vie-nocturne',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // // Marque
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Marques',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'marques',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // // Spécialité
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Spécialités',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'specialites',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // Type de carburant
        Reference::updateOrCreate([
            'type' => 'Location de véhicule',
            'nom' => 'Types de carburant',
            'slug_type' => 'location-de-vehicule',
            'slug_nom' => 'types-de-carburant',
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);

        // // Type de gâteau
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Types de gâteau',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'types-de-gateau',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);

        // // Type de véhicule
        // Reference::updateOrCreate([
        //     'type' => 'hebergement',
        //     'nom' => 'Types de véhicule',
        //     'slug_type' => 'hebergement',
        //     'slug_nom' => 'types-de-vehicule',
        //     'created_by' => User::first()->id,
        //     'updated_by' => User::first()->id,
        // ]);
    }

    public function addData() 
    {

    }
}
