<?php

namespace App\Utils;

class CustomSession
{
    public $annonces = [];

    public function __construct()
    {
        $this->annonces = session()->get('search_annonces');
    }

    public static function create($data = [])
    {
        if (empty($data)) {
            return new self();
        }
        session(['search_annonces' => $data['annonces'] ?? null]);
        return new self();
    }

    public function save()
    {
        session(['search_annonces' => $this->annonces]);
    }

    public static function clear()
    {
        session()->forget('search_annonces');
    }
}
