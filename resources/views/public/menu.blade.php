@props(['category'])

<div class="col-md-3 col-sm-12">
    <div class="sidebar">
        <!-- Start: Search By Price -->
        <div class="widget-boxed facette-color" style="padding-bottom: 0px;">
            {{-- <div class="widget-boxed-header">
                    <h4><i class="ti-money padd-r-10"></i>Top Categories</h4>
                </div> --}}

            <div class="widget-boxed-body padd-top-10 padd-bot-0">
                <div class="side-list">
                    <ul class="price-range">
                        <li>
                            <a href="{{ route('accounts.index') }}">
                                <span class="custom-checkbox d-block @if ($category == 0) theme-cl @endif" style="font-size: 18px;">
                                    <i class="fa-solid fa-user @if ($category == 0) theme-cl @endif"></i> &nbsp;
                                    Compte
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('accounts.favorite.index') }}">
                                <span class="custom-checkbox d-block @if ($category == 1) theme-cl @endif" style="font-size: 18px;">
                                    <i class="fa-solid fa-star @if ($category == 1) theme-cl @endif"></i> &nbsp;
                                    Favoris
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('accounts.comment.index') }}">
                                <span class="custom-checkbox d-block @if ($category == 2) theme-cl @endif" style="font-size: 18px;">
                                    <i class="fa-solid fa-comment @if ($category == 2) theme-cl @endif"></i> &nbsp;
                                    Commentaires
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
