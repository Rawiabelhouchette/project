<?php

namespace App\Utils;

/**
 * Interface AnnonceInterface
 * @package App\Utils
 * @property string $show_url
 * @property string $edit_url
 */

interface AnnonceInterface {
    public function getShowUrlAttribute() : String;
    public function getEditUrlAttribute() : String;
}
