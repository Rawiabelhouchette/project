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
        <div class="side-list">
            <ul>
                @forelse ($annonce->annonceable->menus as $menu)
                    <li>
                        <div class="small-listing-box">
                            <div class="small-list-img">
                                @if ($menu['image'])
                                    <img class="img-responsive" src="{{ asset('storage/' . $menu['image']) }}" alt="">
                                @else
                                    <img class="img-responsive" src="{{ asset('assets/img/placeholder.svg') }}" alt="">
                                @endif
                            </div>
                            <div class="small-list-detail">
                                <h4>{{ $menu['nom'] }}</h4>
                                <p>{{ $menu['accompagnements'] }}</p>
                            </div>
                            <div class="small-list-action">
                                <span>{{ number_format($menu['prix'], 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>
                        Aucune information disponible
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
