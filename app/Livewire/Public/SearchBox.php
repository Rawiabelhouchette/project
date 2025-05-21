<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Quartier;
use App\Utils\AnnoncesUtils;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchBox extends Component
{
    public $detail;

    public $location;

    public $type;

    public $key;

    public $typeAnnonce;

    public function mount($typeAnnonce = [], $detail = false)
    {
        $this->detail = $detail;
        $this->typeAnnonce = $typeAnnonce;
    }

    #[On('resetSearchBox')]
    public function resetLocation()
    {
        $this->location = '';
        // $this->type = [];
        $this->key = '';
        $this->dispatch('search-type-input:reload');
    }

    public function render()
    {
        // $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();

        $params = AnnoncesUtils::getQueryParams();
        $this->key = $params->key ?? '';
        $this->location = $params->location ?? '';
        $this->type = $params->type[0] ?? '';

        $quartiers = Quartier::getAllQuartiers();

        return view('livewire.public.search-box', [
            'quartiers' => $quartiers,
        ]);
    }
}
