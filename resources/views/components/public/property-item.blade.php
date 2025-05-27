@props(['annonces', 'mode' => 'row', 'showDelete' => false, 'showShare' => true, 'showEdit' => false, 'deleteType' => 'favorite'])

<style>
    /* Add these styles to ensure proper hiding/showing of modes */
    .mode-row {
        display: block !important;
    }

    .mode-line {
        display: block !important;
    }

    .mode-row.hidden-mode {
        display: none !important;
    }

    .mode-line.hidden-mode {
        display: none !important;
    }

    /* Line mode styling */
    .line-card-container {
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 768px) {
        .line-card-container {
            flex-direction: row;
        }
    }

    .line-image-container {
        position: relative;
        height: 200px;
        width: 100%;
    }

    @media (min-width: 768px) {
        .line-image-container {
            width: 240px;
            height: auto;
        }
    }

    .line-property-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .line-content-container {
        flex: 1;
        padding: 1rem;
        display: flex;
        flex-direction: column;
    }

    .line-content-top {
        flex: 1;
    }

    .line-content-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .line-property-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .line-location-container,
    .line-phone-container {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-bottom: 0.25rem;
        color: #6b7280;
    }

    .line-icon-location,
    .line-icon-phone {
        color: #de6600;
    }

    .line-description {
        margin-top: 0.5rem;
        color: #6b7280;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-rating-container {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .line-star-filled {
        color: #de6600;
    }

    .line-star-empty {
        color: #d1d5db;
    }

    .line-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .line-price-range {
        font-weight: 600;
        color: #de6600;
        margin-right: 0.5rem;
    }
</style>

@foreach ($annonces as $annonce)
    {{-- Row Mode Layout --}}
    <div wire:key="row-{{ $annonce->id }}" class="property_item mode-row {{ $mode !== 'row' ? 'hidden-mode' : '' }}">
        <a class="listing-thumb image" href="{{ route('show', $annonce->slug) }}" style="background-image: url('{{ $annonce->image ? asset('storage/' . $annonce->imagePrincipale->chemin) : 'https://placehold.co/600' }}'); 
                background-size: cover; 
                background-position: center; 
                display: block; 
                height: 200px;">

            @if ($annonce->entreprise->est_ouverte)
                <div class="state {{ $annonce->entreprise->est_ouverte ? 'bg-success' : 'bg-danger' }}">
                    <span>Ouvert</span>
                </div>
            @endif

            <div class="listing-price-info">
                <span class="categorytag">
                    @php
                        $iconClass = 'fas fa-tag'; // Default icon

                        // Map types to icons
                        $typeIcons = [
                            'Auberge' => 'fas fa-hotel',
                            'Hôtel' => 'fas fa-hotel',
                            'Location de véhicule' => 'fas fa-car',
                            'Location meublée' => 'fas fa-home',
                            'Boite de nuit' => 'fas fa-glass-cheers',
                            'Fast-food' => 'fas fa-utensils',
                            'Restaurant' => 'fas fa-burger',
                            'Patisserie' => 'fas fa-birthday-cake',
                            'Bar & Rooftop' => 'fas fa-glass-martini-alt',
                            'Bar' => 'fas fa-glass-martini-alt',
                        ];

                        if (isset($typeIcons[$annonce->type])) {
                            $iconClass = $typeIcons[$annonce->type];
                        }
                    @endphp
                    <i class="{{ $iconClass }}"></i>
                </span>
            </div>
        </a>

        <div class="image-listing-content">
            <div class="list-fx-features">
                <div class="ratingtag flex items-center bg-white px-2 py-1 shadow-sm">
                    <span class="listing-shot-info rating p-0">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= $annonce->getNote() ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                        @endfor
                        {{ $annonce->getNote() }}
                    </span>

                </div>
                <div class="d-flex align-items-center" style="gap:2px;">
                    @if ($showShare)
                        <a href="javascript:void(0)" class="share-btn" data-toggle="modal" data-target="#share" onclick="shareAnnonce('{{ route('show', $annonce->slug) }}', '{{ $annonce->titre }}', '{{ asset('storage/' . ($annonce->image ? $annonce->image : 'placeholder.jpg')) }}', '{{ $annonce->type }}')">
                            <i class="fa fa-share-alt theme-cl"></i>
                        </a>
                    @endif

                    @if ($showEdit)
                        <a href="{{ $annonce->annonceable->public_edit_url }}" class="like-listing alt style-2">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                    @endif

                    @if ($showDelete)
                        <a href="javascript:void(0)" class="like-listing alt style-2" onclick="{{ $deleteType === 'favorite' ? 'confirmRemoveFavorite(' . $annonce->id . ')' : 'confirmDeleteAnnonce(' . $annonce->id . ')' }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    @else
                        @if (Auth::check())
                            @if ($annonce->getEstFavoris())
                                <a href="javascript:void(0)" class="like-listing style-2" wire:click='updateFavoris({{ $annonce->id }})'>
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="like-listing alt style-2" wire:click='updateFavoris({{ $annonce->id }})'>
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </a>
                            @endif
                        @else
                            <a href="javascript:void(0)" class="like-listing alt style-2" data-bs-toggle="modal" data-bs-target="#signin" onclick="$('#share').hide()">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="proerty_text">
                <h3 class="captlize">
                    {{ $annonce->titre }}
                </h3>
            </div>

            <div class="proerty_text">
                <span>
                    <i class="ti-location-pin" style="color: #de6600;"></i>
                </span>
                <h4 class="captlize" style="font-weight:400; font-size:14px">
                    @if ($annonce->ville_id)
                        {{ $annonce->getAdresseComplete()->pays }},
                        {{ $annonce->getAdresseComplete()->ville }},
                        {{ $annonce->getAdresseComplete()->quartier }}
                    @else
                        {{ $annonce->entreprise->adresse_complete }}
                    @endif
                </h4>
            </div>

            <div class="proerty_text">
                <span>
                    <i class="ti-mobile" style="color: #de6600;"></i>
                </span>
                <h4 class="captlize" style="font-weight:400; font-size:14px">
                    {{ $annonce->entreprise->telephone }}
                </h4>
            </div>

            <div class="proerty_text">
                <span>
                    <i class="ti-money" style="color: #00796b;"></i>
                </span>
                <h4 class="captlize" style="font-weight:400; font-size:14px">
                    {{ number_format($annonce->prix ?? 0, 0, '', ' ') }}
                </h4>
            </div>

            {{-- Enhanced counter and price section --}}
            <div class="proerty_text countprice">
                <div class="counter-container">
                    <div class="counter-item">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span>{{ $annonce->getViewCount() }}</span>
                    </div>
                    <div class="counter-item">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span>{{ $annonce->getFavoriteCount() }}</span>
                    </div>
                    <div class="counter-item">
                        <i class="fa fa-comment" aria-hidden="true"></i>
                        <span>{{ $annonce->getCommentCount() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Line Mode Layout (Horizontal Card) --}}
    <div wire:key="line-{{ $annonce->id }}" class="col-12 line-property-item mode-line {{ $mode !== 'line' ? 'hidden-mode' : '' }} mb-3">
        <a class="line-listing-link" href="{{ route('show', $annonce->slug) }}">
            <div class="line-card-container">
                <div class="line-image-container">
                    @if ($annonce->entreprise->est_ouverte)
                        <div class="line-status-badge line-status-open">
                            <span>Ouvert</span>
                        </div>
                    @endif
                    @if ($annonce->type)
                        <div class="listing-price-info">
                            <span class="categorytag">
                                @php
                                    $iconClass = 'fas fa-tag'; // Default icon

                                    // Map types to icons
                                    $typeIcons = [
                                        'Auberge' => 'fas fa-hotel',
                                        'Hôtel' => 'fas fa-hotel',
                                        'Location de véhicule' => 'fas fa-car',
                                        'Location meublée' => 'fas fa-home',
                                        'Boite de nuit' => 'fas fa-glass-cheers',
                                        'Fast-food' => 'fas fa-utensils',
                                        'Restaurant' => 'fas fa-burger',
                                        'Patisserie' => 'fas fa-birthday-cake',
                                        'Bar & Rooftop' => 'fas fa-glass-martini-alt',
                                        'Bar' => 'fas fa-glass-martini-alt',
                                    ];

                                    if (isset($typeIcons[$annonce->type])) {
                                        $iconClass = $typeIcons[$annonce->type];
                                    }
                                @endphp
                                <i class="{{ $iconClass }}"></i>
                            </span>
                        </div>
                    @endif
                    @if ($annonce->image)
                        <img class="line-property-image" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="{{ $annonce->titre }}" onerror="this.onerror=null; this.src='https://placehold.co/600';" style="object-fit: cover; object-position: center; width: 100%; height: 100%; object-fit: cover; object-position: center; border-radius: 10px;">
                    @else
                        <img class="line-property-image" src="https://placehold.co/600x400" alt="{{ $annonce->titre }}">
                    @endif
                </div>

                <div class="line-content-container">
                    <div class="line-content-top">
                        <div class="d-flex justify-content-between">
                            <span class="line-property-title">{{ $annonce->titre }}</span>
                            {{-- Price tag for line view --}}
                            <div class="line-money-container">
                                <i class="ti-money line-icon-money"></i>
                                <span class="line-money-text">
                                    {{ number_format($annonce->prix ?? 0, 0, '', ' ') }}
                                </span>
                            </div>
                        </div>

                        <div class="line-location-container">
                            <i class="ti-location-pin line-icon-location"></i>
                            <span class="line-location-text">
                                @if ($annonce->ville_id)
                                    {{ $annonce->getAdresseComplete()->ville }}, {{ $annonce->getAdresseComplete()->pays }}
                                @else
                                    {{ $annonce->entreprise->adresse_complete }}
                                @endif
                            </span>
                        </div>

                        <div class="line-phone-container">
                            <i class="ti-mobile line-icon-phone"></i>
                            <span class="line-phone-text">{{ $annonce->entreprise->telephone }}</span>
                        </div>

                        <div class="line-phone-container">
                            <i class="ti-money line-icon-money"></i>
                            <span class="line-money-text">
                                {{ number_format($annonce->prix ?? 0, 0, '', ' ') }}
                            </span>
                        </div>

                        <p class="line-description">
                            {{ \Illuminate\Support\Str::limit($annonce->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.', 100) }}
                        </p>
                        <div class="line-rating-container">
                            <span class="line-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $annonce->getNote() ? 'line-star-filled' : 'line-star-empty' }} fa fa-star" aria-hidden="true"></i>
                                @endfor
                            </span>
                            <span class="line-rating-count">{{ $annonce->getNote() }}</span>
                        </div>
                    </div>

                    <div class="line-content-bottom">
                        <div class="counter-container" style="margin-right: 1rem;">
                            <div class="counter-item">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span>{{ $annonce->view_count }}</span>
                            </div>
                            <div class="counter-item">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <span>{{ $annonce->getFavoriteCount() }}</span>
                            </div>
                            <div class="counter-item">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                <span>{{ $annonce->getCommentCount() }}</span>
                            </div>
                        </div>
                        <div class="line-actions">
                            {{-- Enhanced counter section for line view --}}
                            <a href="javascript:void(0)" class="btn btn-sm btn-light" style="padding: 8px 10px; color: #de6600; border: 1px solid #de6600;" data-toggle="modal" data-target="#share" onclick="shareAnnonce('{{ route('show', $annonce->slug) }}', '{{ $annonce->titre }}', '{{ asset('storage/' . ($annonce->image ? $annonce->image : 'placeholder.jpg')) }}', '{{ $annonce->type }}')">
                                <i class="fa fa-share-alt theme-cl"></i>
                            </a>

                            @if (Auth::check())
                                @if ($annonce->getEstFavoris())
                                    <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                        <span class="btn btn-sm theme-bg" style="padding: 8px 10px; border: 0;"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                        <span class="btn btn-sm btn-light btn-inactive" style="padding: 8px 10px; border: 1px solid #de6600; color: #de6600;"><i class="fa fa-heart-o"></i></span>
                                    </a>
                                @endif
                            @else
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#signin" onclick="$('#share').hide()">
                                    <span class="btn btn-sm btn-light btn-inactive" style="padding: 8px 10px; color: #de6600; border: 1px solid #de6600;"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach

@if ($showDelete)
    <script>
        function confirmRemoveFavorite(annonceId) {
            const params = {
                message: 'Voulez-vous vraiment retirer cette annonce de vos favoris ?',
                icon: 'warning',
                confirmButtonText: 'Oui, retirer',
                onConfirm: function() {
                    Livewire.dispatch('updateFavoris', [annonceId]);
                }
            };

            showConfirmationNotification(params);
        }

        function confirmDeleteAnnonce(annonceId) {
            const params = {
                message: 'Voulez-vous vraiment supprimer cette annonce ?',
                icon: 'warning',
                confirmButtonText: 'Oui, supprimer',
                onConfirm: function() {
                    @this.call('delete', annonceId);
                }
            };

            showConfirmationNotification(params);
        }
    </script>
@endif
