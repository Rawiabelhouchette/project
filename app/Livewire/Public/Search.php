<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Favoris;
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
    protected $queryString = [
        'type',
        'key',
        'location',
        'column',
        'direction',
        'ville',
        'quartier',
    ];


    public $sortOrder = '';
    public $perPage = 2;
    public $isLoading = false;


    public $typeAnnonces = [];
    public $villes = [];
    public $quartiers = [];



    public function mount($filter)
    {
        // $this->key = $filter->key ?? '';
        // $this->type = $filter->type ?? [];
        // $this->page = $filter->page ?? 1;
        // $this->location = $filter->location ?? '';
        // $this->column = $filter->column ?? 'created_at';
        // $this->direction = $filter->direction ?? 'desc';

        $this->type = array_filter($this->type);
        $this->ville = array_filter($this->ville);
        if ($this->location) {
            $tmp = explode(',', $this->location);
            if (count($tmp) == 3) {
                // pattern : quartier, ville, Pays
                $this->ville[] = trim($tmp[1]);
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
        if (property_exists($this, $category)) {
            if (in_array($value, $this->$category)) {
                $this->$category = array_diff($this->$category, [$value]);
            } else {
                array_push($this->$category, $value);
            }
        }
        // switch ($category) {
        //     case 'type':
        //         if (in_array($value, $this->type)) {
        //             $this->type = array_diff($this->type, [$value]);
        //         } else {
        //             array_push($this->type, $value);
        //         }
        //         break;

        //     case 'ville':
        //         if (in_array($value, $this->ville)) {
        //             $this->ville = array_diff($this->ville, [$value]);
        //         } else {
        //             array_push($this->ville, $value);
        //         }
        //         break;

        //     default:
        //         # code...
        //         break;
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

    public function resetFilter()
    {
        $this->key = '';
        $this->type = [];
        $this->location = '';
        $this->ville = [];
        $this->sortOrder = 'created_at|desc';
        $this->resetPage();
    }

    // Apply all filters (the filters on the left side of the page)
    protected function filters($annonces)
    {
        $annonces = $this->filterByVille($annonces);
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

        foreach (Ville::all() as $ville) {
            $tmp = ['value' => $ville->nom, 'count' => $ville->nombre_annonce];
            if (!in_array($tmp, $this->villes)) {
                $this->villes[] = $tmp;
            }
        }

        return view('livewire.public.search', [
            'annonces' => $this->search(),
        ]);
    }

    public function rendered($view, $html)
    {
        $this->dispatch('refresh:filter');
    }
}
