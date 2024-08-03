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
            <div class="row">
                <div class="col-md-12 text-center">
                    Aucun équipement disponible
                </div>
            </div>
        @endforelse
    </div>
    {{-- entrees --}}
    <div class="tab-pane fade" id="entrees" role="tabpanel">
        <div class="row">
            <table class="text-center table table-bordered table-striped table-hover table-reponsive" style="width: 100%;">
                <tr>
                    <td></td>
                    <td>Nom</td>
                    <td>Ingrédients</td>
                    <td>Prix minimum</td>
                    <td>Prix maximum</td>
                </tr>
                @forelse ($annonce->annonceable->entrees as $entree)
                    <tr>
                        <td>
                            <strong class="">{{ $loop->iteration }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $entree[0] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $entree[1] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $entree[2] }} FCFA</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $entree[3] }} FCFA</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            Aucune information disponible
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    {{-- plats --}}
    <div class="tab-pane fade" id="plats" role="tabpanel">
        <div class="row">
            <table class="text-center table table-bordered table-striped table-hover table-reponsive" style="width: 100%;">
                <tr>
                    <td></td>
                    <td>Nom</td>
                    <td>Ingrédients</td>
                    <td>Accompagnements</td>
                    <td>Prix minimum</td>
                    <td>Prix maximum</td>
                </tr>
                @forelse ($annonce->annonceable->plats as $plat)
                    <tr>
                        <td>
                            <strong class="">{{ $loop->iteration }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $plat[0] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $plat[1] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $plat[2] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $plat[3] }} FCFA</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $plat[4] }} FCFA</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            Aucune information disponible
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    {{-- desserts --}}
    <div class="tab-pane fade" id="desserts" role="tabpanel">
        <div class="row">
            <table class="text-center table table-bordered table-striped table-hover table-reponsive" style="width: 100%;">
                <tr>
                    <td></td>
                    <td>Nom</td>
                    <td>Ingrédients</td>
                    <td>Prix minimum</td>
                    <td>Prix maximum</td>
                </tr>
                @forelse ($annonce->annonceable->desserts as $dessert)
                    <tr>
                        <td>
                            <strong class="">{{ $loop->iteration }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $dessert[0] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $dessert[1] }}</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $dessert[2] }} FCFA</strong>
                        </td>
                        <td>
                            <strong class="theme-cl">{{ $dessert[3] }} FCFA</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            Aucune information disponible
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
