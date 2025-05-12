@props(['annonce', 'sections'])

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
        @foreach($sections as $section)
        <div class="side-list">
            <h3>{{ $section->title }}</h3>
        </div>
        @endforeach
    </div>

</div>
