<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'duree' => 5,
                'is_active' => true,
                'options' => [
                    'Assistance par mail',
                    '-',
                ],
                'unite_en' => 'day',
                'unite_fr' => 'Jours',
            ],
            [
                'id' => 2,
                'libelle' => 'Offre Trimestriel',
                'slug' => 'offre-trimestriel',
                'description' => 'Offre Trimestriel',
                'prix' => 11000,
                'duree' => 3,
                'is_active' => true,
                'options' => [
                    'Statistiques de consultation',
                    'Assistance par mail/Whatsapp',
                ],
            ],
            [
                'id' => 3,
                'libelle' => 'Offre Semestriel',
                'slug' => 'offre-semestriel',
                'description' => 'Offre Semestriel',
                'prix' => 20000,
                'duree' => 6,
                'is_active' => true,
                'options' => [
                    'Statistiques',
                    'Assistance par mail/Whatsapp',
                ],
            ],
            [
                'id' => 4,
                'libelle' => 'Offre Annuel',
                'slug' => 'offre-annuel',
                'description' => 'Offre Annuel',
                'prix' => 35000,
                'duree' => 12,
                'is_active' => true,
                'options' => [
                    'Statistiques avancées',
                    'Assistance par mail/Whatsapp',
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
