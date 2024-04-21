<div class="col-md-9 col-sm-12">
    <div class="card-body">
        <div class="card-header" style="margin: 0px; padding: 0px;">
            <div class="col-md-6 text-left" style="margin-top: 10px;">
                <span id="nbre-favoris">{{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} commentaire(s)</span>
            </div>
            <div class="col-md-6 text-center">
                <input type="text" value="" class="form-control" id="comment_search" placeholder="Afficher la recherche" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" wire:model.live.debounce.500ms='search'>
            </div>

        </div>

        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="small-list-wrapper">
                            <ul id="table" class="mrg-top-5">
                                @foreach ($annonces as $annonce)
                                    <li>
                                        <div class="small-listing-box light-gray">
                                            <div class="small-list-img">
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    @if ($annonce->image)
                                                        <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="" />
                                                    @else
                                                        <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="" />
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="small-list-detail">
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    <h5 title="#">{{ $annonce->titre }} ( {{ $annonce->type }} )</h5>
                                                </a>
                                                <p class="mrg-bot-0">Commentaire : <a href="javascript:void(0)">{{ strlen($annonce->pivot->contenu) > 50 ? substr($annonce->pivot->contenu, 0, 50) . '...' : $annonce->pivot->contenu }}</a>
                                                    | <span>{{ $annonce->pivot->created_at->format('d-m-Y') }}</span>
                                                </p>
                                            </div>
                                            <div class="small-list-action padd-top-5">
                                                <a href="{{ route('show', $annonce->slug) }}" class="light-gray-btn btn-square"><i class="ti-eye"></i></a>
                                                {{-- <a href="javascript:void(0)" class="light-red-btn btn-square"><i class="ti-trash"></i></a> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                                @empty($annonces->items())
                                    <div class="col-md-12 col-sm-12">
                                        <div class="listing-shot grid-style">
                                            <div class="listing-shot-caption text-center mrg-top-20 mrg-bot-20">
                                                <h4>Aucune annonce trouvée</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endempty
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin: 0px; padding: 0px;">
                        {{ $annonces->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
