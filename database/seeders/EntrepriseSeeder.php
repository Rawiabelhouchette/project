<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entreprise = \App\Models\Entreprise::create([
            'nom' => 'VAMIYI',
            'slug' => 'vamiyi',
            'email' => 'contact@vamiyi.com',
            'telephone' => '+228 93 67 35 76',
            'whatsapp' => '+228 93 67 35 76',
            'longitude' => '1.2315569747663',
            'latitude' => '6.1443779257375',
            'ville_id' => 1,
            'quartier' => 'Adidogomé',
        ]);

        $entreprise->heure_ouverture()->create([
            'jour' => 'Tous les jours',
            'heure_debut' => '12:00:00',
            'heure_fin' => '23:59:00',
        ]);

        $user = User::find(1);

        $user->entreprises()->attach([
            $entreprise->id => [
                'is_admin' => true,
                'is_active' => true,
                'date_debut' => now(),
                'date_fin' => null, // ou une date si tu veux
            ],
        ]);

        $user = User::find(2);

        $user->entreprises()->attach([
            $entreprise->id => [
                'is_admin' => false,
                'is_active' => true,
                'date_debut' => now(),
                'date_fin' => null, // ou une date si tu veux
            ],
        ]);

        $abonnement = \App\Models\Abonnement::create([
            'offre_abonnement_id' => 1,
            'date_debut' => now(),
            'date_fin' => now()->addYears(5),
            'montant' => 10000,
            'is_active' => true,
        ]);

        $entreprise->abonnements()->attach($abonnement->id);
    }
}
