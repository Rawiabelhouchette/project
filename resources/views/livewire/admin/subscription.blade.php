<div class="col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" style="margin-top: 10px;">
                        <span id="nbre-favoris">{{ $abonnements->firstItem() }}-{{ $abonnements->lastItem() }} sur
                            {{ $abonnements->total() }} abonnement(s)</span>
                    </div>
                    <div class="col-md-6 text-center">
                        <input id="comment_search" class="form-control" type="search" value="" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="small-list-wrapper">
                    <table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Début</th>
                                <th>Date Fin</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($abonnements as $abonnement)
                                <tr>
                                    <td>{{ $abonnement->id }}</td>
                                    <td>{{ $abonnement->date_debut }}</td>
                                    <td>{{ $abonnement->date_fin }}</td>
                                    <td>{{ $abonnement->montant }}</td>
                                    <td>{{ $abonnement->is_active ? 'Actif' : 'Inactif' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun abonnement trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 text-center" style="margin: 0px; padding: 0px;">
                {{ $abonnements->links() }}
            </div>
        </div>
    </div>
</div>
