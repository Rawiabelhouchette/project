<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Favoris;
use App\Models\Quartier;
use App\Models\Ville;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $type = [];
    public $key = '';
    public $location = '';
    public $column = '';
    public $direction = '';
    public $ville = [];
    public $quartier = [];
    public $entreprise = [];
    protected $queryString = [
        'type',
        'key',
        'location',
        'column',
        'direction',
        'ville',
        'quartier',
        'entrerpirse'
    ];

    public $sortOrder = '';
    public $perPage = 12;
    public $isLoading = false;


    public $typeAnnonces = [];
    public $villes = [];
    public $quartiers = [];
    public $entreprises = [];


    public function mount($filter)
    {
        $this->type = array_filter($this->type);
        $this->ville = array_filter($this->ville);
        $this->quartier = array_filter($this->quartier);
        $this->entreprise = array_filter($this->entreprise);

        if ($this->location) {
            $tmp = explode(',', $this->location);
            if (count($tmp) == 3) {
                // pattern : quartier, ville, Pays
                $this->ville[] = trim($tmp[1]);
            }
        }


        $this->getAllEntreprises();
        $this->getVillesParType();
        $this->getQuartiersParVilles();
    }

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

    public function getAllEntreprises()
    {
        $this->entreprises = [];
        foreach (Entreprise::all() as $entreprise) {
            $tmp = ['value' => $entreprise->nom, 'count' => $entreprise->nombre_annonce];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->entreprises)) {
                $this->entreprises[] = $tmp;
            }
        }
    }

    public function updatedSortOrder()
    {
        if (!$this->sortOrder) {
            return;
        }

        $this->isLoading = true;

        $parts = explode('|', $this->sortOrder);

        if (count($parts) === 2) {
            [$this->column, $this->direction] = $parts;
            $this->resetPage();
        }
    }

    // A gerer sur le front avec du js
    public function changeState($value, $category)
    {
        // if (property_exists($this, $category)) {
        //     if (in_array($value, $this->$category)) {
        //         $this->$category = array_diff($this->$category, [$value]);
        //     } else {
        //         array_push($this->$category, $value);
        //     }
        // }
        switch ($category) {
            case 'type':
                if (in_array($value, $this->type)) {
                    $this->type = array_diff($this->type, [$value]);
                } else {
                    array_push($this->type, $value);
                }
                $this->getVillesParType();
                break;

            case 'ville':
                if (in_array($value, $this->ville)) {
                    $this->ville = array_diff($this->ville, [$value]);
                } else {
                    array_push($this->ville, $value);
                }
                $this->getQuartiersParVilles();
                break;
            case 'quartier':
                if (in_array($value, $this->quartier)) {
                    $this->quartier = array_diff($this->quartier, [$value]);
                } else {
                    array_push($this->quartier, $value);
                }
                break;
            case 'entreprise':
                if (in_array($value, $this->entreprise)) {
                    $this->entreprise = array_diff($this->entreprise, [$value]);
                } else {
                    array_push($this->entreprise, $value);
                }
                break;
            default:
                # code...
                break;
        }
    }

    protected function getQuartiersParVilles()
    {
        if (count($this->ville) > 0) {
            $villes = $this->ville;
            $quartiers = [];
            // $annonces = Annonce::public()->where('type', $type)->get();
            $annonces = Annonce::public()->whereHas('entreprise.quartier.ville', function ($query) use ($villes) {
                $query->whereIn('nom', $villes);
            })->get();

            foreach ($annonces as $annonce) {
                $quartiers[] = ['value' => $annonce->entreprise->quartier->nom];
            }
            // parcourir chaque valeur et chercher le nombre d'annonce correspondant
            foreach ($quartiers as $key => $quartier) {
                $quartiers[$key]['count'] = Annonce::public()->where('type', $quartier)->whereHas('entreprise.quartier', function ($query) use ($quartier) {
                    $query->where('nom', 'like', '%' . $quartier['value'] . '%');
                })->count();
            }
            $quartiers = array_unique($quartiers, SORT_REGULAR);
            $this->quartiers = $quartiers;
        } else {
            $this->getAllQuartiers();
        }

        foreach ($this->quartiers as $quartier) {
            $tmp[] = $quartier['value'];
        }
        $this->quartier = array_intersect($this->quartier, $tmp);
    }

    protected function getVillesParType()
    {
        $this->getAllVilles();


        // if (count($this->type) > 0) { 
        // $quartiers = [];
        // $villes = [];
        // // $annonces = Annonce::public()->where('type', $type)->get();
        // $annonces = Annonce::public()->where(function ($query) use ($type) {
        //     foreach ($type as $t) {
        //         $query->orWhere('type', 'like', '%' . $t . '%');
        //     }
        // })->get();
        // foreach ($annonces as $annonce) {
        //     $quartiers[] = ['value' => $annonce->entreprise->quartier->nom];
        //     $villes[] = ['value' => $annonce->entreprise->quartier->ville->nom];
        // }
        // // parcourir chaque valeur et chercher le nombre d'annonce correspondant
        // foreach ($quartiers as $key => $quartier) {
        //     $quartiers[$key]['count'] = Annonce::public()->where('type', $type)->whereHas('entreprise.quartier', function ($query) use ($quartier) {
        //         $query->where('nom', 'like', '%' . $quartier['value'] . '%');
        //     })->count();
        // }
        // foreach ($villes as $key => $ville) {
        //     $villes[$key]['count'] = Annonce::public()->where('type', $type)->whereHas('entreprise.quartier.ville', function ($query) use ($ville) {
        //         $query->where('nom', 'like', '%' . $ville['value'] . '%');
        //     })->count();
        // }
        // // rendre le tableau unique
        // $quartiers = array_unique($quartiers, SORT_REGULAR);
        // $villes = array_unique($villes, SORT_REGULAR);
        // Filtre en fonction de du type selectionner
        // $this->quartiers = $quartiers;
        // $this->villes = $villes;
        // } else {
        //     $this->getAllVilles();
        //     // dd($this->villes);
        // }


    }

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


    public function search()
    {
        $annonces = Annonce::public()->with('entreprise');
        $annonces = $this->filters($annonces);
        $annonces = $annonces->paginate($this->perPage);
        $this->isLoading = false;
        return $annonces;
    }

    // =============================== 
    // =========== FILTERS ===========
    // =============================== 

    public function resetFilters()
    {
        $this->key = '';
        $this->type = [];
        $this->location = '';
        $this->ville = [];
        $this->quartier = [];
        $this->column = '';
        $this->direction = '';
        $this->sortOrder = 'created_at|desc';
        // $this->dispatch('resetSearchBox');
        $this->resetPage();
    }

    // Apply all filters (the filters on the left side of the page)
    protected function filters($annonces)
    {
        $annonces = $this->filterByEntreprise($annonces);
        $annonces = $this->filterByVille($annonces);
        $annonces = $this->filterByQuartier($annonces);
        $annonces = $this->filterAnnoncesByTypeKeyLocation($annonces);
        $annonces = $this->filterByOrder($annonces);

        return $annonces;
    }

    // filter the annonces by type, key and location
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
                $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($key) . '%'])->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($key) . '%']);
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

    protected function filterByVille($annonces)
    {
        $this->location = '';

        if ($this->ville) {
            $villes = $this->ville;
            $annonces = $annonces->whereHas('entreprise.quartier.ville', function ($query) use ($villes) {
                $query->where(function ($query) use ($villes) {
                    foreach ($villes as $ville) {
                        $query->orWhere('nom', 'like', '%' . $ville . '%');
                    }
                });
            });
        }

        return $annonces;
    }

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

    protected function filterByQuartier($annonces)
    {
        $this->location = '';

        if ($this->quartier) {
            $quartiers = $this->quartier;
            $annonces = $annonces->whereHas('entreprise.quartier', function ($query) use ($quartiers) {
                $query->where(function ($query) use ($quartiers) {
                    foreach ($quartiers as $quartier) {
                        $query->orWhere('nom', 'like', '%' . $quartier . '%');
                    }
                });
            });
        }

        return $annonces;
    }

    // Filter by order
    protected function filterByOrder($annonces)
    {
        if (!in_array($this->direction, ['asc', 'desc'])) {
            $this->direction = 'desc';
        }

        if (!in_array($this->column, ['created_at', 'titre'])) {
            $this->column = 'titre';
        }

        $this->sortOrder = $this->column . '|' . $this->direction;

        if ($this->column && $this->direction) {
            $annonces = $annonces->orderBy($this->column, $this->direction);
        }

        return $annonces;
    }

    public function render()
    {
        $this->typeAnnonces = Annonce::public()->pluck('type')
            ->countBy()
            ->map(function ($count, $type) {
                return ['value' => $type, 'count' => $count];
            })
            ->values()
            ->all();



        return view('livewire.public.search', [
            'annonces' => $this->search(),
        ]);
    }

    public function rendered($view, $html)
    {
        $this->dispatch('refresh:filter');
    }
}
