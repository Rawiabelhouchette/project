<?php

namespace App\Utils;

class Annonces
{
    public static function getAnnonceList()
    {
        // return collection of objects
        return collect([
            (object) [
                'nom' => 'Auberge', 
                'icon' => 'fas fa-hotel', 
                'route' => 'auberges.create',
                'color' => 'info'
            ],
            // (object) [
            //     'nom' => 'Hôtel', 
            //     'icon' => 'fas fa-hotel', 
            //     'route' => 'admin.annonce.create',
            //     'color' => 'sucess'
            // ],
        ]);
    }
}
