@extends('layout.public.app')

@section('title', 'Liens Utiles')

@section('css')
<style>
    .page-content {
        padding: 60px 0;
    }
    .section-title {
        color: #de6600;
        margin-bottom: 30px;
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
    }
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: #de6600;
    }
    .card {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .card-body {
        padding: 30px;
    }
    .card h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .card h3 {
        color: #555;
        font-size: 18px;
        margin: 20px 0 10px;
        font-weight: 600;
    }
    .card p, .card li {
        color: #666;
        line-height: 1.7;
        margin-bottom: 15px;
    }
    .faq-item {
        margin-bottom: 20px;
    }
    .faq-question {
        font-weight: 600;
        color: #444;
        margin-bottom: 10px;
    }
    .faq-answer {
        color: #666;
    }
    .value-item {
        display: flex;
        margin-bottom: 15px;
    }
    .value-icon {
        margin-right: 15px;
        color: #de6600;
        font-size: 20px;
    }
    .step-item {
        display: flex;
        margin-bottom: 25px;
    }
    .step-number {
        background: #de6600;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }
    .step-content {
        flex: 1;
    }
    .step-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: #444;
    }
    .contact-info {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
        width: auto;
        display: flex;
        justify-content: right;
    }
    .contact-info p {
        margin-bottom: 5px;
    }
    .recruitment-option {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    .recruitment-option h4 {
        color: #de6600;
        margin-bottom: 10px;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
    @php
        $breadcrumbs = [
            ['route' => 'accueil', 'label' => 'Accueil'],
            ['label' => 'Liens Utiles'],
        ];
    @endphp

    <x-breadcumb backgroundImage="{{ asset('assets_client/img/banner/image-2.jpg') }}" :showTitle="true"
        title="Liens Utiles" :breadcrumbs="$breadcrumbs" />

    <div class="page-content">
        <div class="container">
            <!-- À propos de nous -->
            <div class="card mb-4" id="about-us">
                <div class="card-body">
                    <h2 class="section-title">Qui sommes-nous ?</h2>
                    
                    <p>Bienvenue sur Vamiyi, la plateforme numérique de référence pour vous accompagner dans votre vie quotidienne. Créée en 2025, Vamiyi est née d'un besoin concret : faciliter l'accès aux services essentiels en Afrique de l'Ouest, en mettant en relation directe les particuliers et les prestataires de services.</p>
                    
                    <h3>Notre mission</h3>
                    <p>Simplifier la vie des citoyens en leur offrant un accès centralisé à plusieurs domaines clés :</p>
                    <ul>
                        <li><strong>Logement</strong> : Cherchez, trouvez et réservez un logement adapté à vos besoins, que ce soit pour une nuit ou pour plusieurs mois.</li>
                        <li><strong>Restauration</strong> : Découvrez les meilleurs restaurants autour de vous, commandez à manger ou réservez une table.</li>
                        <li><strong>Mobilité</strong> : Louez un véhicule, trouvez un chauffeur ou explorez les solutions de transport disponibles.</li>
                        <li><strong>Sorties & loisirs</strong> : Restez informé des événements, spectacles, activités culturelles et lieux de détente.</li>
                    </ul>
                    
                    <h3>Nos valeurs</h3>
                    <div class="value-item">
                        <div class="value-icon"><i class="fa fa-check-circle"></i></div>
                        <div><strong>Accessibilité</strong> : Une plateforme intuitive, pensée pour tous les profils d'utilisateurs.</div>
                    </div>
                    <div class="value-item">
                        <div class="value-icon"><i class="fa fa-lightbulb"></i></div>
                        <div><strong>Innovation</strong> : Une interface évolutive, en constante amélioration.</div>
                    </div>
                    <div class="value-item">
                        <div class="value-icon"><i class="fa fa-map-marker"></i></div>
                        <div><strong>Ancrage local</strong> : Une priorité donnée aux talents et entreprises de nos régions.</div>
                    </div>
                    
                    <h3>Notre ambition</h3>
                    <p>Faire de Vamiyi la solution digitale incontournable pour vivre pleinement et simplement au quotidien.</p>
                </div>
            </div>

            <!-- Comment ça marche -->
            <div class="card mb-4" id="how-it-works">
                <div class="card-body">
                    <h2 class="section-title">Utiliser Vamiyi en toute simplicité</h2>
                    
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <div class="step-title">Explorez l'univers Vamiyi</div>
                            <p>Parcourez nos différentes catégories selon vos besoins. Que vous cherchiez un logement, une voiture, un bon plan sortie ou un artisan, vous trouverez des offres locales pertinentes, classées par zone géographique.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <div class="step-title">Comparez et sélectionnez</div>
                            <p>Lisez les descriptions, comparez les avis et visualisez les photos. Nos fiches sont conçues pour être claires, précises et informatives.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <div class="step-title">Contactez ou réservez</div>
                            <p>Avec ou sans compte, vous pouvez contacter un prestataire ou effectuer une réservation directe depuis la plateforme. Les échanges sont sécurisés, et votre vie privée respectée.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <div class="step-title">Profitez du service</div>
                            <p>Recevez une confirmation par e-mail et vivez l'expérience. Notre service client est disponible en cas de problème.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <div class="step-title">Laissez un avis</div>
                            <p>Partagez votre expérience avec la communauté. Les évaluations permettent d'améliorer continuellement les services proposés.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <div class="card mb-4" id="faq">
                <div class="card-body">
                    <h2 class="section-title">FAQ</h2>
                    
                    <div class="faq-item">
                        <div class="faq-question">Q1 : Comment créer un compte Vamiyi ?</div>
                        <div class="faq-answer">Rendez-vous sur la page d'inscription, remplissez le formulaire avec vos informations de base et validez. Vous recevrez un e-mail de confirmation.</div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Q2 : Est-ce que Vamiyi est gratuit ?</div>
                        <div class="faq-answer">Oui, l'utilisation de la plateforme pour consulter les offres est entièrement gratuite. La publication des annonces est soumise à un abonnement renouvelable.</div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Q3 : Quels types de services peut-on trouver sur Vamiyi ?</div>
                        <div class="faq-answer">Vous pouvez trouver des logements, restaurants, locations de voiture, événements, et plus encore.</div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Q4 : Puis-je faire confiance aux prestataires ?</div>
                        <div class="faq-answer">Tous les prestataires sont soumis à une vérification manuelle. De plus, les évaluations des utilisateurs aident à garantir un haut niveau de qualité.</div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Q5 : Vamiyi est-il disponible sur mobile ?</div>
                        <div class="faq-answer">Oui, le site est entièrement responsive. Une application mobile est également en cours de développement.</div>
                    </div>
                </div>
            </div>

            <!-- Conditions d'utilisation -->
            <div class="card mb-4" id="terms">
                <div class="card-body">
                    <h2 class="section-title">Conditions d'utilisation</h2>
                    
                    <h3>Conditions générales</h3>
                    <ul>
                        <li>L'utilisateur s'engage à utiliser la plateforme conformément aux lois en vigueur dans son pays.</li>
                        <li>Les annonces publiées doivent être véridiques et respecter les bonnes pratiques commerciales.</li>
                        <li>L'équipe de Vamiyi se réserve le droit de supprimer tout contenu inapproprié ou frauduleux.</li>
                    </ul>
                    
                    <h3>Comptes utilisateurs</h3>
                    <ul>
                        <li>Chaque utilisateur est responsable des informations qu'il publie.</li>
                        <li>La création de multiples comptes à des fins abusives est interdite.</li>
                    </ul>
                    
                    <h3>Utilisation commerciale</h3>
                    <ul>
                        <li>Les professionnels doivent s'identifier comme tels lors de la création de leur profil.</li>
                    </ul>
                    
                    <h3>Modifications des conditions</h3>
                    <ul>
                        <li>Vamiyi se réserve le droit de modifier les conditions à tout moment. Les utilisateurs seront notifiés par e-mail.</li>
                    </ul>
                </div>
            </div>

            <!-- Politique de confidentialité -->
            <div class="card mb-4" id="privacy">
                <div class="card-body">
                    <h2 class="section-title">Politique de confidentialité</h2>
                    
                    <h3>Collecte des données</h3>
                    <p>Nous collectons uniquement les données nécessaires à la bonne exécution de nos services (nom, e-mail, localisation approximative, préférences).</p>
                    
                    <h3>Utilisation</h3>
                    <p>Ces données servent à améliorer l'expérience utilisateur, personnaliser les offres et assurer la sécurité des échanges.</p>
                    
                    <h3>Conservation</h3>
                    <p>Les données sont stockées de manière sécurisée sur nos serveurs, pour une durée limitée et conforme à la législation RGPD.</p>
                    
                    <h3>Partage</h3>
                    <p>Aucune donnée personnelle n'est vendue ni partagée sans votre consentement.</p>
                    
                    <h3>Vos droits</h3>
                    <p>Vous pouvez à tout moment demander la suppression de vos données ou l'accès aux informations vous concernant.</p>
                </div>
            </div>

            <!-- Nous rejoindre -->
            <div class="card mb-4" id="join-us">
                <div class="card-body">
                    <h2 class="section-title">Nous rejoindre</h2>
                    
                    <p>Vous souhaitez faire partie de l'aventure Vamiyi ?</p>
                    <p>Nous recrutons :</p>
                    <div class="d-flex flex-column flex-md-row gap-4">
                        <div class="recruitment-option">
                            <h4>Prestataires de services</h4>
                            <p>Rejoignez une plateforme qui valorise vos compétences.</p>
                        </div>
                        
                        <div class="recruitment-option">
                            <h4>Partenaires</h4>
                            <p>Entreprises, ONG, institutions, collaborons pour des services de qualité.</p>
                        </div>
                        
                        <div class="recruitment-option">
                            <h4>Ambassadeurs locaux</h4>
                            <p>Aidez-nous à faire connaître Vamiyi dans votre quartier ou région.</p>
                        </div>
                    </div>
                    
                    
                    <div class="contact-info">
                        <p><strong>Contact :</strong> contact@vamiyi.com / +337 66 91 10 98</p>
                    </div>
                </div>
            </div>

            <!-- Politique de Cookies (unchanged) -->
            <div class="card mb-4" id="cookies">
                <div class="card-body">
                    <h2 class="section-title">Politique de Cookies</h2>
                    
                    <h3>Qu'est-ce qu'un cookie ?</h3>
                    <p>Un cookie est un petit fichier texte stocké sur votre ordinateur ou appareil mobile lorsque vous visitez un site web. Les cookies sont largement utilisés pour faire fonctionner les sites web ou les rendre plus efficaces, ainsi que pour fournir des informations aux propriétaires du site.</p>
                    
                    <h3>Comment utilisons-nous les cookies ?</h3>
                    <p>Notre site utilise des cookies pour plusieurs raisons :</p>
                    <ul>
                        <li><strong>Cookies nécessaires</strong> : Ces cookies sont essentiels au fonctionnement de notre site et ne peuvent pas être désactivés.</li>
                        <li><strong>Cookies de performance</strong> : Ces cookies nous aident à comprendre comment les visiteurs interagissent avec notre site web.</li>
                        <li><strong>Cookies de fonctionnalité</strong> : Ces cookies permettent à notre site web de se souvenir des choix que vous faites.</li>
                        <li><strong>Cookies de ciblage</strong> : Ces cookies sont utilisés pour diffuser des publicités plus pertinentes pour vous et vos intérêts.</li>
                    </ul>
                    
                    <h3>Comment gérer vos cookies</h3>
                    <p>Vous pouvez modifier vos préférences en matière de cookies à tout moment en cliquant sur le bouton "Paramètres des cookies" en bas de page. Vous pouvez également configurer votre navigateur pour refuser tous les cookies ou pour indiquer quand un cookie est envoyé.</p>
                    
                    <div class="mt-4">
                        <button id="open-cookie-settings" class="btn btn-primary">Paramètres des cookies</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Liens-utiles page script loaded');
        
        // Log all available sections with IDs
        console.log('Available sections:');
        document.querySelectorAll('.card[id]').forEach(function(section) {
            console.log(section.id, section);
        });
        
        // Handle hash in URL on page load
        if (window.location.hash) {
            const targetId = window.location.hash.substring(1);
            console.log('Hash found on page load:', targetId);
            
            const targetElement = document.getElementById(targetId);
            console.log('Target element from hash:', targetElement);
            
            if (targetElement) {
                const headerHeight = document.querySelector('header') ? document.querySelector('header').offsetHeight : 100;
                console.log('Header height:', headerHeight);
                
                setTimeout(function() {
                    console.log('Scrolling to hash target');
                    window.scrollTo({
                        top: targetElement.offsetTop - headerHeight - 20,
                        behavior: 'smooth'
                    });
                }, 500);
            } else {
                console.error('Target element not found:', targetId);
            }
        }
        
        // Also handle scroll links directly on this page
        document.querySelectorAll('.scroll-link').forEach(function(link) {
            console.log('Adding click listener to link in page:', link.getAttribute('data-section'));
            
            link.addEventListener('click', function(e) {
                const targetSection = this.getAttribute('data-section');
                console.log('Link clicked in page:', targetSection);
                
                const targetElement = document.getElementById(targetSection);
                if (targetElement) {
                    e.preventDefault();
                    const headerHeight = document.querySelector('header') ? document.querySelector('header').offsetHeight : 100;
                    
                    console.log('Scrolling to section in page:', targetSection);
                    console.log('Element position:', targetElement.offsetTop);
                    console.log('Header height:', headerHeight);
                    
                    window.scrollTo({
                        top: targetElement.offsetTop - headerHeight,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        document.getElementById('open-cookie-settings').addEventListener('click', function() {
            console.log('Cookie settings button clicked');
            // This will trigger the cookie consent modal to reopen
            if (typeof CookieConsent !== 'undefined') {
                CookieConsent.showSettings();
            }
        });
    });
</script>
@endsection


