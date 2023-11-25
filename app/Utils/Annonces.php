<?php

namespace App\Utils;

class Annonces
{
    public static function getAnnonceList()
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
        ]);
    }
}
