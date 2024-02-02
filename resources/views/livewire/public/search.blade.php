<div>
    <!-- ================ Listing In Grid Style ======================= -->
    <section class="padd-top-20">
        <div class="container">
            <div class="row">

                <!-- Start Sidebar -->
                <div class="col-md-4 col-sm-12">
                    <h4 class="text-center mrg-bot-15">Filtrer vos recherches</h4>
                    <div class="sidebar">
                        <!-- Start: Search By Price -->
                        <div class="widget-boxed padd-bot-10">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-briefcase padd-r-10"></i>Types d'annonce
                            </div>
                            <div class="widget-boxed-body padd-top-10 padd-bot-0">
                                <div class="side-list">
                                    <ul class="price-range">
                                        @foreach ($typesAnnonce as $type)
                                            <li>
                                                <span class="custom-checkbox d-block">
                                                    <input id="check-{{ $type }}" type="checkbox" value="{{ $type }}" wire:change='changeState("{{ $type }}")' {{ in_array($type, $selectedAnnonceId) ? 'checked' : '' }}>
                                                    <label for="check-{{ $type }}" style="font-weight: normal;">{{ $type }}</label>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if (count($allAnnonceTypes) > count($typesAnnonce))
                                <div class="text-center padd-top-5 padd-bot-0">
                                    <a href="javascript:void(0)" wire:click='loadMoreAnnonceType'>
                                        <h5>Voir plus ({{ count($allAnnonceTypes) - count($typesAnnonce) }}) +</h5>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- End: Search By Price -->

                        <!-- Start: Latest Listing -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-header">
                                <h4><i class="ti-check-box padd-r-10"></i>Dernières annonces</h4>
                            </div>
                            <div class="widget-boxed-body padd-top-5" wire:ignore>
                                <div class="side-list">
                                    <ul class="listing-list">
                                        @foreach ($latestAnnonces as $annonce)
                                            <li>
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    <div class="listing-list-img">
                                                        @if ($annonce->image)
                                                            <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="">
                                                        @else
                                                            <img src="http://via.placeholder.com/100x100" class="img-responsive" alt="">
                                                        @endif
                                                    </div>
                                                </a>
                                                <div class="listing-list-info">
                                                    <h5><a href="{{ route('show', $annonce->slug) }}" title="Listing">{{ $annonce->titre }}</a></h5>
                                                    <div class="listing-post-meta">
                                                        <span class="updated">{{ date('d-m-Y', strtotime($annonce->created_at)) }}</span> | <a href="{{ route('search.key.type', ['', $annonce->type]) }}" rel="tag">{{ $annonce->type }}</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End: Latest Listing -->

                        <!-- Start: Help & Support -->
                        <div class="widget-boxed">
                            <div class="widget-boxed-body padd-top-40 padd-bot-40 text-center">
                                <div class="help-support">
                                    <i class="ti-headphone-alt font-60 theme-cl mrg-bot-15"></i>
                                    <p>Vous avez une question ? Contactez-nous</p>
                                    <h4 class="mrg-top-0">contact@numrod.fr</h4>
                                </div>
                            </div>
                        </div>
                        <!-- End: Help & Support -->
                    </div>
                </div>
                <!-- End Start Sidebar -->

                <!-- Start All Listing -->
                <div class="col-md-8 col-sm-12">
                    <!-- Filter option -->
                    <div class="row mrg-0 mrg-bot-20">
                        <div class="col-md-6 mrg-top-10">
                            <h5>Affichage : {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} résultat trouvé(s)</h5>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <select id="select-order" class="form-control" style="height: 35px !important; margin-bottom: 0px;" tabindex="-98" wire:model.lazy='sortOrder'>
                                <option value="" disabled>Trier</option>
                                <option value="titre|asc">Titre: A à Z</option>
                                <option value="titre|desc">Titre: Z à A</option>
                                <option value="created_at|asc">Date: Ancien à récent</option>
                                <option value="created_at|desc">Date: Récent à ancien</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Filter option -->
                    <div class="row mrg-0">
                        @foreach ($annonces as $annonce)
                            <div class="col-md-6 col-sm-6">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-img">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            @if ($annonce->image)
                                                <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="">
                                            @else
                                                <img src="http://via.placeholder.com/800x800" class="img-responsive" alt="">
                                            @endif
                                        </a>
                                        {{-- <span class="approve-listing"><i class="fa fa-check"></i></span> --}}
                                    </div>
                                    <div class="listing-shot-caption">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            <h4>{{ $annonce->titre }}</h4>
                                            <p class="listing-location">{{ $annonce->description_courte }}</p>
                                        </a>
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
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#signin" data-toggle="modal" data-target="#signin">
                                                <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="listing-price-info">
                                        <span class="pricetag">{{ $annonce->type }} </span>

                                    </div>
                                    <div class="listing-shot-info">
                                        <div class="row extra">
                                            <div class="col-md-12">
                                                <div class="listing-detail-info">
                                                    <span><i class="fa fa-phone" aria-hidden="true"></i> {{ $annonce->entreprise->contact }}</span>
                                                    <span>
                                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                                        @if ($annonce->entreprise->site_web)
                                                            {{ $annonce->entreprise->site_web }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="listing-shot-info rating padd-0">
                                            {{ $annonce->note }}
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                            &nbsp;&nbsp;
                                            ({{ $annonce->nb_notation }})
                                            {{-- <a href="javascript:void(0)" data-url="{{ route('show', $annonce->slug) }}" class="theme-cl annonce_share" style="float: right;">
                                                <i class="fa fa-share theme-cl" aria-hidden="true"></i>
                                                Partager
                                            </a> --}}
                                            <a href="javascript:void(0)" id="shareButton" data-url="{{ route('show', $annonce->slug) }}" class="theme-cl annonce_share" style="float: right;">
                                                <i class="fa fa-share theme-cl" aria-hidden="true"></i>
                                                Partager
                                            </a>
                                            <p id="copyMessage" style="display: none;">URL copiée dans le presse-papiers !</p>

                                            <div id="shareBox" style="display: none;">
                                                <p>Partager ce lien:</p>
                                                <a id="whatsappShare" href="#"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                                <!-- Ajoutez d'autres options de partage ici -->
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tp-author-basic-info mrg-top-0">
                                        <ul>
                                            <li class="text-center">
                                                <i class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                                {{ $annonce->nb_vue }}
                                            </li>
                                            <li class="text-center">
                                                <i class="fa fa-heart fa-lg" aria-hidden="true"></i>
                                                {{ $annonce->nb_favoris }}
                                            </li>
                                            <li class="text-center">
                                                <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                                                {{ $annonce->nb_commentaire }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @empty($annonces->items())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-caption text-center mrg-top-5">
                                        <h4>Aucune annonce trouvée</h4>
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </div>
                    {{-- {{ $annonces->links() }} --}}
                    {{ $annonces->appends(['key' => $link_key, 'type' => $link_type])->links() }}
                </div>
                <!-- End All Listing -->
            </div>
            <!-- End Pagination -->
        </div>
    </section>
    <!-- ================ End Listing In Grid Style ======================= -->

    <style>
        #copyMessage {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 3px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
            z-index: 9999;
        }
    </style>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#select-order').change(function() {
                var url = window.location.href;
                url = url.split('&page=')[0];
                window.history.pushState("", "", url);
            });

            $('.annonce_share').click(function() {
                var url = $(this).data('url'),
                    dummy = document.createElement('input'),
                    text = url;

                document.body.appendChild(dummy);
                dummy.value = text;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);

                // $(this).next().show();
                $('#copyMessage').hide();
                $('#copyMessage').show();
                setTimeout(function() {
                    $('#copyMessage').hide();
                }, 2000);
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#shareButton").click(function() {
                var url = window.location.href;
                $("#whatsappShare").attr("href", "https://api.whatsapp.com/send?text=" + encodeURIComponent(url));
                $("#shareBox").toggle();
            });
        });
    </script>
@endpush
