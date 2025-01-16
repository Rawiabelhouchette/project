@props(['pays', 'villes', 'quartiers'])

<div class="row align-items-start">
    <div class="col">
        <div>
            <h3 class="required">Pays</h3>
            <h4>Sélectionnez un élément dans la liste</h4>
            <select class="form-control" data-nom="pays_id" wire:model.lazy='pays_id' required>
                <option value="">Sélectionnez un pays</option>
                @foreach ($pays as $p)
                    <option value="{{ $p->id }}">{{ $p->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div>
            <h3 class="required">Ville</h3>
            <h4>Sélectionnez un élément dans la liste</h4>
            <select class="form-control" data-nom="ville_id" wire:model.lazy='ville_id' required>
                <option value="">Sélectionnez une ville</option>
                @foreach ($villes as $v)
                    <option value="{{ $v->id }}">{{ $v->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div>
            <h3>Quartier</h3>
            <h4>Sélectionnez un élément dans la liste</h4>
            <select class="form-control" data-nom="quartier_id" wire:model.lazy='quartier_id'>
                <option value="">Sélectionnez un quartier</option>
                @foreach ($quartiers as $q)
                    <option value="{{ $q->id }}">{{ $q->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
