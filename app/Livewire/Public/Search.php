<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Favoris;
use App\Utils\AnnoncesUtils;
use App\Utils\SearchValues;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Search extends Component
{
    public $type = '';
    public $key = '';
    public $sortOrder = '';
    public $column = '';
    public $direction = '';

    public $allAnnonceTypes = [];
    public $typesAnnonce = [];
    public $elementToDisplay = 5;
    public $displayedAnnonce;

    public $selectedAnnonce = [];
    public $selectedAnnonceId = [];

    // 
    public $link_key;
    public $link_type;



    public function mount($filter = [])
    {
        $variables = new SearchValues();
        $this->displayedAnnonce = $this->elementToDisplay;
        $this->key = $variables->key;
        $this->type = $variables->type;
        $this->allAnnonceTypes = Annonce::pluck('type')->unique()->toArray();
        $this->selectedAnnonceId = $filter;

        $this->link_key = $variables->key;
        $this->link_type = $variables->type;

        $this->sortOrder = $variables->sortOrder;
    }


    public function updatedSortOrder()
    {
        if (!$this->sortOrder) {
            return;
        }
        list($column, $direction) = explode('|', $this->sortOrder);
        $sessVars = new SearchValues();
        $sessVars->column = $column;
        $sessVars->direction = $direction;
        $sessVars->sortOrder = $this->sortOrder;
        $sessVars->save();
    }

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
        $favorite = Favoris::where('annonce_id', $annonceId)->where('user_id', auth()->user()->id)->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            Favoris::create([
                'annonce_id' => $annonceId,
                'user_id' => auth()->user()->id
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

    public function render()
    {
        $this->typesAnnonce = array_slice($this->allAnnonceTypes, 0, $this->displayedAnnonce);
        $selectedAnnonceId = $this->selectedAnnonceId;
        $type = $this->type;
        $key = $this->key;

        $annonces = Annonce::getActiveAnnonces()->with('entreprise')
            ->where(function ($query) use ($type, $key, $selectedAnnonceId) {
                if ($type) {
                    if (!in_array($type, $selectedAnnonceId)) {
                        array_push($selectedAnnonceId, $type);
                    }
                }

                if (!empty($selectedAnnonceId)) {
                    foreach ($selectedAnnonceId as $selectedType) {
                        $query->orWhere('type', $selectedType);
                    }
                }

                if ($key) {
                    $query->where(function ($query) use ($key) {
                        $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($key) . '%'])
                            ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($key) . '%']);
                    });
                }

                $this->selectedAnnonceId = $selectedAnnonceId;
            });

        $sessVars = new SearchValues();
        if ($sessVars->sortOrder) {
            $annonces = $annonces->orderBy($sessVars->column, $sessVars->direction);
        }

        $annonces = $annonces->paginate(8);
        $this->sortOrder ? $annonces->withPath($sessVars->url) : '';
        $latestAnnonces = Annonce::getActiveAnnonces()->with('annonceable')->latest()->take(4)->get();

        return view('livewire.public.search', compact('annonces', 'latestAnnonces', 'selectedAnnonceId'));
    }
}
