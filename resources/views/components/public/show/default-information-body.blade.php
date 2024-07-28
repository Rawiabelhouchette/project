@props(['annonce'])

<div class="tab-content tabs">
    <div role="tabpanel" class="tab-pane fade in active" id="information">
        {{ $annonce->annonceable->caracteristiques }}
    </div>
    <div role="tabpanel" class="tab-pane fade" id="equipement">
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
</div>