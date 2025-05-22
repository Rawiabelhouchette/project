@php
    $typeAnnonce = App\Models\Annonce::pluck('type')->unique()->toArray();
@endphp

<style>
    /* Custom Footer Styles */
    .vamiyi-footer {
        background-color: #00796b;
        color: #ffffff;
        font-family: 'Arial', sans-serif;
    }

    .vamiyi-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .vamiyi-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .vamiyi-col {
        padding: 0 15px;
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* Updated column widths for 3-column layout */
    @media (min-width: 768px) {
        .vamiyi-col {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (min-width: 992px) {
        .vamiyi-col {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        /* Make the first column wider for better balance */
        .vamiyi-col-wide {
            flex: 0 0 40%;
            max-width: 40%;
        }

        .vamiyi-col-narrow {
            flex: 0 0 30%;
            max-width: 30%;
        }
    }

    /* Newsletter section styles */
    .vamiyi-newsletter {
        padding: 30px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .vamiyi-newsletter-content {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    @media (min-width: 768px) {
        .vamiyi-newsletter-content {
            flex-direction: row;
            align-items: center;
        }

        .vamiyi-newsletter-text {
            flex: 0 0 50%;
        }

        .vamiyi-newsletter-form {
            flex: 0 0 45%;
            margin-left: auto;
        }
    }

    .vamiyi-newsletter-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .vamiyi-newsletter-desc {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 10px;
    }

    /* Fixed form styles for better responsiveness */
    .vamiyi-form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
    }

    .vamiyi-input {
        width: 100%;
        padding: 12px 15px;
        border: none;
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        border-radius: 4px;
    }

    .vamiyi-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .vamiyi-btn {
        width: 100%;
        padding: 12px 20px;
        background-color: #ffffff;
        color: #00796b;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background-color 0.3s;
    }

    .vamiyi-btn:hover {
        background-color: #e0f2f1;
    }

    /* Responsive form adjustments */
    @media (min-width: 480px) {
        .vamiyi-form-group {
            flex-direction: row;
        }

        .vamiyi-input {
            flex: 1;
        }

        .vamiyi-btn {
            width: auto;
        }
    }

    .vamiyi-main-footer {
        padding: 60px 0;
    }

    .vamiyi-widget {
        margin-bottom: 30px;
    }

    .vamiyi-widget-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .vamiyi-widget-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: #4db6ac;
    }

    .vamiyi-widget-text {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .vamiyi-social {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .vamiyi-social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: #ffffff;
        transition: background-color 0.3s;
    }

    .vamiyi-social-link:hover {
        background-color: #4db6ac;
    }

    .vamiyi-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .vamiyi-list-item {
        margin-bottom: 10px;
    }

    .vamiyi-list-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.3s;
    }

    .vamiyi-list-link:hover {
        color: #ffffff;
    }

    .vamiyi-list-link:hover .vamiyi-arrow {
        opacity: 1;
    }

    .vamiyi-arrow {
        margin-right: 8px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .vamiyi-contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        color: rgba(255, 255, 255, 0.8);
    }

    .vamiyi-contact-icon {
        margin-right: 10px;
        color: #4db6ac;
    }

    .vamiyi-contact-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s;
    }

    .vamiyi-contact-link:hover {
        color: #ffffff;
    }

    .vamiyi-copyright {
        background-color: rgba(0, 0, 0, 0.1);
        padding: 20px 0;
        text-align: center;
    }

    .vamiyi-copyright-content {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    @media (min-width: 768px) {
        .vamiyi-copyright-content {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .vamiyi-copyright-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
    }

    .vamiyi-copyright-link {
        color: #ffffff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .vamiyi-copyright-link:hover {
        color: #4db6ac;
    }

    .vamiyi-footer-links {
        display: flex;
        gap: 20px;
    }

    .vamiyi-footer-link {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
    }

    .vamiyi-footer-link:hover {
        color: #ffffff;
    }

    /* Back to top button */
    .vamiyi-back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background-color: #de6600;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s, transform 0.3s;
        z-index: 99;
    }

    .vamiyi-back-to-top:hover {
        background-color: white;
        color: #de6600;
        transform: translateY(-3px);
    }
</style>

<footer class="vamiyi-footer">

    <!-- Main Footer Content -->
    <div class="vamiyi-main-footer">
        <div class="vamiyi-container">
            <div class="vamiyi-row">
                <!-- About Column -->
                <div class="vamiyi-col vamiyi-col-wide">
                    <div class="vamiyi-widget">
                        <h3 class="vamiyi-widget-title">Vamiyi</h3>
                         <p class="vamiyi-widget-text">
                            {{-- Nous sommes une plateforme qui permet aux professionnels de différents secteurs (restaurants, hôtels, locations de véhicules, divertissement, etc.) de publier des annonces, de créer leur site vitrine et de gagner en visibilité. Avec Vamiyi, connectez-vous à votre clientèle et développez votre activité en toute simplicité ! --}}
                            Vamiyi est une plateforme tout-en-un conçue pour les professionnels du tourisme, de la restauration, de la location de véhicule et des loisirs.
                            <br>
                            Grâce à Vamiyi, vous pouvez facilement publier vos annonces, créer votre propre mini-site, présenter vos services en quelques clics et booster votre visibilité en ligne.
                            Gagnez en visibilité, attirez de nouveaux clients et gérez votre activité depuis une interface simple et intuitive.
                            <br>
                            Avec Vamiyi, vous êtes visible là où vos clients vous cherchent.
                        </p>
                        <div class="vamiyi-social">
                            <a href="{{ env('FACEBOOK_URL') }}" class="vamiyi-social-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="{{ env('INSTAGRAM_URL') }}" class="vamiyi-social-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            {{-- <a href="#" class="vamiyi-social-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="vamiyi-social-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                </svg>
                            </a> --}}
                            <a href="{{ env('TIKTOK_URL') }}" class="vamiyi-social-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 8.5a5 5 0 0 0 4 0V6.1a6.7 6.7 0 0 1-4-1.3V2h-3v13a2.5 2.5 0 1 1-2.5-2.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Column -->
                <div class="vamiyi-col vamiyi-col-narrow">
                    <div class="vamiyi-widget">
                        <h3 class="vamiyi-widget-title">Nous retrouver</h3>
                        <div class="vamiyi-contact-list">
                            <div class="vamiyi-contact-item">
                                <span class="vamiyi-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </span>
                                <a href="https://goo.gl/maps/MBJGNz6obPGrMjjH6" class="vamiyi-contact-link" target="_blank">
                                    Togo - France
                                </a>
                            </div>
                            <div class="vamiyi-contact-item">
                                <span class="vamiyi-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </span>
                                <a href="mailto:service.client@vamiyi.com" class="vamiyi-contact-link">
                                    service.client@vamiyi.com
                                </a>
                            </div>
                            <div class="vamiyi-contact-item">
                                <span class="vamiyi-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </span>
                                <a href="tel:{{ env('APP_PHONE') }}" class="vamiyi-contact-link">
                                    {{ env('APP_PHONE') }}
                                </a>
                            </div>
                            <div class="vamiyi-contact-item">
                                <span class="vamiyi-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16.72 13.06c-.29-.15-1.71-.84-1.98-.93-.27-.09-.47-.15-.67.15s-.77.93-.95 1.12c-.17.18-.35.2-.65.06-.3-.15-1.25-.46-2.38-1.48-.88-.79-1.47-1.77-1.64-2.07-.17-.3 0-.46.13-.61.14-.15.3-.35.45-.52.15-.18.2-.3.3-.5.1-.21.05-.39-.02-.55-.06-.15-.67-1.6-.92-2.19-.24-.58-.5-.5-.67-.51-.17-.01-.37-.01-.57-.01s-.53.08-.81.39c-.28.3-1.06 1.04-1.06 2.53 0 1.49 1.09 2.93 1.25 3.13.15.2 2.13 3.26 5.18 4.57.72.31 1.29.5 1.73.64.73.23 1.39.2 1.92.12.59-.09 1.81-.74 2.07-1.46.26-.72.26-1.34.18-1.46-.07-.13-.26-.2-.55-.34z" />
                                        <path d="M12 2a10 10 0 0 0-8.1 15.8L2 22l4.3-1.1A10 10 0 1 0 12 2z" />
                                    </svg>
                                </span>
                                <a href="https://wa.me/{{ str_replace(' ', '', '337 66 91 10 98') }}" class="vamiyi-contact-link">
                                    {{ env('APP_PHONE') }}
                                </a>
                            </div>
                            {{-- <div class="vamiyi-contact-item">
                                <span class="vamiyi-contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                </span>
                                <a href="http://numdoc.numrod.fr/" class="vamiyi-contact-link" target="_blank">
                                    www.numrod.com
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Links Column -->
                <div class="vamiyi-col vamiyi-col-narrow">
                    <div class="vamiyi-widget">
                        <h3 class="vamiyi-widget-title">Liens utiles</h3>
                        <ul class="vamiyi-list">
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#about-us" class="vamiyi-list-link scroll-link" data-section="about-us">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    À propos de nous
                                </a>
                            </li>
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#how-it-works" class="vamiyi-list-link scroll-link" data-section="how-it-works">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    Comment ça marche
                                </a>
                            </li>
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#faq" class="vamiyi-list-link scroll-link" data-section="faq">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    FAQ
                                </a>
                            </li>
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#terms" class="vamiyi-list-link scroll-link" data-section="terms">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    Conditions d'utilisation
                                </a>
                            </li>
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#privacy" class="vamiyi-list-link scroll-link" data-section="privacy">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    Politique de confidentialité
                                </a>
                            </li>
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#join-us" class="vamiyi-list-link scroll-link" data-section="join-us">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    Nous rejoindre
                                </a>
                            </li>
                            <li class="vamiyi-list-item">
                                <a href="{{ route('liens-utiles') }}#cookies" class="vamiyi-list-link scroll-link" data-section="cookies">
                                    <span class="vamiyi-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    Cookies
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="vamiyi-newsletter">
        <div class="vamiyi-container">
            <div class="vamiyi-newsletter-content">
                <div class="vamiyi-newsletter-text">
                    <h3 class="vamiyi-newsletter-title">Restez informé</h3>
                    <p class="vamiyi-newsletter-desc">
                        Inscrivez-vous à notre newsletter pour recevoir nos dernières offres et actualités
                    </p>
                </div>
                <div class="vamiyi-newsletter-form">
                    <form class="vamiyi-form-group">
                        <input type="email" class="vamiyi-input" placeholder="Votre adresse email" required>
                        <button type="submit" class="vamiyi-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 2L11 13"></path>
                                <path d="M22 2L15 22L11 13L2 9L22 2Z"></path>
                            </svg>
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="vamiyi-copyright">
        <div class="vamiyi-container">
            <div class="vamiyi-copyright-content">
                <p class="vamiyi-copyright-text">
                    Copyright &copy; {{ date('Y') }} Vamiyi. Tous droits réservés. Propulsé par
                    <a href="https://www.numrod.com" class="vamiyi-copyright-link">Numrod</a>
                </p>
                <!--<div class="vamiyi-footer-links">
                    <a href="#" class="vamiyi-footer-link">Conditions</a>
                    <a href="#" class="vamiyi-footer-link">Confidentialité</a>
                    
                </div>-->
            </div>
        </div>
    </div>

    <!-- Back to top button -->
    <a id="back-to-top" href="#" class="vamiyi-back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </a>
</footer>

<script>
    // Back to top button functionality
    document.addEventListener('DOMContentLoaded', function() {    
        var backToTopButton = document.getElementById('back-to-top');

        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'flex';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        // Initial check
        if (window.pageYOffset > 300) {
            backToTopButton.style.display = 'flex';
        } else {
            backToTopButton.style.display = 'none';
        }

        // Smooth scroll to top when clicked
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Handle scroll links in footer
        const scrollLinks = document.querySelectorAll('.scroll-link');
        console.log('Found scroll links:', scrollLinks.length);
        
        scrollLinks.forEach(function(link) {
            console.log('Adding click listener to:', link.getAttribute('data-section'));
            
            link.addEventListener('click', function(e) {
                console.log('Link clicked:', this.getAttribute('data-section'));
                
                const currentPath = window.location.pathname;
                const liensUtilesPath = "{{ route('liens-utiles') }}".split('?')[0]; // Remove any query parameters
                const targetSection = this.getAttribute('data-section');
                
                console.log('Current path:', currentPath);
                console.log('Liens utiles path:', liensUtilesPath);
                
                // If we're already on the liens-utiles page
                if (currentPath === liensUtilesPath || currentPath === liensUtilesPath + '/') {
                    e.preventDefault();
                    console.log('On liens-utiles page, preventing default');
                    
                    const targetElement = document.getElementById(targetSection);
                    console.log('Target element:', targetElement);
                    
                    if (targetElement) {
                        // Get the header height for offset calculation
                        const headerHeight = document.querySelector('header') ? document.querySelector('header').offsetHeight : 100;
                        
                        console.log('Scrolling to section:', targetSection);
                        console.log('Element position:', targetElement.offsetTop);
                        console.log('Header height:', headerHeight);
                        
                        // Smooth scroll to the element with proper offset
                        window.scrollTo({
                            top: targetElement.offsetTop - headerHeight - 20, // Additional 20px for spacing
                            behavior: 'smooth'
                        });
                    } else {
                        console.error('Target element not found:', targetSection);
                    }
                } else {
                    console.log('Not on liens-utiles page, allowing default navigation');
                    // Let the default link behavior happen
                }
            });
        });
        
        // Check if we need to scroll to a section after page load (coming from another page)
        window.addEventListener('load', function() {
            console.log('Page loaded, checking for hash');
            
            // If there's a hash in the URL
            if (window.location.hash) {
                const targetId = window.location.hash.substring(1); // Remove the # character
                console.log('Hash found:', targetId);
                
                const targetElement = document.getElementById(targetId);
                console.log('Target element from hash:', targetElement);
                
                if (targetElement) {
                    // Get the header height for offset calculation
                    const headerHeight = document.querySelector('header') ? document.querySelector('header').offsetHeight : 100;
                    
                    // Add a slight delay to ensure the page is fully loaded
                    setTimeout(function() {
                        console.log('Scrolling to hash target');
                        window.scrollTo({
                            top: targetElement.offsetTop - headerHeight - 20, // Additional 20px for spacing
                            behavior: 'smooth'
                        });
                    }, 500); // Increased delay for better reliability
                } else {
                    console.error('Target element not found:', targetId);
                }
            }
        });
    });
</script>