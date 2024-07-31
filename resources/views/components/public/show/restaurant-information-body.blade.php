@props(['annonce'])

<div class="tab-content tabs">
    {{-- <div class="tab-pane fade in active" id="information" role="tabpanel">
        {{ $annonce->annonceable->caracteristiques }}
    </div> --}}
    <div class="tab-pane fade fade in active" id="equipement" role="tabpanel">
        @forelse ($annonce->referenceDisplay() as $key => $value)
            @if (count($value) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <strong class="" style="text-transform: uppercase;">{{ $key }}</strong>
                    </div>
                    <div class="detail-wrapper-body padd-bot-10">
                        <ul class="detail-check">
                            @forelse ($value as $equipement)
                                <div class="col-xs-12 col-md-4 padd-l-0">
                                    <li style="width: 100%;">{{ $equipement }}</li>
                                </div>
                            @empty
                                <span class="text-center">
                                    Aucun équipement disponible
                                </span>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-md-12">
                Aucun équipement disponible
            </div>
        @endforelse
    </div>
    {{-- entrees --}}
    <div class="tab-pane fade" id="entrees" role="tabpanel">
        <div class="row">
            {{-- <div class="col-md-12 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                <strong class="">ENTREE</strong>
            </div> --}}
            {{-- @forelse ($annonce->annonceable->caracteristiques as $key => $value)
                @if ($loop->iteration == 4)
                    <div class="col-md-12 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                        <strong class="">PLAT</strong>
                    </div>
                @elseif ($loop->iteration == 7)
                    <div class="col-md-12 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                        <strong class="">DESSERT</strong>
                    </div>
                @endif
                <div class="col-md-4 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    {{ $key }} <br>
                    <strong class="theme-cl">{{ $value }}</strong>
                </div>
            @empty
                <div class="col-md-12">
                    Aucune information disponible
                </div>
            @endforelse --}}

            {{-- <table style="width: 100%;" class="text-center">
                <tr>
                    <td>Nom</td>
                    <td>Ingrédients</td>
                    <td>Prix minimum</td>
                    <td>Prix maximum</td>
                </tr>
            </table> --}}

            @foreach ($annonce->annonceable->entrees as $entree)
                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Nom ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $entree[0] }}</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Ingrédients ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $entree[1] }}</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Prix minimum ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $entree[2] }} FCFA</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Prix maximum ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $entree[3] }} FCFA</strong>
                </div>

                {{-- <table class="text-center" style="width: 100%;">
                    @if ($loop->iteration == 1)
                        <tr>
                            <td>Nom</td>
                            <td>Ingrédients</td>
                            <td>Prix minimum</td>
                            <td>Prix maximum</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="text-center"><strong class="theme-cl">{{ $entree[0] }}</strong></td>
                        <td class="text-center"><strong class="theme-cl">{{ $entree[1] }}</strong></td>
                        <td class="text-center"><strong class="theme-cl">{{ $entree[2] }} FCFA</strong></td>
                        <td class="text-center"><strong class="theme-cl">{{ $entree[3] }} FCFA</strong></td>
                    </tr>
                </table> --}}
            @endforeach
        </div>
    </div>

    {{-- plats --}}
    <div class="tab-pane fade" id="plats" role="tabpanel">
        <div class="row">
            @foreach ($annonce->annonceable->plats as $plat)
                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Nom ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $plat[0] }}</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Ingrédients ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $plat[1] }}</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Prix minimum ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $plat[2] }} FCFA</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Prix maximum ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $plat[3] }} FCFA</strong>
                </div>
            @endforeach
        </div>
    </div>

    {{-- desserts --}}
    <div class="tab-pane fade" id="desserts" role="tabpanel">
        <div class="row">
            @foreach ($annonce->annonceable->desserts as $dessert)
                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Nom ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $dessert[0] }}</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Ingrédients ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $dessert[1] }}</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Prix minimum ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $dessert[2] }} FCFA</strong>
                </div>

                <div class="col-md-3 col-xs-12 mrg-bot-5 text-center padd-bot-5">
                    Prix maximum ({{ $loop->iteration }})<br>
                    <strong class="theme-cl">{{ $dessert[3] }} FCFA</strong>
                </div>
            @endforeach
        </div>
    </div>
</div>
