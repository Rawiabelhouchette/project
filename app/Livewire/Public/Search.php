<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Favoris;
use App\Utils\CustomSession;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

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


    public $allAnnonceTypes = [];
    public $typesAnnonce = [];
    public $elementToDisplay = 5;
    public $displayedAnnonce;

    public $selectedAnnonce = [];
    public $selectedAnnonceId = [];


    public function mount($filter)
    {
        $this->key = $filter->key ?? '';
        $this->type = $filter->type ?? [];
        $this->page = $filter->page ?? 1;
        $this->location = $filter->location ?? '';
        $this->column = $filter->column ?? 'created_at';
        $this->direction = $filter->direction ?? 'desc';

        $this->displayedAnnonce = $this->elementToDisplay;
        $this->allAnnonceTypes = Annonce::pluck('type')
            ->unique()
            ->toArray();
        $this->selectedAnnonceId = [];
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
        if (in_array($type, $this->selectedAnnonceId)) {
            $this->selectedAnnonceId = array_diff($this->selectedAnnonceId, [$type]);
        } else {
            array_push($this->selectedAnnonceId, $type);
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

    public function loadMoreAnnonceType()
    {
        // check if the number of displayed annonce is less than the number of annonce type
        if ($this->displayedAnnonce < count($this->allAnnonceTypes)) {
            // if yes, add 5 to the number of displayed annonce
            $this->displayedAnnonce += 5;
        } else {
            // if no, set the number of displayed annonce to the number of annonce type
            $this->displayedAnnonce = count($this->allAnnonceTypes);
        }
    }

    public function resetFilter()
    {
        $this->key = '';
        $this->type = '';
        $this->selectedAnnonceId = [];
        $this->link_key = '';
        $this->link_type = '';
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
            $annonces = $annonces->where('type', $this->type);
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
        $this->typesAnnonce = array_slice($this->allAnnonceTypes, 0, $this->displayedAnnonce);

        return view('livewire.public.search', [
            'annonces' => $this->search(),
            'selectedAnnonceId' => $this->selectedAnnonceId,
        ]);
    }
}
