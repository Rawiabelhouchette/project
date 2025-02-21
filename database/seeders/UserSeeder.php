<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom' => 'bill',
            'prenom' => 'bill',
            'username' => 'bill',
            'email' => 'bill@bill.com',
            'telephone' => '90 90 90 90',
            'password' => 'bill',
        ])->assignRole('Administrateur');

        User::create([
            'nom' => 'martin',
            'prenom' => 'martin',
            'username' => 'martin',
            'email' => 'martin@numdoc.fr',
            'telephone' => '90 90 90 87',
            'password' => 'martin',
        ])->assignRole('Administrateur');

        $entreprise = \App\Models\Entreprise::create([
            'nom' => 'VAMIYI',
            'slug' => 'vamiyi',
            'email' => 'contact@vamiyi.com',
            'telephone' => '93 67 35 76',
            'whatsapp' => '93 67 35 76',
            'longitude' => '1.2315569747663',
            'latitude' => '6.1443779257375',
        ]);

        $entreprise->heure_ouverture()->create([
            'jour' => 'Tous les jours',
            'heure_debut' => '12:00:00',
            'heure_fin' => '23:59:00',
        ]);

        $abonnements = \App\Models\Abonnement::create([
            'offre_abonnement_id' => 1,
            'date_debut' => now(),
            'date_fin' => now()->addYears(5),
            'montant' => 10000,
            'is_active' => true,
        ]);

        $abonnements->entreprises()->attach($entreprise->id);


    }
}
