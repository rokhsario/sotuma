@extends('frontend.layouts.master')

@section('title','SOTUMA')

@section('main-content')
<!-- Hero Section -->
<section class="about-hero position-relative" style="min-height:60vh; background:url('{{ asset('images/image1.png') }}') center/cover no-repeat;">
    <div class="hero-overlay position-absolute w-100 h-100" style="background:rgba(30,30,30,0.55);"></div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative" style="z-index:2; min-height:60vh;">
        <h1 class="display-3 text-white font-weight-bold mb-3" style="letter-spacing:2px;">À propos de SOTUMA</h1>
        <p class="lead text-white" style="font-size:1.5rem; max-width:700px;">L’excellence dans la menuiserie aluminium, l’innovation et la qualité au service de vos projets.</p>
    </div>
</section>

<!-- Présentation Section -->
<section class="about-presentation py-5" style="background:linear-gradient(90deg, #f8f5f0 60%, #fff 100%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 order-lg-2 d-flex justify-content-center p-0">
                <div class="presentation-image w-100 h-100" style="min-height:400px; background:url('{{ asset('images/image2.png') }}') center/cover no-repeat;"></div>
					</div>
            <div class="col-lg-6 order-lg-1 d-flex align-items-center p-0">
                <div class="presentation-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">Présentation</h2>
                    <p>
                        Fondée en 2014, SOTUMA est une entreprise spécialisée dans la fabrication et l’installation de menuiseries en aluminium. Grâce à une expertise consolidée au fil des années et à une équipe hautement qualifiée, SOTUMA s’est imposée comme un acteur de référence dans son domaine. L’entreprise a su mener à bien de nombreux projets d’envergure, en répondant aux attentes d’une clientèle diversifiée, allant des particuliers aux grandes entreprises, avec le même souci de qualité, de durabilité et de précision.
                    </p>
                    <p>
                        Sous la direction d’un ingénieur expérimenté, SOTUMA met un point d'honneur à proposer des solutions techniques performantes, personnalisées et parfaitement adaptées aux exigences de chaque projet. Cette approche sur mesure, alliée à une maîtrise approfondie des matériaux et des procédés, garantit la satisfaction totale des clients ainsi que la pérennité des réalisations.
                    </p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Notre Mission Section -->
<section class="about-mission py-5" style="background:linear-gradient(90deg, #fff 0%, #f8f5f0 40%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="mission-image w-100 h-100" style="min-height:400px; background:url('{{ asset('images/image3.png') }}') center/cover no-repeat;"></div>
            </div>
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="mission-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">Notre Mission</h2>
                    <p>
                        Notre mission est simple : concevoir et installer des menuiseries aluminium durables, esthétiques et parfaitement adaptées aux besoins de nos clients. Nous mettons un point d'honneur à allier performance technique et design moderne, en respectant les normes les plus strictes du secteur.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Objectifs Section -->
<section class="about-objectifs py-5" style="background:linear-gradient(90deg, #f8f5f0 60%, #fff 100%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="objectifs-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1; min-height:400px;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">Nos Objectifs</h2>
                    <p>
                        Chez SOTUMA, nous nous engageons à accompagner nos clients à chaque étape de leurs projets, en leur offrant des solutions innovantes et personnalisées. Notre objectif est de bâtir des relations durables fondées sur la confiance, la qualité et la satisfaction totale. Nous croyons que chaque projet mérite une attention particulière et une exécution irréprochable, quels que soient sa taille ou sa complexité.<br><br>
                        Être un partenaire de confiance pour tous vos projets architecturaux et industriels. Répondre à une clientèle diversifiée, allant des particuliers aux grands groupes. Proposer des solutions sur mesure, pensées dans les moindres détails. Garantir une exécution rigoureuse, dans les délais impartis.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="objectifs-image w-100 h-100" style="min-height:400px; background:url('{{ asset('images/image4.png') }}') center/cover no-repeat;"></div>
							</div>
						</div>
					</div>
</section>

<!-- Notre Expertise Section -->
<section class="about-expertise py-5" style="background:linear-gradient(90deg, #fff 0%, #f8f5f0 40%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="expertise-image w-100 h-100" style="min-height:400px; background:url('{{ asset('images/image5.png') }}') center/cover no-repeat;"></div>
            </div>
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="expertise-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1; min-height:400px;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">Notre Expertise</h2>
                    <p>
                        Grâce à plus de 10 ans d'expérience, SOTUMA maîtrise l'ensemble de la chaîne de production :<br><br>
                        Conception sur mesure avec modélisation 3D, choix de matériaux haut de gamme, assemblage et installation professionnelle, suivi post-livraison et maintenance si nécessaire.<br><br>
                        Nous intervenons sur une large gamme de projets : fenêtres, portes, façades vitrées, garde-corps, cloisons, vérandas, pergolas, etc.
                    </p>
						</div>
					</div>
				</div>
			</div>
	</section>

<!-- Notre Approche Section -->
<section class="about-approche py-5" style="background:linear-gradient(90deg, #f8f5f0 60%, #fff 100%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="approche-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1; min-height:400px;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">Notre Approche</h2>
                    <p>
                        Chez SOTUMA, nous croyons que chaque projet mérite une solution unique. C’est pourquoi nous adoptons une approche collaborative et personnalisée, en vous accompagnant de la phase de conception jusqu’à la réception finale.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="approche-image w-100 h-100" style="min-height:400px; background:url('{{ asset('images/image6.png') }}') center/cover no-repeat;"></div>
            </div>
        </div>
    </div>
</section>
<!-- Mission & Vision Section -->
<section class="about-mission-vision py-5 position-relative" style="background:url('https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;">
    <div class="mission-overlay position-absolute w-100 h-100" style="background:rgba(0,0,0,0.5);"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">
                <h2 class="section-title mb-4" style="font-size:2.3rem; font-weight:700;">Notre Mission & Vision</h2>
                <p class="lead mb-2" style="font-size:1.3rem; color:#fff;">Notre mission est de repousser les limites de l'innovation et de la qualité dans notre secteur, tout en restant fidèles à nos valeurs fondamentales.</p>
                <p style="font-size:1.1rem; color:#fff;">Notre vision est de devenir le leader incontesté, reconnu pour notre engagement envers l'excellence et la satisfaction de nos clients.</p>
            </div>
					</div>
				</div>
</section>
<!-- Key Values / Features Section -->
<section class="about-values py-5" style="background:#fff;">
    <div class="container">
        <h2 class="section-title text-center mb-5" style="font-size:2.2rem; font-weight:700;">Nos Valeurs Clés</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="value-box p-5 h-100 shadow-sm rounded text-center" style="background:#f8f5f0;">
                    <img src="https://img.icons8.com/ios-filled/50/000000/idea.png" alt="Innovation" class="mb-3" style="height:48px;">
                    <h4 style="font-weight:700; font-size:2rem;">Innovation</h4>
                    <p style="font-size:1.25rem;">Nous innovons constamment pour offrir les meilleures solutions à nos clients.</p>
					</div>
				</div>
            <div class="col-md-4 mb-4">
                <div class="value-box p-5 h-100 shadow-sm rounded text-center" style="background:#f8f5f0;">
                    <img src="https://img.icons8.com/ios-filled/50/000000/checked--v1.png" alt="Qualité" class="mb-3" style="height:48px;">
                    <h4 style="font-weight:700; font-size:2rem;">Qualité</h4>
                    <p style="font-size:1.25rem;">La qualité est au cœur de tout ce que nous faisons, sans compromis.</p>
					</div>
				</div>
            <div class="col-md-4 mb-4">
                <div class="value-box p-5 h-100 shadow-sm rounded text-center" style="background:#f8f5f0;">
                    <img src="https://img.icons8.com/ios-filled/50/000000/handshake.png" alt="Intégrité" class="mb-3" style="height:48px;">
                    <h4 style="font-weight:700; font-size:2rem;">Intégrité</h4>
                    <p style="font-size:1.25rem;">Nous agissons avec honnêteté, transparence et respect envers tous nos partenaires.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

<!-- Call to Action / Contact Info Section -->
<section class="about-cta py-5 position-relative" style="background:url('{{ asset('images/image7.png') }}') center/cover no-repeat; background-size:100% 100%;">
    <div class="cta-overlay position-absolute w-100 h-100" style="background:rgba(30,30,30,0.7); top:1px;"></div>
    <div class="container text-center position-relative" style="z-index:2;">
        <h2 class="section-title mb-4 text-white" style="font-size:2.3rem; font-weight:700;">Contactez-nous</h2>
        <p class="lead mb-4 text-white" style="font-size:1.3rem;">Vous souhaitez en savoir plus ou collaborer avec nous ? N'hésitez pas à nous contacter !</p>
        <a href="/contact" class="btn btn-lg btn-primary px-5 py-3" style="font-size:1.2rem; font-weight:600; letter-spacing:1px;">Nous contacter</a>
    </div>
</section>
@endsection
