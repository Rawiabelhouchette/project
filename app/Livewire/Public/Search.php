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

    public $type = '';
    public $key = '';
    public $location = '';



    public $perPage = 2;
    public $latestPerPage = 4;
    public $isLoading = false;








    public $sortOrder = '';
    public $column = '';
    public $direction = '';

    public $allAnnonceTypes = [];
    public $typesAnnonce = [];
    public $elementToDisplay = 5;
    public $displayedAnnonce;

    public $selectedAnnonce = [];
    public $selectedAnnonceId = [];


    public function mount($filter)
    {
        // dd($filter);
        $this->key = $filter->key ?? '';
        $this->type = $filter->type ?? '';
        $this->page = $filter->page ?? 1;
        $this->location = $filter->location ?? '';




        // $variables = new CustomSession();
        $this->displayedAnnonce = $this->elementToDisplay;
        // $this->key = $variables->key;
        // $this->type = $variables->type;
        $this->allAnnonceTypes = Annonce::pluck('type')
            ->unique()
            ->toArray();
        $this->selectedAnnonceId = []; //$filter;

        // $this->sortOrder = $variables->sortOrder;
    }

    public function updatingSortOrder()
    {
        if (!$this->sortOrder) {
            return;
        }

        $this->resetPage();
    }

    public function updatedSortOrder()
    {
        // if (!$this->sortOrder) {
        //     return;
        // }
        // [$column, $direction] = explode('|', $this->sortOrder);
        // $sessVars = new CustomSession();
        // $sessVars->column = $column;
        // $sessVars->direction = $direction;
        // $sessVars->sortOrder = $this->sortOrder;
        // $sessVars->save();
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
        $sessVars = new CustomSession();

        $annonces = Annonce::public()->with('entreprise');
        $annonces = $this->filters($annonces);
        if ($sessVars->sortOrder) {
            $annonces = $annonces->orderBy($sessVars->column, $sessVars->direction);
        }
        // $query = request()->query();
        $annonces = $annonces->paginate($this->perPage);
        // $annonces->withPath($this->addQueryToUrl($query));
        // dd($annonces->links());
        return $annonces;
    }

    // Apply all filters (the filters on the left side of the page)
    private function filters($annonces)
    {
        $annonces = $this->filterAnnoncesByTypeKeyLocation($annonces);
        
        return $annonces;
    }

    // filter the annonces by type, key and location
    private function filterAnnoncesByTypeKeyLocation($annonces)
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


    // Retrieve the latest annonces
    public function latestAnnonces()
    {
        return Annonce::public()->latest()->take($this->latestPerPage)->with('annonceable')->get();
    }

    public function render()
    {
        $this->typesAnnonce = array_slice($this->allAnnonceTypes, 0, $this->displayedAnnonce);
        // $selectedAnnonceId = $this->selectedAnnonceId;
        // $type = $this->type;
        // $key = $this->key;

        // $annonces = Annonce::getActiveAnnonces()
        //     ->with('entreprise')
        //     ->where(function ($query) use ($type, $key, $selectedAnnonceId) {
        //         if ($type) {
        //             if (!in_array($type, $selectedAnnonceId)) {
        //                 array_push($selectedAnnonceId, $type);
        //             }
        //         }

        //         if (!empty($selectedAnnonceId)) {
        //             foreach ($selectedAnnonceId as $selectedType) {
        //                 $query->orWhere('type', $selectedType);
        //             }
        //         }

        //         if ($key) {
        //             $query->where(function ($query) use ($key) {
        //                 $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($key) . '%'])->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($key) . '%']);
        //             });
        //         }

        //     });
        //     $this->selectedAnnonceId = $selectedAnnonceId;

        // $sessVars = new CustomSession();
        // if ($sessVars->sortOrder) {
        //     $annonces = $annonces->orderBy($sessVars->column, $sessVars->direction);
        // }

        // $annonces = $annonces->paginate(8);
        // // $annonces->withPath($sessVars->url);
        // $latestAnnonces = Annonce::getActiveAnnonces()
        //     ->with('annonceable')
        //     ->latest()
        //     ->take(4)
        //     ->get();

        return view('livewire.public.search', [
            'annonces' => $this->search(),
            'latestAnnonces' => $this->latestAnnonces(),
            'selectedAnnonceId' => $this->selectedAnnonceId,
        ]);

        // compact('annonces', 'latestAnnonces', 'selectedAnnonceId'));
    }
}
