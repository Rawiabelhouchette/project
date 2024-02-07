@props(['title' => ''])

<div>
    <style>
        .modal-open #share {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .modal-open #share {
                width: 350px;
                left: calc(50% - 175px);
            }
        }

        #share-header {
            border-bottom: none !important;
            padding-bottom: 0;
        }

        .share-icon {
            scale: 1.25;
        }
    </style>

    <div id="share" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="shareLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content padd-bot-0">
                <div class="modal-header" id="share-header">
                    <h4 id="modalLabel2" class="modal-title">Partager</h4>
                    <button type="button" class="m-close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <div class="modal-body padd-top-0">
                    <div class="row">
                        <div class="col-12 mrg-10">
                            <div class="side-list text-center">
                                <ul class="padd-top-0">
                                    <li class="padd-top-0">
                                        <div class="listing-list-img">
                                            <img src="http://via.placeholder.com/80x80" class="img-responsive" alt="">
                                        </div>
                                        <div class="listing-list-info">
                                            <h5><a href="#" title="Listing">Titre annonce</a></h5>
                                            <div class="listing-post-meta">
                                                <span class="updated">type annonce</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 text-center mrg-10">
                            <ul class="side-list-inline no-border social-side">
                                <li class="share-icon">
                                    <a href="javascrip:void(0)">
                                        <i class="fa fa-copy theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="#">
                                        <i class="fa-brands fa-facebook theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="#">
                                        <i class="fa-brands fa-whatsapp theme-cl"></i>
                                    </a>
                                </li>
                                <li class="share-icon">
                                    <a href="#">
                                        <i class="fa fa-envelope theme-cl"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
