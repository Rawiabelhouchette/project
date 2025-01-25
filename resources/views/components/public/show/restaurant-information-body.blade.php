@props(['annonce'])

<div class="tab-content mt-3" id="myTabContent">
    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <div class="side-list">
            <ul>
                <li>
                    {{ $annonce->description ?? 'Aucune description disponible' }}
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
        <div class="side-list">
            <ul>
                @forelse ($annonce->annonceable->caracteristiques as $key => $value)
                    <li>
                        {{ $key }}
                        <span>{{ $value }}</span>
                    </li>
                @empty
                    <li>
                        Aucune information disponible
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="tab-pane fade" id="equipement" role="tabpanel" aria-labelledby="equipement-tab">
        @forelse ($annonce->referenceDisplay() as $key => $value)
            @if (count($value) > 0)
                <div class="side-list">
                    <ul>
                        <li>
                            {{ $key }}
                        </li>
                        <li class="detail-wrapper-body padd-bot-10">
                            <ul class="detail-check">
                                @forelse ($value as $equipement)
                                    <li>{{ $equipement }}</li>
                                @empty
                                    <span class="text-center">
                                        Aucun équipement disponible
                                    </span>
                                @endforelse
                            </ul>
                        </li>
                    </ul>
                </div>
            @endif
        @empty
            <div class="col-md-12">
                Aucun équipement disponible
            </div>
        @endforelse
    </div>
    <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
        {{-- entrees --}}
        <div class="side-list">
            <h3>Entrées</h3>
            @forelse ($annonce->annonceable->entrees as $entree)
                <ul>
                    <li>
                        <div class="small-listing-box">
                            <div class="small-list-img">
                                @if ($entree['image'])
                                    <img class="img-responsive" src="{{ asset('storage/' . $entree['image']) }}" alt="">
                                @else
                                    <img class="img-responsive" src="{{ asset('assets/img/placeholder.svg') }}" alt="">
                                @endif
                            </div>
                            <div class="small-list-detail">
                                <h4>{{ $entree['nom'] }}</h4>
                                <p>{{ $entree['ingredients'] }}</p>
                            </div>
                            <div class="small-list-action">
                                <span>{{ number_format($entree['prix_min'], 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </li>
                </ul>
            @empty
                <ul>
                    <li>
                        Aucune information disponible
                    </li>
                </ul>
            @endforelse
        </div>
        {{-- plats --}}
        <div class="side-list">
            <h3>Plats</h3>
            @forelse ($annonce->annonceable->plats as $plat)
                <ul>
                    <li>
                        <div class="small-listing-box">
                            <div class="small-list-img">
                                @if ($plat['image'])
                                    <img class="img-responsive" src="{{ asset('storage/' . $entree['image']) }}" alt="">
                                @else
                                    <img class="img-responsive" src="{{ asset('assets/img/placeholder.svg') }}" alt="">
                                @endif
                            </div>
                            <div class="small-list-detail">
                                <h4>{{ $plat['nom'] }}</h4>
                                <p>{{ $plat['ingredients'] }}</p>
                            </div>
                            <div class="small-list-action">
                                <span>{{ number_format($plat['prix_min'], 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </li>
                </ul>
            @empty
                <ul>
                    <li>
                        Aucune information disponible
                    </li>
                </ul>
            @endforelse
        </div>
        {{-- desserts --}}
        <div class="side-list">
            <h3>Desserts</h3>
            @forelse ($annonce->annonceable->desserts as $dessert)
                <ul>
                    <li>
                        <div class="small-listing-box">
                            <div class="small-list-img">
                                @if ($dessert['image'])
                                    <img class="img-responsive" src="{{ asset('storage/' . $entree['image']) }}" alt="">
                                @else
                                    <img class="img-responsive" src="{{ asset('assets/img/placeholder.svg') }}" alt="">
                                @endif
                            </div>
                            <div class="small-list-detail">
                                <h4>{{ $dessert['nom'] }}</h4>
                                <p>{{ $dessert['ingredients'] }}</p>
                            </div>
                            <div class="small-list-action">
                                <span>{{ number_format($dessert['prix_min'], 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div
                              </li>
                </ul>
            @empty
                <ul>
                    <li>
                        Aucune information disponible
                    </li>
                </ul>
            @endforelse
        </div>
    </div>
    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
        @livewire('public.comment', [$annonce])
    </div>
</div>
