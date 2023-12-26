<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use Livewire\Component;
use Livewire\Attributes\On; 


class Search extends Component
{
    public $type = '';
    public $key = '';
    public $sortOrder = '';
    public $column = '';
    public $direction = '';
    public $typesAnnonce = [];
    public $selectedAnnonce = [];
    public $selectedAnnonceId = [];



    public function mount($key, $type, $filter = [])
    {
        $this->key = $key;
        $this->type = $type;
        $this->typesAnnonce = Annonce::pluck('type')->unique()->toArray();
        $this->selectedAnnonceId = $filter;
    }

    public function updatedSortOrder()
    {
        list($column, $direction) = explode('|', $this->sortOrder);
        $this->column = $column;
        $this->direction = $direction;
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

    public function render()
    {
        $selectedAnnonceId = $this->selectedAnnonceId;
        $type = $this->type;
        $key = $this->key;

        $annonces = Annonce::with('entreprise')//->where('is_active', true)->where('date_validite', '>=', date('Y-m-d H:i:s'))
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
            
        if ($this->sortOrder) {
            list($column, $direction) = explode('|', $this->sortOrder);
            $annonces = $annonces->orderBy($column, $direction);
        }


        
        $annonces = $annonces->paginate(20);
        $latestAnnonces = Annonce::with('annonceable')->where('is_active', true)->where('date_validite', '>=', date('Y-m-d H:i:s'))->latest()->take(4)->get();


        return view('livewire.public.search', compact('annonces', 'latestAnnonces', 'selectedAnnonceId'));
    }
}
