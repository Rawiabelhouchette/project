@props(['title' => 'Partager'])

<div>


    <div id="share" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="shareLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content padd-bot-0">
                <div class="d-flex justify-content-between align-items-center p-2">
                    <h4 id="modalLabel2" class="modal-title" style="font-size: 25px;">{{ $title }}</h4>
                    <a class="m-close" onclick="close()" aria-label="Close">
                        <i class="ti-close"></i>
                    </a>
                </div>

                <div class="modal-body padd-top-0">
                    <div class="row">
                        <div class="col-12 mrg-10">
                            <div class="side-list text-center">
                                <p id="share-page-zone" class="mrg-top-25" style="display: none;">
                                    Partage de la page de recherche
                                </p>
                                <ul class="padd-top-0" id="image-share">
                                    <li class="padd-top-0 padd-bot-0">
                                        <div class="listing-list-img" id="share-annonce-image">
                                            <span class="text-center">
                                                <img id="annonce-image-url" src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                            </span>
                                        </div>
                                        <div class="listing-list-info">
                                            <h5 id="annonce-titre"></h5>
                                            <div class="listing-post-meta">
                                                <span class="updated" id="annonce-type">type annonce</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 text-center mrg-10">
                            <ul class="side-list-inline no-border social-side">
                                <li class="share-icon">
                                    <a href="javascript:void(0)" id="annonce-url" class="copy-link">
                                        <i class="fa fa-copy theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="#" id="annonce-facebook" class="facebook-share">
                                        <i class="fa-brands fa-facebook theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="#" id="annonce-whatsapp" class="whatsapp-share">
                                        <i class="fa-brands fa-whatsapp theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="#" id="annonce-email" class="email-share">
                                        <i class="fa fa-envelope theme-cl"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 text-center mrg-10">
                            <p id="copyMessage" style="display: none;">URL copiée dans le presse-papiers !</p>
                        </div>

                        <style>
                            #copyMessage {
                                background-color: #4CAF50;
                                color: white;
                                padding: 10px;
                                border-radius: 3px;
                            }
                        </style>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Copy link handler
            $('.copy-link').click(function(e) {
                e.preventDefault();
                var url = $(this).data('url');

                navigator.clipboard.writeText(url).then(function() {
                    $('#copyMessage').fadeIn(500).delay(2000).fadeOut(500);
                });
            });

            // Facebook share handler
            $('.facebook-share').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                window.open(url, '_blank', 'width=600,height=400');
            });

            // WhatsApp share handler
            $('.whatsapp-share').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    window.location.href = url;
                } else {
                    window.open('https://web.whatsapp.com/send?text=' + encodeURIComponent(url), '_blank');
                }
            });

            // Email share handler
            $('.email-share').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                window.location.href = url;
            });
            $('.m-close').click(function(e) {
                e.preventDefault();
                $('#share').modal('hide');
            });

        });

        // Global share function
        function share(url, titre, image, type) {
            console.log("share function called with:", url, titre, image, type);
            var text = "Salut!%0AJette un œil à l'annonce que j'ai trouvé sur Vamiyi%0ATitre : " + titre + "%0ALien : " + url + " ";
            var subject = titre;

            // Set content
            $('#annonce-titre').text(subject);
            $('#annonce-image-url').attr('src', image);
            $('#annonce-type').text(type);

            // Set share links
            $('#annonce-email').attr('href', 'mailto:?subject=' + subject + '&body=' + text);
            $('#annonce-url').data('url', url);
            $('#annonce-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
            $('#annonce-whatsapp').attr('href', 'whatsapp://send?text=' + text);

            // Hide page zone and show modal
            $('#share-page-zone').hide();

            // Properly open Bootstrap modal
            $('#share').modal('show');
        }
    </script>
    @endpush
</div>
