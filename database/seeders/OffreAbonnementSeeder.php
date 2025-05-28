<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OffreAbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offres = [
            [
                'id' => 1,
                'libelle' => 'Offre découverte',
                'slug' => 'offre-decouverte',
                'description' => 'Offre découverte',
                'prix' => 0,
                'duree' => 0,
                'is_active' => true,
                'options' => [
                    'Assistance par mail',
                    'Assistance par mail / Whatsapp',
                ],
                'unite_en' => 'day',
                'unite_fr' => 'Jour',
                'is_free' => true,
                'expires_at' => date('Y-m-d H:i:s', strtotime('2026-01-01')),
            ],
            [
                'id' => 2,
                'libelle' => 'Offre Trimestrielle',
                'slug' => 'offre-trimestrielle',
                'description' => 'Offre Trimestrielle',
                'prix' => 11000,
                'duree' => 3,
                'is_active' => false,
                'options' => [
                    'Statistiques de consultation',
                    'Assistance par mail / Whatsapp',
                ],
            ],
            [
                'id' => 3,
                'libelle' => 'Offre Semestrielle',
                'slug' => 'offre-semestrielle',
                'description' => 'Offre Semestrielle',
                'prix' => 20000,
                'duree' => 6,
                'is_active' => false,
                'options' => [
                    'Statistiques',
                    'Assistance par mail / Whatsapp',
                ],
            ],
            [
                'id' => 4,
                'libelle' => 'Offre Annuelle',
                'slug' => 'offre-annuelle',
                'description' => 'Offre Annuelle',
                'prix' => 35000,
                'duree' => 12,
                'is_active' => false,
                'options' => [
                    'Statistiques avancées',
                    'Assistance par mail / Whatsapp',
                ],
            ],
        ];

        foreach ($offres as $offre) {
            \App\Models\OffreAbonnement::updateOrCreate(
                ['id' => $offre['id']],
                $offre
            );
        }
    }
}
