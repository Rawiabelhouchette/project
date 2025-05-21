<?php

namespace App\Livewire\Public;
use App\Models\Auberge;
use App\Models\Hotel;
use Illuminate\Support\Str;
use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Favoris;
use App\Models\LocationMeublee;
use App\Models\Marque;
use App\Models\LocationVehicule;
use App\Models\Modele;
use App\Models\Quartier;
use App\Models\Ville;
use App\Utils\AnnoncesUtils;
use App\Utils\CustomSession;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

/**
 * Composant Livewire pour la recherche d'annonces
 *
 *
 * Cette classe gère la recherche d'annonces avec différents filtres (type, ville, quartier, entreprise)
 * et affiche les résultats avec pagination.
 */
class Search extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // États de base
    public $booted = true;

    public $perPage = 10;

    private $initURL = '';

    // Filtres principaux
    public $type = [];

    public $key = '';

    public $location = '';

    public $ville = [];

    public $quartier = [];

    public $entreprise = [];

    public $marque = [];

    public $boiteVitesse = [];

    public $nombrePersonne = [];

    public $typeVehicule = [];


    // Tri
    public $column = '';

    public $direction = '';

    public $sortOrder = 'created_at|desc'; // Tri par défaut

    // Filtres côté client (facettes)
    public string $typeFilterValue = '';

    public string $villeFilterValue = '';

    public string $quartierFilterValue = '';

    public string $entrepriseFilterValue = '';

    public string $marqueFilterValue = '';

    public string $boiteVitesseFilterValue = "";

    public string $typeVehiculeFilterValue = "";

    public string $nombrePersonneFilterValue = "";

    // Données des facettes
    public $typeAnnonces = [];

    public $villes = [];

    public $quartiers = [];

    public $entreprises = [];

    // Add viewMode property to the existing Search class
    public $viewMode = 'row';

    public $marques = [];

    public $boiteVitesses = [];

    public $nombrePersonnes = [];

    public $typeVehicules = [];

    // Paramètres de l'URL
    protected $queryString = [
        'type',
        'key',
        'location',
        'column',
        'direction',
        'ville',
        'quartier',
        'entreprise',
        'viewMode',
        'marque',
        'boiteVitesse',
        'nombrePersonne',
        'typeVehicule'
    ];

    /**
     * Initialise le composant
     *
     * @param  bool  $hasSessionValue  Indique si les valeurs doivent être récupérées depuis la session
     */
    public function mount($hasSessionValue)
    {
        $this->initializeFromSession($hasSessionValue);
    }

    /**
     * Initialise les valeurs depuis la session si nécessaire
     */
    private function initializeFromSession($hasSessionValue)
    {
        if (!$hasSessionValue) {
            return;
        }

        $session = new CustomSession;
        $this->key = $session->key;
        $this->type = $session->type;
        $this->location = $session->location;
        $this->column = $session->column;
        $this->direction = $session->direction;
        $this->ville = $session->ville;
        $this->marque = $session->marque;
        $this->boiteVitesse = $session->boiteVitesse;
        $this->nombrePersonne = $session->nombrePersonne;
        $this->typeVehicule = $session->typeVehicule;

        $this->quartier = $session->quartier;
        $this->entreprise = $session->entreprise;
        $this->sortOrder = $session->sortOrder;
        // $this->setPage($session->page);
    }

    /**
     * Effectue la recherche d'annonces avec tous les filtres appliqués
     */
    public function search()
    {
        $annonces = Annonce::eagerLoad()->public();

        return $annonces;
    }

    /**
     * Génère la vue du composant
     */
    public function render()
    {
        $annonces = $this->search()->paginate($this->perPage);
        $this->saveVariableToSession();


        return view('livewire.public.search', [
            'annonces' => $annonces,
            // 'facettes' => $this->getFacettes(),
        ]);
    }

    /**
     * Sauvegarde les variables dans la session
     */
    private function saveVariableToSession()
    {
        CustomSession::clear();

        CustomSession::create([
            // 'annonces' => $this->search()->get()->pluck('id')->toArray(),
            'type' => $this->type,
            'key' => $this->key,
            'location' => $this->location,
            'column' => $this->column,
            'direction' => $this->direction,
            'ville' => $this->ville,
            'quartier' => $this->quartier,
            'marque' => $this->marque,
            'boiteVitesse' => $this->boiteVitesse,
            'nombrePersonne' => $this->nombrePersonne,
            'typeVehicule' => $this->typeVehicule,
            'entreprise' => $this->entreprise,
            'sortOrder' => $this->sortOrder,
            // 'page' => $this->search()->paginate($this->perPage)->currentPage(),
        ]);
    }
}
