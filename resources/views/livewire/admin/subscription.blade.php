<div wire:ignore.self>
    <div class="col-md-12 col-sm-12 desktop-view">
        <div class="card">
            <div class="card-body padd-l-0 padd-r-0">
                <div class="col-md-12">
                    {{-- <div class="row" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                    <div class="col-md-6" style="margin-top: 10px;">
                        <span id="nbre-favoris">{{ $abonnements->firstItem() }}-{{ $abonnements->lastItem() }} sur
                            {{ $abonnements->total() }} abonnement(s)</span>
                    </div>
                    <div class="col-md-6 text-center">
                        <input id="comment_search" class="form-control" type="search" value="" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
                    </div>
                    <div class="col-md-1 text-center">
                        <input id="comment_search" class="form-control" type="search" value="" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
                    </div>
                </div> --}}

                    <div class="row"
                        style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <span id="nbre-favoris">{{ $abonnements->firstItem() }}-{{ $abonnements->lastItem() }} sur
                                {{ $abonnements->total() }} abonnement(s)
                            </span>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="row">

                                <div class="col-md-12 p-0">
                                    <input id="comment_search" class="form-control" type="search" value=""
                                        style="margin-top: 6px; margin-bottom: 6px; height: 35px;"
                                        placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
                                </div>
                                <div class="col-md-12 p-2">
                                <button class="add-button" onclick="window.location.href='{{ route('pricing') }}'">
                                    <i class="bi bi-plus-circle me-2"></i>Ajouter
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="small-list-wrapper">
                    <table class="table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Date Début</th>
                                        <th>Date Fin</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($abonnements as $abonnement)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $abonnement->date_debut->format('d-m-Y H:i:s') }}</td>
                                            <td>{{ $abonnement->date_fin->format('d-m-Y H:i:s') }}</td>
                                            <td>{{ number_format($abonnement->montant, 0, ',', ' ') }}</td>
                                            <td>
                                                @if ($abonnement->is_active)
                                                    <span class="badge bg-success">&nbsp;&nbsp;</span>&nbsp;Actif
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </td>
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

    <div class="container mobile-view">
        <span id="nbre-favoris">{{ $abonnements->firstItem() }}-{{ $abonnements->lastItem() }} sur
            {{ $abonnements->total() }} abonnement(s)
        </span>
        <div class="row mt-2">
            <div class="col-md-12 p-0">
                <input id="comment_search" class="form-control" type="search" value=""
                    style="margin-top: 6px; margin-bottom: 6px; height: 35px;"
                    placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
            </div>
            <div class="col-12">
                <button class="add-button" onclick="window.location.href='{{ route('pricing') }}'">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter
                </button>

                <!-- Table view (default and tablet) -->
                <div class="table-view">
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table">
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
                                            <td>{{ $abonnement->date_debut->format('d-m-Y H:i:s') }}</td>
                                            <td>{{ $abonnement->date_fin->format('d-m-Y H:i:s') }}</td>
                                            <td>{{ number_format($abonnement->montant, 0, ',', ' ') }}</td>
                                            <td>
                                                @if ($abonnement->is_active)
                                                    <span class="badge bg-success">&nbsp;&nbsp;</span>&nbsp;Actif
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </td>
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
                </div>

                <!-- Mobile card view (small screens) -->
                @forelse($abonnements as $abonnement)
                    <div class="mobile-view">
                        <div class="mobile-card">
                            <div class="mobile-card-header">
                                <div>
                                    @if ($abonnement->is_active)
                                        <span class="badge bg-success">&nbsp;&nbsp;</span>&nbsp;Actif
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </div>
                                <div>ID: <strong>{{ $abonnement->id }}</strong></div>
                                <div>Montant <strong>{{ number_format($abonnement->montant, 0, ',', ' ') }}</strong>
                                </div>
                            </div>
                            <div class="mobile-card-body">
                                <div>
                                    <div class="mobile-card-label">Date Début</div>
                                    <div class="mobile-card-value">{{ $abonnement->date_debut->format('d-m-Y') }}
                                    </div>
                                </div>
                                <div>
                                    <div class="mobile-card-label">Date Fin</div>
                                    <div class="mobile-card-value">{{ $abonnement->date_fin->format('d-m-Y') }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- You can add more cards here -->
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun abonnement trouvé</td>
                    </tr>
                @endforelse
            </div>
        </div>
        <div class="col-md-12 text-center" style="margin: 0px; padding: 0px;">
            {{ $abonnements->links() }}
        </div>
    </div>

    <style>
        .mobile-view {
            display: none;
        }

        .add-button {
                background-color: #de6600;
                border: none;
                color: white;
                font-weight: 600;
                padding: 12px 20px;
                border-radius: 8px;
                width: 100%;
                margin-bottom: 15px;
                transition: all 0.3s ease;
            }

            .add-button:hover {
                background-color: #F57C00;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        /* Mobile optimizations */
        @media (max-width: 767.98px) {
            .table-container {
                background-color: white;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                margin-bottom: 20px;
            }

            .table-responsive {
                margin-bottom: 0;
            }

            .table {
                margin-bottom: 0;
            }

            .table thead {
                background-color: #f8f9fa;
            }

            .table th {
                font-weight: 600;
                border-bottom: 2px solid #dee2e6;
                white-space: nowrap;
            }



            .status-badge {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 6px;
            }

            .status-active {
                background-color: #4CAF50;
            }

            .desktop-view {
                display: none !important
            }

            .mobile-view {
                display: block !important;
            }

            .table-container {
                border-radius: 8px;
            }

            .table th,
            .table td {
                padding: 12px 10px;
                font-size: 0.9rem;
            }

            /* Card-like rows for mobile */
            .mobile-card {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                margin-bottom: 15px;
                padding: 15px;
            }

            .mobile-card-header {
                display: flex;
                justify-content: space-between;
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }

            .mobile-card-body {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .mobile-card-label {
                font-weight: 600;
                color: #6c757d;
                font-size: 1.8rem;
                margin-bottom: 3px;
            }

            .mobile-card-value {
                font-size: 1.5rem;
            }

            .mobile-view {
                display: none;
            }

            /* Toggle between table and card view based on screen size */
            @media (max-width: 575.98px) {
                .table-view {
                    display: none;
                }

                .mobile-view {
                    display: block;
                }
            }
        }
    </style>
</div>
