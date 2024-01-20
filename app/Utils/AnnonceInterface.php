<?php

namespace App\Utils;

/**
 * Interface AnnonceInterface
 * @package App\Utils
 * @property string $show_url
 * @property string $edit_url
 * @property array $caracteristiques
 */

interface AnnonceInterface {
    public function getShowUrlAttribute() : String;
    public function getEditUrlAttribute() : String;
    public function getCaracteristiquesAttribute() : Array;
}
