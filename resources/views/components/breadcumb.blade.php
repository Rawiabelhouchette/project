 <style>
     #breadcumb-mobile {
         display: none;
     }

     @media (max-width: 480px) {
         .page-title {
             height: 150px !important;
         }


         #breadcumb-mobile {
             display: block !important;
         }

         #breadcumb-desktop {
             display: none !important
         }

         .title-transparent {
             background-color: #0a9396;
             /* Teal/turquoise background color */
             background-size: cover;
             background-position: center;
             padding: 30px 0;
             position: relative;
         }

         .title-transparent::before {
             content: "";
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background-color: rgba(10, 147, 150, 0.8);
             /* Semi-transparent overlay */
             z-index: 1;
         }

         .container {
             width: 100%;
             max-width: 1200px;
             margin: 0 auto;
             padding: 0 15px;
         }

         .title-content {
             position: relative;
             z-index: 2;
         }

         .title-content h1 {
             color: white;
             font-size: 28px;
             margin: 0 0 10px 0;
             font-weight: 400;
         }

         .breadcrumbs {
             display: flex;
             flex-wrap: wrap;
             align-items: center;
             gap: 5px;
         }

         .breadcrumbs a {
             color: #ffc107;
             /* Gold/yellow color */
             text-decoration: none;
             font-size: 16px;
         }

         .breadcrumbs span.current {
             color: white;
             /* Gold/yellow color */
             text-decoration: none;
             font-size: 16px;
         }

         .gt3_breadcrumb_divider {
             color: #ffc107;
             /* Gold/yellow color */
             margin: 0 5px;
         }

     }

     @media (min-width: 481px) and (max-width: 767px) {
         .page-title {
             height: 150px !important;
         }

         #breadcumb-mobile {
             display: block !important;
         }

         #breadcumb-desktop {
             display: none !important
         }

         .title-transparent {
             background-color: #0a9396;
             /* Teal/turquoise background color */
             background-size: cover;
             background-position: center;
             padding: 30px 0;
             position: relative;
         }

         .title-transparent::before {
             content: "";
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background-color: rgba(10, 147, 150, 0.8);
             /* Semi-transparent overlay */
             z-index: 1;
         }

         .container {
             width: 100%;
             max-width: 1200px;
             margin: 0 auto;
             padding: 0 15px;
         }

         .title-content {
             position: relative;
             z-index: 2;
         }

         .title-content h1 {
             color: white;
             font-size: 28px;
             margin: 0 0 10px 0;
             font-weight: 400;
         }

         .breadcrumbs {
             display: flex;
             flex-wrap: wrap;
             align-items: center;
             gap: 5px;
         }

         .breadcrumbs a {
             color: #ffc107;
             /* Gold/yellow color */
             text-decoration: none;
             font-size: 16px;
         }

         .breadcrumbs span.current {
             color: white;
             /* Gold/yellow color */
             text-decoration: none;
             font-size: 16px;
         }

         .gt3_breadcrumb_divider {
             color: #ffc107;
             /* Gold/yellow color */
             margin: 0 5px;
         }

     }

     @media (min-width: 768px) and (max-width: 1024px) {
         .page-title {
             height: 150px !important;
         }

         #breadcumb-mobile {
             display: block !important;
         }

         #breadcumb-desktop {
             display: none !important
         }

         .title-transparent {
             background-color: #0a9396;
             /* Teal/turquoise background color */
             background-size: cover;
             background-position: center;
             padding: 30px 0;
             position: relative;
         }

         .title-transparent::before {
             content: "";
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background-color: rgba(10, 147, 150, 0.8);
             /* Semi-transparent overlay */
             z-index: 1;
         }

         .container {
             width: 100%;
             max-width: 1200px;
             margin: 0 auto;
             padding: 0 15px;
         }

         .title-content {
             position: relative;
             z-index: 2;
         }

         .title-content h1 {
             color: white;
             font-size: 28px;
             margin: 0 0 10px 0;
             font-weight: 400;
         }

         .breadcrumbs {
             display: flex;
             flex-wrap: wrap;
             align-items: center;
             gap: 5px;
         }

         .breadcrumbs a {
             color: #ffc107;
             /* Gold/yellow color */
             text-decoration: none;
             font-size: 16px;
         }

         .breadcrumbs span.current {
             color: white;
             /* Gold/yellow color */
             text-decoration: none;
             font-size: 16px;
         }

         .gt3_breadcrumb_divider {
             color: #ffc107;
             /* Gold/yellow color */
             margin: 0 5px;
         }

     }
 </style>
 <section class="title-transparent page-title" id="breadcumb-desktop"
     style="background: url({{ asset($backgroundImage) }});">
     <div class="container">
         <div class="title-content">
             @if ($showTitle)
                 <h1>{{ $title ?? 'Title' }}</h1>
             @endif

             <div class="breadcrumbs">
                 @foreach ($breadcrumbs as $breadcrumb)
                     @if (!$loop->first)
                         <span class="gt3_breadcrumb_divider"></span>
                     @endif

                     @if (isset($breadcrumb['route']))
                         <a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['label'] }}</a>
                     @else
                         <span class="current">{{ $breadcrumb['label'] }}</span>
                     @endif
                 @endforeach
                 {{-- Add conditional extra breadcrumb --}}
                 @if (!empty($detail))
                     <span class="gt3_breadcrumb_divider"></span>
                     <span class="current">Détail</span>
                 @endif
             </div>
         </div>
         @if (!empty($showSearchButton))
             <div class="banner-caption d-none d-md-block">
                 <!-- <h3 class="text-center">Recherche</h3> -->
                 <form class="form-verticle" method="GET" action="{{ route('search') }}">
                     <input name="form_request" type="hidden" value="1">
                     <div class="col-md-4 col-sm-4 no-padd">
                         <i class="banner-icon icon-pencil"></i>
                         <input class="form-control left-radius right-br" name="key" type="text"
                             placeholder="Mot clé...">
                     </div>
                     <div class="col-md-3 col-sm-3 no-padd">
                         <div class="form-box">
                             <i class="banner-icon icon-map-pin"></i>
                             <input id="myInput" class="form-control right-br" name="location" type="text"
                                 placeholder="Localisation...">
                             <div id="autocomplete-results" class="autocomplete-items"></div>
                         </div>
                     </div>
                     <div class="col-md-3 col-sm-3 no-padd">
                         <div class="form-box">
                             <i class="banner-icon icon-layers"></i>
                             <select class="form-control" name="type[]">
                                 <option class="chosen-select" data-placeholder="{{ __('Types d\'annonce') }}"
                                     value="" selected>{{ __('Types d\'annonce') }}</option>
                                 @foreach ($typeAnnonce as $annonce)
                                     <option value="{{ $annonce }}">{{ $annonce }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="col-md-2 col-sm-3 no-padd">
                         <div class="form-box">
                             <button class="btn theme-btn btn-default" type="submit"
                                 style="border-top-left-radius: 0px; !important; border-bottom-left-radius: 0px !important;">
                                 {{-- <i class="ti-search"></i> --}}
                                 {{ __('Rechercher') }}
                             </button>
                         </div>
                     </div>
                 </form>


             </div>
         @endif
     </div>
 </section>

 <div id="breadcumb-mobile">
     <style>
         /* Mobile styles */
         @media (max-width: 768px) {

             .title-content {
                 margin-top: 10px !important
             }

             span.gt3_breadcrumb_divider {
                 width: 20px
             }


             .title-transparent {
                 padding: 20px 0;
             }

             .title-content h1 {
                 font-size: 24px;
                 margin-bottom: 8px;
                 text-align: left;
             }

             .breadcrumbs {
                 gap: 3px;
             }

             .breadcrumbs a,
             .breadcrumbs span.current {
                 font-size: 14px;
             }
         }
     </style>
     <section class="title-transparent page-title" id="breadcumb-mobile"
         style="background: url({{ asset($backgroundImage) }});">
         <div class="container">
             <div class="title-content">
                 @if ($showTitle)
                     <h1>{{ $title ?? 'Title' }}</h1>
                 @endif

                 <div class="breadcrumbs">
                     @foreach ($breadcrumbs as $breadcrumb)
                         @if (!$loop->first)
                             <span class="gt3_breadcrumb_divider"></span>
                         @endif

                         @if (isset($breadcrumb['route']))
                             <a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['label'] }}</a>
                         @else
                             <span class="current">{{ $breadcrumb['label'] }}</span>
                         @endif
                     @endforeach
                 </div>
             </div>
         </div>
     </section>
 </div>
