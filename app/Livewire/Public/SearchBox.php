<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Quartier;
use App\Utils\AnnoncesUtils;
use Livewire\Component;

class SearchBox extends Component
{
    public $detail;

    public function mount($detail = false)
    {
        $this->detail = $detail;
    }
    public function render()
    {
        $typeAnnonce = Annonce::pluck('type')->unique()->toArray();

        $params = AnnoncesUtils::getQueryParams();
        $key = $params->key ?? '';
        $location = $params->location ?? '';
        $type = $params->type[0] ?? '';

        $quartiers = Quartier::getAllQuartiers();
        
        return view('livewire.public.search-box', [
            'typeAnnonce' => $typeAnnonce,
            'key' => $key,
            'location' => $location,
            'type' => $type,
            'quartiers' => $quartiers,
        ]);
    }
}
