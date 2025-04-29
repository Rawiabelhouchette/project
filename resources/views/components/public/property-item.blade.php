@props(['annonce', 'mode' => 'row'])

@php
    $containerClass = $mode === 'row' ? 'col-md-4 col-xs-6 property_item' : 'col-12 line-property-item mb-3';
@endphp

<div class="{{ $containerClass }}">
    @if ($mode === 'row')
        {{-- Original Row Mode Layout --}}
        <a class="listing-thumb classical-list" href="{{ route('show', $annonce->slug) }}">
            <div class="image">
                @if ($annonce->entreprise->est_ouverte)
                    <div class="state {{ $annonce->entreprise->est_ouverte ? 'bg-success' : 'bg-danger' }}">
                        <span>Ouvert</span>
                    </div>
                @endif
                @if ($annonce->image)
                    <img class="img-responsive"
                        src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}"
                        alt="{{ $annonce->titre }}"
                        onerror="this.onerror=null; this.src='https://placehold.co/600';"
                        style="object-fit: cover; object-position: center; width: 100%; height: 100%; object-fit: cover; object-position: center; border-radius: 10px;">
                @else
                    <img class="img-responsive" src="https://placehold.co/600x400"
                        alt="{{ $annonce->titre }}">
                @endif
                <div class="listing-price-info">
                    <span class="pricetag">{{ $annonce->type }}</span>
                </div>
                <div class="image-listing-content">
                    <div class="proerty_text">
                        <h3 class="captlize text-white">
                            {{ $annonce->titre }}
                        </h3>

                    </div>

                    <div class="proerty_text">
                        <span>
                            <i class="ti-location-pin" style="color: #de6600;"></i>
                        </span>
                        <h4 class="captlize text-white" style="font-weight:400; font-size:14px">
                            @if ($annonce->ville_id)
                                {{ $annonce->adresse_complete->pays }},
                                {{ $annonce->adresse_complete->ville }},
                                {{ $annonce->adresse_complete->quartier }}
                            @else
                                {{ $annonce->entreprise->adresse_complete }}
                            @endif
                        </h4>
                    </div>

                    <div class="proerty_text">
                        <span>
                        <i class="ti-mobile" style="color: #de6600;"></i>
                        </span>
                        <h4 class="captlize text-white" style="font-weight:400; font-size:14px">
                            {{ $annonce->entreprise->telephone }}
                        </h4>
                    </div>
                </div>
                <div class="image-listing-content">>
                @if (Auth::check())
                    @if ($annonce->est_favoris)
                        <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                            <span class="like-listing style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </a>
                    @else
                        <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                            <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </a>
                    @endif
                @else
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#signin" onclick="$('#share').hide()">
                        <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                    </a>
                @endif
                </div>
                <div class="list-fx-features">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h4 style="font-weight:400; font-size:11px">
                            <span class="listing-shot-info rating p-0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                @endfor
                            </span>
                            ({{ $annonce->note }})
                        </h4>
                        <a href="javascript:void(0)" class="share-btn" data-toggle="modal" data-target="#share"
                        onclick="shareAnnonce('{{ route('show', $annonce->slug) }}', '{{ $annonce->titre }}', '{{ asset('storage/' . ($annonce->image ? $annonce->image : 'placeholder.jpg')) }}', '{{ $annonce->type }}')">
                            <i class="fa fa-share-alt theme-cl"></i>
                        </a>

                    </div>
                </div>
            </div>
        </a>
    @else
        {{-- Line Mode Layout (Horizontal Card) --}}
        <a class="line-listing-link" href="{{ route('show', $annonce->slug) }}">
            <div class="line-card-container">
                <div class="line-image-container">
                    @if ($annonce->entreprise->est_ouverte)
                        <div class="line-status-badge line-status-open">
                            <span>Ouvert</span>
                        </div>
                    @endif
                    @if ($annonce->type)
                        <div class="line-type-badge">
                            <span>{{ $annonce->type }}</span>
                        </div>
                    @endif
                    @if ($annonce->image)
                        <img class="line-property-image"
                            src="https://placehold.co/600"
                            alt="{{ $annonce->titre }}">
                    @else
                        <img class="line-property-image"
                            src="https://placehold.co/600x400"
                            alt="{{ $annonce->titre }}">
                    @endif
                </div>

                <div class="line-content-container">
                    <div class="line-content-top">
                        <h3 class="line-property-title">
                            {{ $annonce->titre }}
                        </h3>

                        <div class="line-location-container">
                            <i class="ti-location-pin line-icon-location"></i>
                            <span class="line-location-text">
                                @if ($annonce->ville_id)
                                    {{ $annonce->adresse_complete->ville }}, {{ $annonce->adresse_complete->pays }}
                                @else
                                    {{ $annonce->entreprise->adresse_complete }}
                                @endif
                            </span>
                        </div>

                        <div class="line-phone-container">
                            <i class="ti-mobile line-icon-phone"></i>
                            <span class="line-phone-text">{{ $annonce->entreprise->telephone }}</span>
                        </div>

                        <p class="line-description">
                            {{ \Illuminate\Support\Str::limit($annonce->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.', 100) }}
                        </p>
                    </div>

                    <div class="line-content-bottom">
                        <div class="line-rating-container">
                            <span class="line-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $annonce->note ? 'line-star-filled' : 'line-star-empty' }} fa fa-star" aria-hidden="true"></i>
                                @endfor
                            </span>
                            <span class="line-rating-count">({{ $annonce->note }})</span>
                        </div>

                        <div class="line-actions">
                            <a href="javascript:void(0)" class="share-btn" data-toggle="modal" data-target="#share"
                            onclick="shareAnnonce('{{ route('show', $annonce->slug) }}', '{{ $annonce->titre }}', '{{ asset('storage/' . ($annonce->image ? $annonce->image : 'placeholder.jpg')) }}', '{{ $annonce->type }}')">
                                <i class="fa fa-share-alt theme-cl"></i>
                            </a>
                            @if (Auth::check())
                                @if ($annonce->est_favoris)
                                    <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                        <span class="btn btn-sm theme-bg text-white" style="padding: 8px 10px;border: 0;"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                    </a>
                                @else
                                    <a href="javascript:void(0)" wire:click='updateFavoris({{ $annonce->id }})'>
                                        <span class="btn btn-sm btn-light btn-inactive" style="padding: 8px 10px;border: 0;"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                    </a>
                                @endif
                            @else
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#signin" onclick="$('#share').hide()">
                                    <span class="btn btn-sm btn-light btn-inactive" style="padding: 8px 10px;border: 0;"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endif
</div>

