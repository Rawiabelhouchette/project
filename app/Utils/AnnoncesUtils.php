<?php

namespace App\Utils;

use App\Models\Annonce;
use App\Models\Fichier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class AnnoncesUtils
{
    public static function getAnnonceList(): object
    {
        return collect([
            (object) [
                'nom' => 'Auberge',
                'icon' => 'fas fa-hotel',
                'route' => 'auberges.create',
                'color' => 'info'
            ],
            (object) [
                'nom' => 'Hôtel',
                'icon' => 'fas fa-hotel',
                'route' => 'hotels.create',
                'color' => 'sucess'
            ],
            (object) [
                'nom' => 'Location de véhicule',
                'icon' => 'fas fa-car',
                'route' => 'location-vehicules.create',
                'color' => 'warning'
            ],
            (object) [
                'nom' => 'Location meublée',
                'icon' => 'fas fa-home',
                'route' => 'location-meublees.create',
                'color' => 'info'
            ],
            (object) [
                'nom' => 'Boite de nuit',
                'icon' => 'fas fa-glass-cheers',
                'route' => 'boite-de-nuits.create',
                'color' => 'danger'
            ],
            (object) [
                'nom' => 'Fast-food',
                'icon' => 'fas fa-utensils',
                'route' => 'fast-foods.create',
                'color' => 'info'
            ],
            (object) [
                'nom' => 'Restaurant',
                'icon' => 'fas fa-burger',
                'route' => 'restaurants.create',
                'color' => 'sucess'
            ],
            (object) [
                'nom' => 'Patisserie',
                'icon' => 'fas fa-birthday-cake',
                'route' => 'patisseries.create',
                'color' => 'warning'
            ],
            (object) [
                'nom' => 'Bar & Rooftop',
                'icon' => 'fas fa-glass-martini-alt',
                'route' => 'bars.create',
                'color' => 'info'
            ]
        ]);
    }

    public static function getPublicAnnonceList(): object
    {
        return collect([
            (object) [
                'nom' => 'Auberge',
                'icon' => 'fa fa-hotel',
                'route' => '',
                'color' => 'cl-info',
                'bg' => 'a'
            ],
            (object) [
                'nom' => 'Hôtel',
                'icon' => 'fa fa-hotel',
                'route' => '',
                'color' => 'cl-success',
                'bg' => 'h'
            ],
            (object) [
                'nom' => 'Véhicule',
                // 'nom' => 'Location de véhicule',
                'icon' => 'fa fa-car',
                'route' => '',
                'color' => 'cl-warning',
                'bg' => 'v'
            ],
            (object) [
                'nom' => 'Meuble',
                // 'nom' => 'Location meublée',
                'icon' => 'fa fa-home',
                'route' => '',
                'color' => 'cl-info',
                'bg' => 'm'
            ],
            (object) [
                'nom' => 'Boite de nuit',
                'icon' => 'fas fa-glass-cheers',
                'route' => '',
                'color' => 'cl-danger',
                'bg' => 'b'
            ],
        ]);
    }
    

    public static function createReference($model, $variable, $title, $slug): void
    {
        if ($variable) {
            foreach ($variable as $value) {
                $model->references()->attach(
                    $value,
                    [
                        'titre' => $title,
                        'slug' => $slug,
                    ]
                );
            }
        }
    }

    public static function updateReference($model, $variable, $title, $slug): void
    {
        $model->removeReferences($slug);
        foreach ($variable as $value) {
            $model->references()->attach(
                $value,
                [
                    'titre' => $title,
                    'slug' => $slug,
                ]
            );
        }
    }

    public static function createManyReference($model, $references)
    {
        if (!$references) return;

        try {
            for ($i = 0; $i < count($references); $i++) {
                AnnoncesUtils::createReference($model, $references[$i][1], $references[$i][0], Str::slug($references[$i][0]));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public static function updateManyReference($model, $references)
    {
        if (!$references) return;

        try {
            for ($i = 0; $i < count($references); $i++) {
                AnnoncesUtils::updateReference($model, $references[$i][1], $references[$i][0], Str::slug($references[$i][0]));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public static function createGalerie($model, $image, $variable, $folder_name): void
    {
        if($image){
            $image->store('public/' . $folder_name);
            $fichier = Fichier::create([
                'nom' => $image->hashName(),
                'chemin' => $folder_name . '/' . $image->hashName(),
                'extension' => $image->extension(),
            ]);

            $model->image = $fichier->id;
            $model->save();
        }

        if ($variable) {
            foreach ($variable as $image) {
                $image->store('public/' . $folder_name);
                $fichier = Fichier::create([
                    'nom' => $image->hashName(),
                    'chemin' => $folder_name . '/' . $image->hashName(),
                    'extension' => $image->extension(),
                ]);

                $model->galerie()->attach($fichier->id);
            }
        }
    }

    public static function updateGalerie($image, $model, $variable, $folder_name): void
    {
        if($image){
            $image->store('public/' . $folder_name);
            $fichier = Fichier::create([
                'nom' => $image->hashName(),
                'chemin' => $folder_name . '/' . $image->hashName(),
                'extension' => $image->extension(),
            ]);

            $model->image = $fichier->id;
            $model->save();
        }

        if ($variable) {
            $model->removeGalerie();
            foreach ($variable as $image) {
                $image->store('public/' . $folder_name);
                $fichier = Fichier::create([
                    'nom' => $image->hashName(),
                    'chemin' => $folder_name . '/' . $image->hashName(),
                    'extension' => $image->extension(),
                ]);

                $model->galerie()->attach($fichier->id);
            }
        }
    }
}
