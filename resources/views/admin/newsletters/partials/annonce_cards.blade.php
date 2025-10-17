<div class="row">
    @forelse ($annonces as $annonce)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        @if($annonce->is_active)
                            <span class="badge bg-success">Ouvert</span>
                        @endif
                    </div>

                    <h5 class="card-title text-primary">{{ $annonce->titre }}</h5>
                    <p class="text-muted mb-1">
                        <i class="bi bi-geo-alt"></i> {{ $annonce->pays ?? '—' }},
                        {{ $annonce->ville ?? '' }}
                    </p>
                    <p><i class="bi bi-phone"></i> {{ $annonce->entreprise->telephone ?? '—' }}</p>
                    <p><i class="bi bi-tags"></i> {{ $annonce->prix ?? '—' }}</p>

                    <button class="btn btn-outline-primary btnSelectAnnonce"
                        data-id="{{ $annonce->id }}">
                        Sélectionner
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Aucune annonce trouvée pour ce type.</p>
    @endforelse
</div>
