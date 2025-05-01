@extends('layout.public.app')

@section('title', 'Déposer une annonce')

@section('css')
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        /* Modern styling for category cards */
        .category-selection {
            padding: 30px 0;
        }
        
        .selection-intro {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .selection-intro h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .selection-intro p {
            color: #666;
            font-size: 16px;
        }
        
        .category-card {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 12px;
            padding: 16px;
            text-decoration: none;
            color: #333;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            margin-bottom: 20px;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background-color: var(--category-color, #de6600);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        
        .category-card:hover::before {
            opacity: 1;
        }
        
        .category-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        
        .category-card:hover .category-icon {
            transform: scale(1.1);
        }
        
        .category-info {
            flex: 1;
        }
        
        .category-name {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 4px;
            color: #333;
        }
        
        .category-description {
            font-size: 14px;
            color: #666;
            margin: 0 0 4px;
        }
        
        .category-arrow {
            margin-left: 16px;
            color: #ccc;
            transition: all 0.3s ease;
        }
        
        .category-card:hover .category-arrow {
            transform: translateX(5px);
            color: var(--category-color, #de6600);
        }
        
        /* Help section styling */
        .help-section {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-top: 20px;
        }
        
        .help-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: rgba(0, 150, 136, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            color: #009688;
        }
        
        .help-content h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 5px;
            color: #333;
        }
        
        .help-content p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        
        .help-content a {
            color: #de6600;
            text-decoration: none;
            font-weight: 500;
        }
        
        /* Color variables for different categories */
        .bg-color-1 { --category-color: #4CAF50; background-color: rgba(76, 175, 80, 0.1); color: #4CAF50; }
        .bg-color-2 { --category-color: #2196F3; background-color: rgba(33, 150, 243, 0.1); color: #2196F3; }
        .bg-color-3 { --category-color: #FF9800; background-color: rgba(255, 152, 0, 0.1); color: #FF9800; }
        .bg-color-4 { --category-color: #03A9F4; background-color: rgba(3, 169, 244, 0.1); color: #03A9F4; }
        .bg-color-5 { --category-color: #E91E63; background-color: rgba(233, 30, 99, 0.1); color: #E91E63; }
        .bg-color-6 { --category-color: #FF5722; background-color: rgba(255, 87, 34, 0.1); color: #FF5722; }
        .bg-color-7 { --category-color: #8BC34A; background-color: rgba(139, 195, 74, 0.1); color: #8BC34A; }
        .bg-color-8 { --category-color: #9C27B0; background-color: rgba(156, 39, 176, 0.1); color: #9C27B0; }
        
        /* Animation for category cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards;
        }
        
        /* Media queries for responsive design */
        @media (min-width: 768px) {
            .category-description {
                display: block;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $breadcrumbs = [['route' => 'accueil', 'label' => 'Accueil'], ['label' => 'Déposer une annonce']];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-1.jpg') }}" :showTitle="true" :showSearchButton="true"
        title="Déposer une annonce" :breadcrumbs="$breadcrumbs" />

    <section class="category-selection">
        <div class="container">
            <div class="selection-intro">
                <h2>Choisissez une catégorie</h2>
                <p>Sélectionnez le type d'établissement pour votre annonce</p>
            </div>
            
            <div class="row">
                @foreach ($typeAnnonces as $index => $type)
                    <div class="col-md-4 col-sm-6">
                        <a href="{{ route($type->route) }}" class="category-card animate-fade-in-up" style="animation-delay: {{ $index * 0.05 }}s;">
                            <div class="category-icon bg-color-{{ ($index % 8) + 1 }}">
                                <i class="{{ $type->icon }}"></i>
                            </div>
                            <div class="category-info">
                                <h3 class="category-name">{{ $type->nom }}</h3>
                                @if(isset($type->description))
                                    <p class="category-description d-none d-md-block">{{ $type->description }}</p>
                                @endif
                                @if(isset($type->count))
                                    <span class="category-count text-muted small">{{ $type->count }} annonces</span>
                                @endif
                            </div>
                            <div class="category-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="help-section">
                <div class="help-icon">
                    <i class="fa fa-question"></i>
                </div>
                <div class="help-content">
                    <h3>Besoin d'aide?</h3>
                    <p>Vous ne trouvez pas la catégorie qui vous convient? <a href="{{ route('contact') }}">Contactez-nous</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add entrance animations to category cards
            const categoryCards = document.querySelectorAll('.category-card');
            
            categoryCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 + (index * 50));
            });
        });
    </script>
@endsection