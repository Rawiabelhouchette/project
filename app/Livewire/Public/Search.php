<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Favoris;
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
    protected $queryString = [
        'type',
        'key',
        'location',
        'column',
        'direction',
    ];


    public $sortOrder = '';
    public $perPage = 2;
    public $isLoading = false;


    public $typeAnnonces = [];






    public $typesAnnonce = [];
    public $displayedAnnonce;

    public $selectedAnnonce = [];


    public function mount($filter)
    {
        $this->key = $filter->key ?? '';
        $this->type = $filter->type ?? [];
        $this->type = array_filter($this->type);
        $this->page = $filter->page ?? 1;
        $this->location = $filter->location ?? '';
        $this->column = $filter->column ?? 'created_at';
        $this->direction = $filter->direction ?? 'desc';
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
    public function changeState($type)
    {
        // check if the type is already in the array (selectedAnnonceId) or not and add or remove it
        if (in_array($type, $this->type)) {
            $this->type = array_diff($this->type, [$type]);
        } else {
            array_push($this->type, $type);
        }
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

    // public function loadMoreAnnonceType()
    // {
    //     // check if the number of displayed annonce is less than the number of annonce type
    //     if ($this->displayedAnnonce < count($this->allAnnonceTypes)) {
    //         // if yes, add 5 to the number of displayed annonce
    //         $this->displayedAnnonce += 5;
    //     } else {
    //         // if no, set the number of displayed annonce to the number of annonce type
    //         $this->displayedAnnonce = count($this->allAnnonceTypes);
    //     }
    // }

    public function resetFilter()
    {
        $this->key = '';
        $this->type = [];
        $this->location = '';
        $this->resetPage();

    }

    public function search()
    {
        $annonces = Annonce::public()->with('entreprise');
        $annonces = $this->filters($annonces);
        $annonces = $annonces->paginate($this->perPage);
        $this->isLoading = false;
        return $annonces;
    }

    // Apply all filters (the filters on the left side of the page)
    protected function filters($annonces)
    {
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
        $this->typeAnnonces = Annonce::pluck('type')->unique()->toArray();

        return view('livewire.public.search', [
            'annonces' => $this->search(),
        ]);
    }
}
