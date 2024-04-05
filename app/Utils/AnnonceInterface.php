<?php

namespace App\Utils;

/**
 * Interface AnnonceInterface
 * @package App\Utils
 * @property string $show_url
 * @property string $edit_url
 * @property array $caracteristiques
 */

interface AnnonceInterface
{
    public function getShowUrlAttribute(): string;
    public function getEditUrlAttribute(): string;
    public function getCaracteristiquesAttribute(): array;

    // public function getInformationsAttribute(): array;
    // public function getEquipementsAttribute(): array;
}
