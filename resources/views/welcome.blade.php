<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MentorLink') }} - Find Your Perfect Mentor</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="antialiased">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-glass sticky-top py-3">
        <div class="container page-inner">
            <a class="navbar-brand d-flex align-items-center fade-in" href="{{ url('/') }}">
                <div class="logo-icon me-2">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                MentorLink
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fade-in" id="navbarNav" style="animation-delay: 0.1s;">
                <ul class="navbar-nav me-auto fw-medium">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How it Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                </ul>
                <div class="d-flex gap-3 align-items-center mt-3 mt-lg-0">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary rounded-pill px-4 hover-lift-btn">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-decoration-none text-muted fw-semibold px-2 hover-lift">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill text-white shadow-sm hover-lift-btn px-4">Get Started Free</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="page-hero shadow-sm" style="margin-bottom: 0;">
        <div class="container page-inner page-hero-inner">
            <div class="row align-items-center py-5">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0 fade-in">
                    <span class="badge bg-primary bg-opacity-10 text-white rounded-pill px-3 py-2 mb-3 fw-bold tracking-wide border border-primary border-opacity-25">THE #1 MENTORING PLATFORM</span>
                    <h1 class="hero-title mb-4 font-heading display-4 fw-bolder text-white">Accelerate Your Career with <span class="text-warning">Expert Mentorship</span></h1>
                    <p class="hero-subtitle text-white opacity-75 fs-5 mb-4">Connect with industry professionals, book one-on-one sessions, and achieve your goals faster than ever before.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-4 text-primary fw-bold shadow-sm hover-lift-btn">Find a Mentor</a>
                        <a href="#how-it-works" class="btn btn-outline-light btn-lg rounded-pill px-4 shadow-sm hover-lift-btn">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative fade-in" style="animation-delay: 0.2s;">
                    <!-- Floating Stats Cards -->
                    <div class="position-absolute top-50 start-0 translate-middle-y ms-n4 d-none d-xl-block hover-lift z-3">
                        <div class="card card-elevated p-3 border-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success bg-opacity-25 p-2 rounded-circle text-success">
                                    <i class="bi bi-graph-up-arrow fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-white">98% Success</h6>
                                    <small class="text-muted">Placement Rate</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <img src="{{ asset('images/hero_custom.png') }}" alt="Mentorship Expert" class="img-fluid rounded-circle shadow-lg mx-auto d-block border border-4 border-opacity-25 border-white position-relative z-2" style="width: 80%; object-fit: cover; aspect-ratio: 1/1;">
                    
                    <div class="position-absolute bottom-0 end-0 mb-5 me-n4 d-none d-xl-block hover-lift z-3">
                        <div class="card card-elevated p-3 border-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-25 p-2 rounded-circle text-warning">
                                    <i class="bi bi-star-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-white">4.9/5 Rating</h6>
                                    <small class="text-muted">Avg Mentor Score</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <section class="py-6 position-relative z-2" style="margin-top: -3rem;">
        <div class="container page-inner">
            <div class="row fade-in g-4">
                <div class="col-md-4">
                    <div class="stat-card p-4 text-center hover-lift h-100">
                        <div class="stat-icon-wrapper d-inline-flex p-3 mb-3 text-primary fs-2">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="font-heading display-6 fw-bold text-white">10,000+</h3>
                        <p class="text-muted mb-0 fw-medium">Active Students</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-4 text-center hover-lift h-100">
                        <div class="stat-icon-wrapper d-inline-flex p-3 mb-3 text-warning fs-2">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h3 class="font-heading display-6 fw-bold text-white">5,000+</h3>
                        <p class="text-muted mb-0 fw-medium">Verified Mentors</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-4 text-center hover-lift h-100">
                        <div class="stat-icon-wrapper d-inline-flex p-3 mb-3 text-success fs-2">
                            <i class="bi bi-calendar2-check-fill"></i>
                        </div>
                        <h3 class="font-heading display-6 fw-bold text-white">50,000+</h3>
                        <p class="text-muted mb-0 fw-medium">Sessions Completed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-6 pt-5">
        <div class="container page-inner py-5">
            <div class="text-center mb-5 fade-in">
                <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Core Features</span>
                <h2 class="fw-bold mb-3 display-6 font-heading">Why Choose MentorLink?</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">We provide all the tools you need for a successful mentorship journey in one unified platform.</p>
            </div>
            <div class="row g-4 fade-in">
                <div class="col-md-4">
                    <div class="card card-elevated h-100 p-5 text-center hover-lift border-0">
                        <div class="bg-primary bg-opacity-25 text-primary rounded-circle d-inline-flex mx-auto p-4 mb-4 shadow-sm">
                            <i class="bi bi-search fs-1"></i>
                        </div>
                        <h4 class="font-heading fw-bold mb-3">Smart Discovery</h4>
                        <p class="text-muted mb-0">Easily find mentors by expertise, specific skills, or top ratings with our advanced directory.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-elevated h-100 p-5 text-center hover-lift border-0">
                        <div class="bg-success bg-opacity-25 text-success rounded-circle d-inline-flex mx-auto p-4 mb-4 shadow-sm">
                            <i class="bi bi-calendar-event fs-1"></i>
                        </div>
                        <h4 class="font-heading fw-bold mb-3">Seamless Scheduling</h4>
                        <p class="text-muted mb-0">Book sessions directly based on your mentor's real-time availability calendar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-elevated h-100 p-5 text-center hover-lift border-0">
                        <div class="bg-warning bg-opacity-25 text-warning rounded-circle d-inline-flex mx-auto p-4 mb-4 shadow-sm">
                            <i class="bi bi-shield-check fs-1"></i>
                        </div>
                        <h4 class="font-heading fw-bold mb-3">Verified Experts</h4>
                        <p class="text-muted mb-0">Every mentor is manually verified by our admins to ensure top-quality guidance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-6 position-relative">
        <div class="container page-inner py-5">
            <div class="card card-elevated border-0 overflow-hidden">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6 p-5 fade-in">
                        <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Process</span>
                        <h2 class="fw-bold mb-5 display-6 font-heading">How It Works</h2>
                        
                        <div class="d-flex mb-5 position-relative">
                            <div class="me-4 position-relative z-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.25rem;">1</div>
                                <div class="position-absolute" style="left: 28px; top: 56px; bottom: -40px; width: 2px; background: rgba(255,255,255,0.1); z-index: -1;"></div>
                            </div>
                            <div class="pt-2">
                                <h5 class="fw-bold mb-2 text-white">Create your profile</h5>
                                <p class="text-muted mb-0">Sign up as a student or apply to be a mentor. Complete your profile to get started.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-5 position-relative">
                            <div class="me-4 position-relative z-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.25rem;">2</div>
                                <div class="position-absolute" style="left: 28px; top: 56px; bottom: -40px; width: 2px; background: rgba(255,255,255,0.1); z-index: -1;"></div>
                            </div>
                            <div class="pt-2">
                                <h5 class="fw-bold mb-2 text-white">Send a request</h5>
                                <p class="text-muted mb-0">Browse the mentor directory, find your match, and send a mentorship connection request.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="me-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.25rem;">3</div>
                            </div>
                            <div class="pt-2">
                                <h5 class="fw-bold mb-2 text-white">Book and learn</h5>
                                <p class="text-muted mb-0">Once connected, book available time slots and start your one-on-one sessions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 fade-in text-center p-5 bg-dark bg-opacity-25 h-100 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/how-it-works.svg') }}" alt="Mentorship Session" class="img-fluid rounded-4 shadow-lg border border-light border-opacity-10" style="width: 100%; max-width: 500px; background: rgba(255,255,255,0.05); padding: 2rem;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-6 pt-4">
        <div class="container page-inner py-5">
            <div class="text-center mb-5 fade-in">
                <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Success Stories</span>
                <h2 class="fw-bold mb-3 display-6 font-heading">What Our Users Say</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">Real stories from students and mentors achieving greatness on MentorLink.</p>
            </div>
            <div class="row g-4 fade-in">
                <div class="col-md-4">
                    <div class="card card-elevated border-0 shadow-lg h-100 p-4 hover-lift">
                        <div class="card-body">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4 lh-lg">"MentorLink helped me land my first software engineering job. The guidance I received was invaluable!"</p>
                            <div class="d-flex align-items-center mt-auto">
                                <img src="https://ui-avatars.com/api/?name=Sarah+J&background=6366f1&color=fff" alt="Sarah J" class="rounded-circle me-3 border border-light border-opacity-25" width="56">
                                <div>
                                    <h6 class="fw-bold text-white mb-0">Sarah J.</h6>
                                    <small class="text-muted">Computer Science Student</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-elevated border-0 shadow-lg h-100 p-4 hover-lift">
                        <div class="card-body">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4 lh-lg">"Being a mentor here allows me to give back to the community. The booking system is seamless and easy to use."</p>
                            <div class="d-flex align-items-center mt-auto">
                                <img src="https://ui-avatars.com/api/?name=David+Chen&background=34d399&color=fff" alt="David Chen" class="rounded-circle me-3 border border-light border-opacity-25" width="56">
                                <div>
                                    <h6 class="fw-bold text-white mb-0">David Chen</h6>
                                    <small class="text-muted">Senior Developer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-elevated border-0 shadow-lg h-100 p-4 hover-lift">
                        <div class="card-body">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4 lh-lg">"I found the perfect mentor for UI/UX design. The platform made it so easy to connect and schedule sessions."</p>
                            <div class="d-flex align-items-center mt-auto">
                                <img src="https://ui-avatars.com/api/?name=Elena+R&background=38bdf8&color=fff" alt="Elena R" class="rounded-circle me-3 border border-light border-opacity-25" width="56">
                                <div>
                                    <h6 class="fw-bold text-white mb-0">Elena R.</h6>
                                    <small class="text-muted">Design Student</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-6 pt-4 mb-5">
        <div class="container page-inner py-5">
            <div class="text-center mb-5 fade-in">
                <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Support</span>
                <h2 class="fw-bold mb-3 display-6 font-heading">Frequently Asked Questions</h2>
            </div>
            <div class="row justify-content-center fade-in">
                <div class="col-lg-8">
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item border-0 mb-3 shadow-lg rounded-4 overflow-hidden" style="background: var(--ml-card-bg); backdrop-filter: blur(12px);">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-bold px-4 py-4 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background: transparent;">
                                    How do I become a mentor?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted px-4 pb-4 pt-0 border-top border-soft mx-3 mt-2">
                                    You can sign up as a user and choose the "Mentor" role. After filling out your profile, an administrator will review and verify your account.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 shadow-lg rounded-4 overflow-hidden" style="background: var(--ml-card-bg); backdrop-filter: blur(12px);">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold px-4 py-4 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background: transparent;">
                                    Are sessions free?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted px-4 pb-4 pt-0 border-top border-soft mx-3 mt-2">
                                    Currently, MentorLink provides a platform for free mentorship connections to help students grow their careers.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 mt-auto border-top border-soft" style="background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(12px);">
        <div class="container page-inner fade-in">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <a class="navbar-brand d-inline-flex align-items-center mb-4 text-white" href="{{ url('/') }}">
                        <div class="logo-icon me-2">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <span class="font-heading fw-bold fs-4">MentorLink</span>
                    </a>
                    <p class="text-muted mb-4 pe-lg-4">Empowering the next generation of professionals through expert mentorship and seamless guidance.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted text-decoration-none hover-lift"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-muted text-decoration-none hover-lift"><i class="bi bi-linkedin fs-5"></i></a>
                        <a href="#" class="text-muted text-decoration-none hover-lift"><i class="bi bi-github fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide text-white mb-4">Platform</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#features" class="text-muted text-decoration-none d-inline-block transition-all hover:text-white">Features</a></li>
                        <li class="mb-2"><a href="#how-it-works" class="text-muted text-decoration-none d-inline-block transition-all hover:text-white">How it Works</a></li>
                        <li class="mb-2"><a href="#testimonials" class="text-muted text-decoration-none d-inline-block transition-all hover:text-white">Testimonials</a></li>
                        <li><a href="#faq" class="text-muted text-decoration-none d-inline-block transition-all hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide text-white mb-4">Contact Us</h6>
                    <ul class="list-unstyled mb-0 text-muted">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-envelope-fill text-primary mt-1"></i>
                            <span>support@mentorlink.com</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-primary mt-1"></i>
                            <span>123 Education Lane<br>Tech City, TC 10101</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide text-white mb-4">Newsletter</h6>
                    <p class="text-muted small mb-3">Subscribe to get the latest updates and mentoring tips.</p>
                    <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                        <input type="email" class="form-control border-0" placeholder="Email address" aria-label="Email address" style="background: rgba(255,255,255,0.05); color: white;">
                        <button class="btn btn-primary px-3" type="button"><i class="bi bi-send-fill"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="border-top border-soft pt-4 mt-4 text-center text-md-start d-md-flex justify-content-between align-items-center text-muted small">
                <p class="mb-2 mb-md-0">&copy; {{ date('Y') }} MentorLink. All rights reserved.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Small overrides for accordion icon colors in dark mode */
        .accordion-button::after {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .accordion-button:not(.collapsed)::after {
            filter: invert(0.5) sepia(1) saturate(5) hue-rotate(200deg);
        }
    </style>
</body>
</html>
