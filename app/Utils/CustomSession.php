<?php

namespace App\Utils;

class CustomSession
{
    public $annonces = [];

    public $type = '';

    public $key = '';

    public $location = '';

    public $column = '';

    public $direction = '';

    public $ville = '';

    public $quartier = '';

    public $entreprise = '';

    public $sortOrder = '';

    public $marque = '';

    public $boiteVitesse = '';

    public $nombrePersonne = '';

    public $typeVehicule = '';

    public $page;

    public function __construct()
    {
        $this->annonces = session()->get('search_annonces');
        $this->type = session()->get('type');
        $this->key = session()->get('key');
        $this->location = session()->get('location');
        $this->column = session()->get('column');
        $this->direction = session()->get('direction');
        $this->ville = session()->get('ville');
        $this->quartier = session()->get('quartier');
        $this->entreprise = session()->get('entreprise');
        $this->marque = session()->get('marque');
        $this->boiteVitesse = session()->get('boiteVitesse');
        $this->typeVehicule = session()->get('typeVehicule');

        $this->nombrePersonne = session()->get('nombrePersonne');

        $this->sortOrder = session()->get('sortOrder');
        $this->page = session()->get('page');
    }

    public static function create($data = [])
    {
        if (empty($data)) {
            return new self;
        }
        session([
            'search_annonces' => $data['annonces'] ?? null,
            'type' => $data['type'] ?? null,
            'key' => $data['key'] ?? null,
            'location' => $data['location'] ?? null,
            'column' => $data['column'] ?? null,
            'direction' => $data['direction'] ?? null,
            'ville' => $data['ville'] ?? null,
            'quartier' => $data['quartier'] ?? null,
            'entreprise' => $data['entreprise'] ?? null,
            'marque' => $data['marque'] ?? null,
            'boiteVitesse' => $data['boiteVitesse'] ?? null,
            'nombrePersonne' => $data['nombrePersonne'] ?? null,
            'typeVehicule' => $data['typeVehicule'] ?? null,

            'sortOrder' => $data['sortOrder'] ?? null,
            'page' => $data['page'] ?? null,
        ]);

        return new self;
    }

    public function save()
    {
        session(['search_annonces' => $this->annonces]);
    }

    public static function clear()
    {
        session()->forget('search_annonces');
        session()->forget('type');
        session()->forget('key');
        session()->forget('location');
        session()->forget('column');
        session()->forget('direction');
        session()->forget('ville');
        session()->forget('quartier');
        session()->forget('marque');
        session()->forget('boiteVitesse');
        session()->forget('nombrePersonne');
        session()->forget('typeVehicule');

        session()->forget('entreprise');
        session()->forget('sortOrder');
        session()->forget('page');
        session()->forget('se_loger');
        session()->forget('se_restaurer');
        session()->forget('sortir');
        session()->forget('louer_voiture');
    }

    public static function forget($key)
    {
        session()->forget($key);
    }

    public static function reset()
    {
        // self::create([
        //     'annonces' => [],
        //     'type' => [],
        //     'key' => '',
        //     'location' => '',
        //     'column' => '',
        //     'direction' => '',
        //     'ville' => [],
        //     'quartier' => [],
        //     'entreprise' => [],
        //     'sortOrder' => '',
        //     'page' => 1,

        // ]);
        self::clear();
    }
}
