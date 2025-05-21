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
        $this->loadNavLinks();
        $this->normalizeInputs();
        $this->loadAllFilters();
        $this->processLocation();
        $this->buildInitialUrl();
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
     * Normalise les entrées des filtres
     */
    private function normalizeInputs()
    {
        if (is_string($this->type)) {
            $this->type = [$this->type];
        }

        $this->changeTypeName();

        $this->type = array_filter($this->type ?? []);
        $this->ville = array_filter($this->ville ?? []);
        $this->marque = array_filter($this->marque ?? []);
        $this->boiteVitesse = array_filter($this->boiteVitesse ?? []);
        $this->nombrePersonne = array_filter($this->nombrePersonne ?? []);
        $this->typeVehicule = array_filter($this->typeVehicule ?? []);

        $this->quartier = array_filter($this->quartier ?? []);
        $this->entreprise = array_filter($this->entreprise ?? []);
    }

    /**
     * Charge tous les filtres disponibles
     */
    private function loadAllFilters()
    {
        $this->getAllEntreprises();
        $this->getVillesParType();
        $this->getQuartiersParVilles();
        $this->getMarques();
        $this->getBoiteVitesse();

        $this->getTypeVehicule();
    }

    /**
     * Traite la localisation si elle est fournie
     */
    private function processLocation()
    {
        if (!$this->location) {
            return;
        }

        $tmp = explode(',', $this->location);
        if (count($tmp) == 3) {
            // pattern : quartier, ville, Pays
            $villesValues = array_column($this->villes, 'value');
            $quartiersValues = array_column($this->quartiers, 'value');

            if (in_array(trim($tmp[1]), $villesValues)) {
                $this->ville[] = trim($tmp[1]);
            }

            if (in_array(trim($tmp[0]), $quartiersValues)) {
                $this->quartier[] = trim($tmp[0]);
            }
        }
        $this->location = '';
    }

    /**
     * Construit l'URL initiale avec les paramètres de filtres
     */
    private function buildInitialUrl()
    {
        $url = url()->current();
        $properties = ['type', 'ville', 'quartier', 'marque', 'boiteVitesse', 'nombrePersonne', 'typeVehicule'];
        $hasFirst = false;

        if ($this->key) {
            $url .= $hasFirst ? '&' : '?';
            $url .= 'key=' . $this->key;
            $hasFirst = true;
        }

        foreach ($properties as $property) {
            if ($this->$property) {
                foreach ($this->$property as $key => $value) {
                    $url .= $hasFirst ? '&' : '?';
                    $url .= $property . '[' . $key . ']=' . $value;
                    $hasFirst = true;
                }
            }
        }

        $url = str_replace(' ', '+', $url);
        $this->initURL = trim($url);
    }

    /**
     * Change le nom de certains types d'annonces
     */
    public function changeTypeName()
    {
        if (!$this->type) {
            $this->type = [];
        }

        // Change "Véhicule" to "Location de véhicule"
        if (in_array('Véhicule', $this->type)) {
            $key = array_search('Véhicule', $this->type);
            $this->type[$key] = 'Location de véhicule';
        }
    }

    /**
     * Met à jour le tri lorsque sortOrder change
     */
    public function updatedSortOrder()
    {
        if (!$this->sortOrder) {
            return;
        }

        $parts = explode('|', $this->sortOrder);

        if (count($parts) === 2) {
            [$this->column, $this->direction] = $parts;
            $this->resetPage();
        }
    }

    /**
     * Change l'état d'un filtre de recherche
     *
     * @param  string  $value  Valeur du filtre
     * @param  string  $category  Catégorie du filtre (type, ville, quartier, entreprise)
     * @param  bool  $remove  Indique si la valeur doit être supprimée
     * @return void
     */
    public function changeState($value, $category, $remove = false)
    {
        $this->booted = false;

        // Cas spécial pour la clé de recherche
        if ($category === 'key' && $remove) {
            $this->resetSearchKey();

            return;
        }

        // Vérifier si la catégorie est valide
        $validCategories = ['type', 'ville', 'quartier', 'entreprise', 'marque', 'boiteVitesse', 'nombrePersonne', 'typeVehicule'];
        if (!in_array($category, $validCategories)) {
            return;
        }

        // Ajouter ou supprimer la valeur du filtre
        $this->updateFilterValue($value, $category, $remove);

        // Mettre à jour les filtres dépendants
        $this->updateDependentFilters($category);

        // Rafraîchir l'affichage et réinitialiser la pagination
        $this->dispatch('$refresh');
        $this->resetPage();
    }

    /**
     * Réinitialise la clé de recherche
     */
    private function resetSearchKey()
    {
        $this->key = '';
        $this->dispatch('resetSearchKey');
    }

    /**
     * Met à jour la valeur d'un filtre
     */
    private function updateFilterValue($value, $category, $remove)
    {
        if ($remove || in_array($value, $this->$category)) {
            // Suppression de la valeur
            $this->$category = array_diff($this->$category, [$value]);
        } else {
            // Ajout de la valeur
            array_push($this->$category, $value);
        }
    }

    /**
     * Met à jour les filtres dépendants
     */
    private function updateDependentFilters($category)
    {
        if ($category === 'type') {
            $this->getVillesParType();
        } elseif ($category === 'ville') {
            $this->getQuartiersParVilles();
        }
    }

    /**
     * Récupère tous les quartiers depuis la base de données
     */
    private function getAllQuartiers(): void
    {
        $this->quartiers = [];
        foreach (Quartier::all() as $quartier) {
            $tmp = ['value' => $quartier->nom, 'count' => $quartier->nombre_annonce];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->quartiers)) {
                $this->quartiers[] = $tmp;
            }
        }
    }

    /**
     * Récupère toutes les villes depuis la base de données
     */
    private function getAllVilles(): void
    {
        $this->villes = [];
        foreach (Ville::all() as $ville) {
            $tmp = ['value' => $ville->nom, 'count' => $ville->nombre_annonce];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->villes)) {
                $this->villes[] = $tmp;
            }
        }
    }



    /**
     * Récupère toutes les entreprises qui ont des annonces publiques
     */
    public function getAllEntreprises()
    {
        $this->entreprises = [];
        // Entreprises qui ont au moins un abonnement actif
        $entreprises = Entreprise::with('annonces')
            ->whereHas('annonces', function ($query) {
                $query->public();
            })->get();
        foreach ($entreprises as $entreprise) {
            $tmp = ['value' => $entreprise->nom, 'count' => $entreprise->nombre_annonces];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->entreprises)) {
                $this->entreprises[] = $tmp;
            }
        }
    }


    /**
     * Récupère les boite vitesse
     */

    public function getBoiteVitesse()
    {
        $this->boiteVitesses = [];
        $this->boiteVitesses = LocationVehicule::select('boite_vitesse')
            ->join('annonces', function ($join) {
                $join->on('location_vehicules.id', '=', 'annonces.annonceable_id')
                    ->where('annonces.annonceable_type', '=', LocationVehicule::class);
            })
            ->groupBy('boite_vitesse')
            ->selectRaw('boite_vitesse, COUNT(annonces.id) as annonces_count')
            ->get()
            ->map(function ($row) {
                return [
                    'value' => $row->boite_vitesse,
                    'count' => $row->annonces_count,
                ];
            });
    }


    /**
     * Récupère les nombre personne
     */

    public function getNombrePersonne()
    {
        $this->nombrePersonnes = [];
        $hasLocation = in_array('Location meublée', $this->type);
        $hasAuberge = in_array('Auberge', $this->type);
        $hasHotel = in_array('Hôtel', $this->type);

        if ($hasLocation && !$hasAuberge && !$hasHotel) {
            $this->nombrePersonnes = $this->getNombrePersonnesFrom(LocationMeublee::class, 'location_meublees');

        } elseif ($hasAuberge && !$hasLocation && !$hasHotel) {
            $this->nombrePersonnes = $this->getNombrePersonnesFrom(Auberge::class, 'auberges');

        } elseif ($hasHotel && !$hasLocation && !$hasAuberge) {
            $this->nombrePersonnes = $this->getNombrePersonnesFrom(Hotel::class, 'hotels');

        } else {
            // Any combination of two or more types
            $merged = collect();

            $all = collect();

            if ($hasLocation) {
                $all = $all->concat($this->getNombrePersonnesFrom(LocationMeublee::class, 'location_meublees'));
            }
            if ($hasAuberge) {
                $all = $all->concat($this->getNombrePersonnesFrom(Auberge::class, 'auberges'));
            }
            if ($hasHotel) {
                $all = $all->concat($this->getNombrePersonnesFrom(Hotel::class, 'hotels'));
            }

            foreach ($all as $item) {
                $existing = $merged->firstWhere('value', $item['value']);
                if ($existing) {
                    $merged = $merged->map(function ($el) use ($item) {
                        if ($el['value'] === $item['value']) {
                            $el['count'] += $item['count'];
                        }
                        return $el;
                    });
                } else {
                    $merged->push($item);
                }
            }

            $this->nombrePersonnes = $merged;
        }
    }



    /**
     * Get nombre_personne and count from a specific model
     */
    private function getNombrePersonnesFrom($modelClass, $tableName)
    {
        return $modelClass::selectRaw("$tableName.nombre_personne, COUNT(annonces.id) as annonces_count")
            ->join('annonces', function ($join) use ($modelClass, $tableName) {
                $join->on("$tableName.id", '=', 'annonces.annonceable_id')
                    ->where('annonces.annonceable_type', '=', $modelClass);
            })
            ->groupBy("$tableName.nombre_personne")
            ->get()
            ->map(function ($row) {
                return [
                    'value' => $row->nombre_personne,
                    'count' => $row->annonces_count,
                ];
            });
    }


    /**
     * Récupère les marques
     */

    public function getMarques()
    {
        $this->marques = [];
        $this->marques = Marque::withCount([
            'modeles as annonces_count' => function ($query) {
                $query->join('location_vehicules', 'modeles.id', '=', 'location_vehicules.modele_id')
                    ->join('annonces', function ($join) {
                        $join->on('location_vehicules.id', '=', 'annonces.annonceable_id')
                            ->where('annonces.annonceable_type', '=', \App\Models\LocationVehicule::class);
                    })
                    ->selectRaw('count(annonces.id)');
            }
        ])->get()->map(function ($marque) {
            return [
                'value' => $marque->nom,
                'count' => $marque->annonces_count,
            ];
        });

    }

    /**
     * Récupère les type vehicule
     */

    public function getTypeVehicule()
    {
        $this->typeVehicules = [];
        $this->typeVehicules = Modele::withCount([
            'locationVehicules as annonces_count' => function ($query) {
                $query->join('annonces', function ($join) {
                    $join->on('location_vehicules.id', '=', 'annonces.annonceable_id')
                        ->where('annonces.annonceable_type', '=', \App\Models\LocationVehicule::class);
                })->selectRaw('count(annonces.id)');
            }
        ])->get()->map(function ($modele) {
            return [
                'value' => $modele->nom,
                'count' => $modele->annonces_count,
            ];
        });



    }





    /**
     * Récupère les quartiers en fonction des villes sélectionnées
     */
    protected function getQuartiersParVilles()
    {
        if (count($this->ville) > 0) {
            // Requête optimisée pour récupérer les noms et nombres de quartiers
            $quartierData = Annonce::public()
                ->select('entreprises.quartier as nom')
                ->selectRaw('COUNT(DISTINCT annonces.id) as count')
                ->join('entreprises', 'annonces.entreprise_id', '=', 'entreprises.id')
                ->join('villes', 'entreprises.ville_id', '=', 'villes.id')
                ->whereIn('villes.nom', $this->ville)
                ->whereNotNull('entreprises.quartier')
                ->groupBy('entreprises.quartier')
                ->get()
                ->map(function ($item) {
                    return [
                        'value' => $item->nom,
                        'count' => $item->count,
                    ];
                })
                ->toArray();
            // $ville = $this->ville;

            // $quartierData = Quartier::whereHas('ville', function ($query) use ($ville) {
            //     $query->whereIn('nom', (array) $ville);
            // })
            //     ->get()
            //     ->map(function ($quartier) {
            //         return [
            //             'value' => $quartier->nom,
            //             'count' => $quartier->count,
            //         ];
            //     })
            //     ->toArray();


            $this->quartiers = $quartierData;
        } else {
            $this->getAllQuartiers();
        }

        // Extrait les valeurs des quartiers pour le filtrage
        $quartiersValues = array_column($this->quartiers, 'value');

        // Ne garde que les quartiers sélectionnés qui existent dans les disponibles
        $this->quartier = array_intersect($this->quartier, $quartiersValues);
    }

    /**
     * Récupère les villes en fonction des types sélectionnés
     */
    protected function getVillesParType()
    {
        $this->getAllVilles();
        // Méthode simplifiée pour l'instant, pourrait être améliorée pour filtrer les villes par type
    }

    /**
     * Ajoute ou supprime une annonce des favoris de l'utilisateur
     */
    public function updateFavoris($annonceId)
    {
        $favorite = Favoris::where('annonce_id', $annonceId)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            Favoris::create([
                'annonce_id' => $annonceId,
                'user_id' => auth()->user()->id,
            ]);
        }
    }

    /**
     * Effectue la recherche d'annonces avec tous les filtres appliqués
     */
    public function search()
    {
        $annonces = Annonce::eagerLoad()->public();
        $annonces = $this->filters($annonces);

        return $annonces;
    }

    /**
     * Réinitialise tous les filtres
     */
    public function resetFilters()
    {
        $this->key = '';
        $this->type = [];
        $this->location = '';
        $this->ville = [];
        $this->quartier = [];
        $this->entreprise = [];
        $this->marque = [];
        $this->boiteVitesse = [];
        $this->typeVehicule = [];
        $this->nombrePersonne = [];
        $this->column = '';
        $this->direction = '';
        $this->sortOrder = 'created_at|desc';
        $this->reset('typeFilterValue', 'villeFilterValue', 'quartierFilterValue', 'entrepriseFilterValue', 'ville', 'marqueFilterValue', 'boiteVitesseFilterValue', 'nombrePersonneFilterValue', 'typeVehiculeFilterValue');
        $this->dispatch('resetSearchBox');
    }

    /**
     * Applique tous les filtres dans un ordre défini
     */
    protected function filters($annonces)
    {
        $this->getNombrePersonne();
        $filters = [
            'filterByEntreprise',
            'filterByVille',
            'filterByQuartier',
            'filterAnnoncesByTypeKeyLocation',
            'filterByOrder',
            'filterByMarque',
            'filterByBoiteVitesse',
            'filterByNombrePersonne',
            'filterByTypeVehicule',


        ];

        foreach ($filters as $filter) {
            $annonces = $this->$filter($annonces);
        }

        return $annonces;
    }

    /**
     * Filtre les annonces par type, clé et localisation
     */
    protected function filterAnnoncesByTypeKeyLocation($annonces)
    {
        if ($this->type) {
            $annonces = $annonces->where(function ($query) {
                foreach ($this->type as $type) {
                    $query->orWhere('type', 'like', '%' . $type . '%');
                }
            });
        }

        if ($this->key) {
            $key = $this->key;
            $annonces = $annonces->where(function ($query) use ($key) {
                $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($key) . '%'])
                    ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($key) . '%']);
            });
        }

        if ($this->location) {
            $parts = explode(',', $this->location);

            if (count($parts) > 0) {
                $quartier = trim($parts[0]);
                $annonces = $annonces->whereHas('entreprise.quartier', function ($query) use ($quartier) {
                    $query->where('nom', 'like', '%' . $quartier . '%');
                });
            }
        }

        return $annonces;
    }

    /**
     * Filtre les annonces par ville
     */
    protected function filterByVille($annonces)
    {
        $this->location = '';

        if ($this->ville) {
            $villes = $this->ville;
            $annonces = $annonces->whereHas('entreprise.ville', function ($query) use ($villes) {
                $query->where(function ($query) use ($villes) {
                    foreach ($villes as $ville) {
                        $query->orWhere('nom', 'like', '%' . $ville . '%');
                    }
                });
            });
        }

        return $annonces;
    }

    /**
     * Filtre les annonces par entreprise
     */
    public function filterByEntreprise($annonces)
    {
        if ($this->entreprise) {
            $entreprises = $this->entreprise;
            $annonces = $annonces->whereHas('entreprise', function ($query) use ($entreprises) {
                $query->whereIn('nom', $entreprises);
            });
        }

        return $annonces;
    }

    /**
     * Filtre les annonces par quartier
     */
    protected function filterByQuartier($annonces)
    {
        $this->location = '';

        if ($this->quartier) {
            $quartiers = $this->quartier;
            $annonces = $annonces->where(function ($query) use ($quartiers) {
                foreach ($quartiers as $quartier) {
                    $query->orWhere('quartier', 'like', '%' . $quartier . '%');
                }
            });

        }

        return $annonces;
    }

    /**
     * Filtre les annonces par marque
     */
    protected function filterByMarque($annonces)
    {


        if ($this->marque) {
            $marques = $this->marque;


            $annonces = $annonces->where('annonces.annonceable_type', '=', \App\Models\LocationVehicule::class)
                ->whereHas('annonceable', function ($query) use ($marques) {
                    // Apply 'model.marque' filter only if the annonceable is of type LocationVehicule
                    if ($query->getModel() instanceof \App\Models\LocationVehicule) {
                        $query->whereHas('modele.marque', function ($query) use ($marques) {
                            $query->whereIn('nom', $marques);  // Filtering by marque names
                        });
                    }
                });


        }

        return $annonces;
    }

    /**
     * Filtre les annonces par type vehicule
     */
    protected function filterByTypeVehicule($annonces)
    {


        if ($this->typeVehicule) {
            $modeles = $this->typeVehicule;

            $annonces = $annonces->where('annonces.annonceable_type', LocationVehicule::class)
                ->whereHas('annonceable', function ($query) use ($modeles) {
                    // Apply 'modele' filter only if the annonceable is of type LocationVehicule
                    if ($query->getModel() instanceof LocationVehicule) {
                        $query->whereHas('modele', function ($query) use ($modeles) {
                            $query->whereIn('nom', $modeles); // Filtering by modele names (typeVehicule)
                        });
                    }
                });


        }

        return $annonces;
    }



    /**
     * Filtre les annonces par marque
     */
    protected function filterByBoiteVitesse($annonces)
    {


        if ($this->boiteVitesse) {
            $boiteVitesseList = $this->boiteVitesse;


            $annonces = $annonces->where('annonces.annonceable_type', LocationVehicule::class)
                ->whereHas('annonceable', function ($query) use ($boiteVitesseList) {
                    if ($query->getModel() instanceof LocationVehicule) {
                        $query->whereIn('boite_vitesse', $boiteVitesseList);
                    }
                });


        }

        return $annonces;
    }

    /**
     * Filtre les annonces par nombre personne
     */
    protected function filterByNombrePersonne($annonces)
    {
        if (!empty($this->nombrePersonne)) {
            $nombrePersonneList = $this->nombrePersonne;

            $annonces = $annonces->where(function ($query) use ($nombrePersonneList) {
                $query->where(function ($subQuery) use ($nombrePersonneList) {
                    $subQuery->where('annonces.annonceable_type', LocationMeublee::class)
                        ->whereHasMorph(
                            'annonceable',
                            [LocationMeublee::class],
                            function ($q) use ($nombrePersonneList) {
                                $q->whereIn('nombre_personne', $nombrePersonneList);
                            }
                        );
                })->orWhere(function ($subQuery) use ($nombrePersonneList) {
                    $subQuery->where('annonces.annonceable_type', Auberge::class)
                        ->whereHasMorph(
                            'annonceable',
                            [Auberge::class],
                            function ($q) use ($nombrePersonneList) {
                                $q->whereIn('nombre_personne', $nombrePersonneList);
                            }
                        );
                })->orWhere(function ($subQuery) use ($nombrePersonneList) {
                    $subQuery->where('annonces.annonceable_type', Hotel::class)
                        ->whereHasMorph(
                            'annonceable',
                            [Hotel::class],
                            function ($q) use ($nombrePersonneList) {
                                $q->whereIn('nombre_personne', $nombrePersonneList);
                            }
                        );
                });
            });
        }

        return $annonces;
    }






    /**
     * Applique le tri aux résultats
     */
    protected function filterByOrder($annonces)
    {
        if (!in_array($this->direction, ['asc', 'desc'])) {
            $this->direction = 'desc';
        }

        if (!in_array($this->column, ['created_at', 'titre'])) {
            $this->column = 'created_at';
        }

        $this->sortOrder = $this->column . '|' . $this->direction;

        if ($this->column && $this->direction) {
            $annonces = $annonces->orderBy($this->column, $this->direction);
        }

        return $annonces;
    }

    /**
     * Retourne les facettes pour l'interface utilisateur
     */
    public function getFacettes(): array
    {
        $typeArray = (array) $this->type;

        $isLocationVoiture = collect($typeArray)->contains(fn($val) => is_string($val) && Str::contains($val, 'Location de véhicule'));
        $isHotel = collect($typeArray)->contains(fn($val) => is_string($val) && Str::contains($val, 'Hôtel'));
        $isAuberge = collect($typeArray)->contains(fn($val) => is_string($val) && Str::contains($val, 'Auberge'));
        $isLocationMeublee = collect($typeArray)->contains(fn($val) => is_string($val) && Str::contains($val, 'Location meublée'));
        // Common base
        $facettes = [
            (object) [
                'id' => uniqid(),
                'title' => 'Type d\'annonce',
                'category' => 'type',
                'items' => $this->typeAnnonces,
                'selectedItems' => $this->type,
                'icon' => 'ti-briefcase',
                'filterModel' => 'typeFilterValue',
            ],
            (object) [
                'id' => uniqid(),
                'title' => 'Ville',
                'category' => 'ville',
                'items' => $this->villes,
                'selectedItems' => $this->ville,
                'icon' => 'ti-map-alt',
                'filterModel' => 'villeFilterValue',
            ],
            (object) [
                'id' => uniqid(),
                'title' => 'Quartier',
                'category' => 'quartier',
                'items' => $this->quartiers,
                'selectedItems' => $this->quartier,
                'icon' => 'ti-location-pin',
                'filterModel' => 'quartierFilterValue',
            ],
            (object) [
                'id' => uniqid(),
                'title' => 'Entreprise',
                'category' => 'entreprise',
                'items' => $this->entreprises,
                'selectedItems' => $this->entreprise,
                'icon' => 'ti-briefcase',
                'filterModel' => 'entrepriseFilterValue',
            ],
        ];

        if ($isLocationVoiture) {
            $facettes[] = (object) [
                'id' => uniqid(),
                'title' => 'Marque',
                'category' => 'marque',
                'items' => $this->marques,
                'selectedItems' => $this->marque,
                'icon' => 'ti-briefcase',
                'filterModel' => 'marqueFilterValue',
            ];
            $facettes[] = (object) [
                'id' => uniqid(),
                'title' => 'Boite Vitesse',
                'category' => 'boiteVitesse',
                'items' => $this->boiteVitesses,
                'selectedItems' => $this->boiteVitesse,
                'icon' => 'ti-briefcase',
                'filterModel' => 'boiteVitesseFilterValue',
            ];
            $facettes[] = (object) [
                'id' => uniqid(),
                'title' => 'Type vehicule',
                'category' => 'typeVehicule',
                'items' => $this->typeVehicules,
                'selectedItems' => $this->typeVehicule,
                'icon' => 'ti-briefcase',
                'filterModel' => 'typeVehiculeFilterValue',
            ];
        }
        if ($isHotel || $isAuberge || $isLocationMeublee) {
            $facettes[] = (object) [
                'id' => uniqid(),
                'title' => 'Nombre de Personne',
                'category' => 'nombrePersonne',
                'items' => $this->nombrePersonnes,
                'selectedItems' => $this->nombrePersonne,
                'icon' => 'ti-briefcase',
                'filterModel' => 'nombrePersonneFilterValue',
            ];
        }


        return $facettes;
    }

    /**
     * Charge les filtres depuis les liens de navigation
     */
    private function loadNavLinks()
    {
        if (session()->has('se_loger') && session()->get('se_loger')) {
            $this->type = AnnoncesUtils::getSeLogerList();
            session(['se_loger' => '']);
        }

        if (session()->has('se_restaurer') && session()->get('se_restaurer')) {
            $this->type = AnnoncesUtils::getSeRestaurerList();
            session(['se_restaurer' => '']);
        }

        if (session()->has('sortir') && session()->get('sortir')) {
            $this->type = AnnoncesUtils::getSortirList();
            session(['sortir' => '']);
        }

        if (session()->has('louer_voiture') && session()->get('louer_voiture')) {
            $this->type = AnnoncesUtils::getLouerUneVoitureList();
            session(['louer_voiture' => '']);
        }
    }

    /**
     * Génère la vue du composant
     */
    public function render()
    {
        $this->prepareTypeAnnonces();
        $annonces = $this->search()->paginate($this->perPage);
        $this->saveVariableToSession();


        return view('livewire.public.search', [
            'annonces' => $annonces,
            'facettes' => $this->getFacettes(),
        ]);
    }

    /**
     * Prépare les types d'annonces pour l'affichage
     */
    private function prepareTypeAnnonces()
    {
        // $this->typeAnnonces = Annonce::public()
        //     ->pluck('type')
        //     ->countBy()
        //     ->map(function ($count, $type) {
        //         return ['value' => $type, 'count' => $count];
        //     })
        //     ->values()
        //     ->all();

        // $tmpTypeAnnonces = Annonce::pluck('type')->unique();

        // // Ajoute les types manquants avec un compte à 0
        // foreach ($tmpTypeAnnonces as $type) {
        //     if (!in_array($type, array_column($this->typeAnnonces, 'value'))) {
        //         $this->typeAnnonces[] = ['value' => $type, 'count' => 0];
        //     }
        // }

        $publicCounts = Annonce::public()
            ->pluck('type')
            ->countBy();

        $allTypes = Annonce::pluck('type')->unique();

        $this->typeAnnonces = $allTypes->map(function ($type) use ($publicCounts) {
            return [
                'value' => $type,
                'count' => $publicCounts->get($type, 0),
            ];
        })->values()->all();
    }

    /**
     * Méthode appelée avant le rendu
     */
    public function rendering()
    {
        if (!$this->booted) {
            $this->dispatch('custom:element-removal', [
                'element' => $this->search()->get()->pluck('id')->toArray(),
                'perPage' => $this->perPage,
                'key' => $this->key,
                'facette' => count($this->type) + count($this->ville) + count($this->quartier) + count($this->entreprise),
            ]);
        }
    }

    /**
     * Sauvegarde les variables dans la session
     */
    private function saveVariableToSession()
    {
        CustomSession::clear();

        CustomSession::create([
            'annonces' => $this->search()->get()->pluck('id')->toArray(),
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
            'page' => $this->search()->paginate($this->perPage)->currentPage(),
        ]);
    }

    /**
     * Méthode appelée après le rendu
     */
    public function rendered($view, $html)
    {
        $this->dispatch('refresh:filter');
        $this->dispatch('refresh:url', [
            'url' => $this->initURL,
        ]);
    }
}
