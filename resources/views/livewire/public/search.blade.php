<div>
    <!-- ================ Listing In Grid Style ======================= -->
    <section class="padd-top-20">
        <div class="container">
            <div class="row">

                <!-- Start Sidebar -->
                <div class="col-md-4 col-sm-12">
                    <h4 class="text-center mrg-bot-15">Filtrer vos recherches</h4>

                    @if ($type || $ville || $quartier || $entreprise)
                        <p class="text-center">
                            <a href="javascript:void(0)" class="reset-filters" wire:click='resetFilters'>
                                Effacer tous les filtres
                            </a>
                        </p>
                    @endif

                    <div class="sidebar">
                        @foreach ($facettes as $facette)
                            <div wire:key='{{ $facette->id }}'>
                                @include('components.public.filter-view', [
                                    'title' => $facette->title,
                                    'category' => $facette->category,
                                    'items' => $facette->items,
                                    'selectedItems' => $facette->selectedItems,
                                    'icon' => $facette->icon,
                                    'filterModel' => $facette->filterModel,
                                ])
                            </div>
                        @endforeach

                        <div class="widget-boxed">
                            <div class="widget-boxed-body padd-top-40 padd-bot-40 text-center">
                                <div class="help-support">
                                    <i class="ti-headphone-alt font-60 theme-cl mrg-bot-15"></i>
                                    <p>Vous avez une question ? Contactez-nous</p>
                                    <h4 class="mrg-top-0">contact@numrod.fr</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Start Sidebar -->

                <!-- Start All Listing -->
                <div class="col-md-8 col-sm-12" wire:key='filterShow'>
                    <!-- Filter option -->
                    <div id="research-zone">
                        @if ($type || $ville || $quartier || $entreprise || $key)
                            <div class="row mrg-0 mrg-bot-10">
                                <div class="col-md-12 mrg-top-10">
                                    <div class="col-md-12" style="margin-left: 0px; padding-left: 0px; display: ''; align-items: center; ">
                                        Recherche : &nbsp;
                                        @if ($key)
                                            <span class="badge height-25 theme-bg" id="key-filter" data-value="{{ $key }}">
                                                {{ $key }}
                                                <a href="javascript:void(0)" class="text-white selectedOption" wire:click='changeState("{{ $key }}", "key", true)'> x </a>
                                            </span> &nbsp;
                                        @endif
                                        @foreach ($facettes as $facette)
                                            @foreach ($facette->selectedItems as $item)
                                                <span class="badge height-25 theme-bg search-elt" wire:key='sub-facette-filter-{{ $loop->index }}'>
                                                    {{ $item }}
                                                    <a href="javascript:void(0)" class="text-white selectedOption" wire:click='changeState("{{ $item }}", "{{ $facette->category }}", true)'> x </a>
                                                </span> &nbsp;
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row mrg-0">
                        <div class="col-md-6 mrg-top-10">
                            <h5>Affichage : {{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} résultat trouvé(s)</h5>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <select id="select-order" class="form-control" style="height: 35px !important; margin-bottom: 0px;" tabindex="-98" wire:model.lazy='sortOrder'>
                                <option value="" disabled>Trier</option>
                                <option value="titre|asc">Titre: A à Z</option>
                                <option value="titre|desc">Titre: Z à A</option>
                                <option value="created_at|asc">Date: Ancien à récent</option>
                                <option value="created_at|desc">Date: Récent à ancien</option>
                            </select>
                        </div>
                        <div class="col-md-1" style="">
                            <a href="javascript:void(0)" class="annonce-share" data-toggle="modal" data-target="#share" data-type="all">
                                <i class="fa fa-share fa-lg" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="row mrg-0">
                        @include('components.public.share-modal', [
                            'title' => 'Partager cette annonce',
                        ])

                        <div class="col-md-12 col-sm-12" wire:loading.delay wire:transition>
                            @include('components.public.loader')
                        </div>

                        {{-- {{ $annonces->count() }} --}}
                        <div id="annonces-zone">
                            @foreach ($annonces as $annonce)
                                <div class="col-md-6 col-sm-6" wire:key='{{ time() . $annonce->id }}' id="annonce-{{ $annonce->id }}">
                                    <div class="listing-shot grid-style">
                                        <div class="listing-shot-img">
                                            <a href="{{ route('show', $annonce->slug) }}">
                                                @if ($annonce->image)
                                                    <img src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" class="img-responsive" alt="">
                                                @else
                                                    <img src="http://via.placeholder.com/800x800" class="img-responsive" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="listing-shot-caption">
                                            <a href="{{ route('show', $annonce->slug) }}">
                                                <h4>
                                                    {{ $annonce->titre }}
                                                </h4>

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
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#signin" onclick="$('#share').hide()">
                                                    <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="listing-price-info">
                                            <span class="">{{ $annonce->type }} </span>
                                        </div>
                                        <div class="listing-shot-info">
                                            <div class="row extra">
                                                <div class="col-md-12">
                                                    <div class="listing-detail-info">
                                                        {{-- <span class="pricetag theme-bg">Restaurants</span> --}}
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
                                                
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#share" class="theme-cl annonce-share" style="float: right;"
                                                   data-url="{{ route('show', $annonce->slug) }}"
                                                   data-titre="{{ $annonce->titre }}"
                                                   data-image="{{ $annonce->image ? asset('storage/' . $annonce->imagePrincipale->chemin) : 'http://via.placeholder.com/800x800' }}"
                                                   data-type="{{ $annonce->type }}">
                                                    <i class="fa fa-share theme-cl" aria-hidden="true"></i>
                                                    Partager
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tp-author-basic-info mrg-top-0">
                                            <ul>
                                                <li class="text-center padd-top-10 padd-bot-0">
                                                    <i class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                                    {{ $annonce->nb_vue }}
                                                </li>
                                                <li class="text-center padd-top-10 padd-bot-0">
                                                    <i class="fa fa-heart fa-lg" aria-hidden="true"></i>
                                                    {{ $annonce->nb_favoris }}
                                                </li>
                                                <li class="text-center padd-top-10 padd-bot-0">
                                                    <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                                                    {{ $annonce->nb_commentaire }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @empty($annonces->count())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style" style="padding-top: 50px; padding-bottom: 50px;">
                                    <div class="listing-shot-caption text-center mrg-top-5">
                                        <i class="fa-solid fa-xmark fa-5x" aria-hidden="true"></i> <br>
                                        <h4>Aucune annonce trouvée</h4>
                                        {{-- <a href="javascript:void(0)" class="reset-filters" class="theme-cl" wire:click='resetFilters'>Effacer les filtres</a> --}}
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </div>

                    <div id="annonce-pagination">
                        {{ $annonces->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End Listing In Grid Style ======================= -->
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.annonce-share').on('click', function() {
                var type = $(this).data('type');
                var text, subject, url, image, annonceType;

                $('#share-annonce-image').show();

                if (type === 'all') {
                    text = decodeURI(window.location.href);
                    subject = $(this).data('titre');
                    url = text;
                    $('#share-annonce-image').hide();
                    $('#annonce-type').text('');
                    $('#annonce-titre').text("Partager la page");
                } else {
                    text = "Salut!%0AJette un œil à l'annonce que j’ai trouvé sur Vamiyi%0ATitre : " + $(this).data('titre') + "%0ALien : " + $(this).data('url') + " ";
                    subject = $(this).data('titre');
                    url = $(this).data('url');
                    image = $(this).data('image');
                    annonceType = $(this).data('type');
                    $('#annonce-titre').text(subject);
                    $('#annonce-image-url').attr('src', image);
                    $('#annonce-type').text(annonceType);
                }

                $('#annonce-email').attr('href', 'mailto:?subject=' + subject + '&body=' + text);
                $('#annonce-url').data('url', url);
                $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
                $('#annonce-whatsapp').attr('href', 'whatsapp://send?text=' + text);
            });

            $('#annonce-url').click(function() {
                var text = $(this).data('url');

                if (!navigator.clipboard) {
                    console.error('Clipboard API not available');
                    return;
                }

                navigator.clipboard.writeText(text).then(function() {
                    $('#copyMessage').hide();
                    $('#copyMessage').fadeIn(500);
                    // $('#copyMessage').show();
                    setTimeout(function() {
                        $('#copyMessage').fadeOut(500);
                        // $('#copyMessage').hide();
                    }, 2000);
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        });
    </script>

    <script>
        function filterList(category) {
            // Get the input field and its value
            var filter = normalizeString($('#search-' + category).val());

            // Get the list and its items
            var $li = $('#list-' + category + 's li');

            // Variable to count the number of items displayed
            var count = 0;

            // Loop through the list items and hide those that don't match the filter
            $li.each(function() {
                var txtValue = normalizeString($(this).find('label').text());
                if (txtValue.indexOf(filter) > -1) {
                    $(this).fadeIn(300);
                    count++;
                } else {
                    $(this).fadeOut(300);
                }
            });

            // Get the no results message
            var $noResults = $('#no-' + category + '-results');

            // If no items are displayed, show the no results message
            if (count === 0) {
                $noResults.fadeIn(300);
            } else {
                $noResults.hide(); //fadeOut(300);
            }
        }

        function normalizeString(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toUpperCase();
        }

        window.addEventListener('refresh:filter', event => {
            var intervalId = setInterval(function() {
                var categories = [];
                $('ul.price-range').each(function() {
                    if (this.id.startsWith('list-')) {
                        var idWithoutList = this.id.replace('list-', '').slice(0, -1);
                        categories.push(idWithoutList);
                    }
                });

                categories.forEach(function(category) {
                    filterList(category);
                });
                clearInterval(intervalId);
            }, 500);
        });
    </script>

    <script>
        // reset filters
        $(document).ready(function() {
            $('.reset-filters').on('click', function() {
                var url = window.location.href;
                var newUrl = url.split('?')[0];
                window.history.pushState({}, '', newUrl);
            });
        });
    </script>

    <script>
        window.addEventListener('custom:element-removal', event => {
            var ids = event.detail[0].element;
            var perPage = event.detail[0].perPage;
            var key = event.detail[0].key;

            console.log(key);

            if (!key) {
                $('#key-filter').fadeOut(300);
            }

            // check if search-elt class one element exist
            if ($('.search-elt').length === 0) {
                $('#research-zone').fadeOut(300);
            }



            if (perPage > ids.length) {
                $('#annonce-pagination').fadeOut(300);
            } else {
                $('#annonce-pagination').fadeIn(300);
            }
            // remove element where id is not in ids using js looping on annonces-zone id

            $('#annonces-zone').children().each(function() {
                var annonceId = $(this).attr('id').split('-')[1];
                if (!ids.includes(annonceId)) {
                    // console.log(annonceId);
                    // $(this).remove(); remove with add fadeOut
                    $(this).fadeOut(300);
                }
            });

            // console.log(ids);
        });













        // $(document).ready(function() {
        //     $('.selectedOption').on('click', function() {
        //         // supprimer l'element pres 2 seconde s'il existe toujours

        //         var intervalId = setInterval(function() {
        //             if ($(this).length > 0) {
        //                 $(this).parent().remove(); //.fadeOut(300);
        //             }
        //             clearInterval(intervalId);
        //         }, 500);
        //     });
        // });
    </script>
@endpush
