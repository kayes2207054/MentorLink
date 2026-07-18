<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MentorLink') }} - Find Your Perfect Mentor</title>
    <meta name="description" content="Connect with verified industry professionals, book one-on-one mentorship sessions, and accelerate your career growth with MentorLink.">
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
                    <span class="badge bg-primary bg-opacity-10 text-white rounded-pill px-3 py-2 mb-3 fw-bold tracking-wide border border-primary border-opacity-25 hero-badge">THE #1 MENTORING PLATFORM</span>
                    <h1 class="hero-title mb-4 font-heading fw-bolder text-white">Accelerate Your Career with <span class="text-warning">Expert Mentorship</span></h1>
                    <p class="hero-subtitle text-white opacity-75 mb-4">Connect with industry professionals, book one-on-one sessions, and achieve your goals faster than ever before.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold shadow-sm hover-lift-btn">
                            <i class="bi bi-arrow-right-circle-fill me-2"></i>Find a Mentor
                        </a>
                        <a href="#how-it-works" class="btn btn-outline-light btn-lg rounded-pill px-4 shadow-sm hover-lift-btn">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative fade-in d-flex justify-content-center" style="animation-delay: 0.2s;">
                    <!-- Floating Stats Cards -->
                    <div class="position-absolute top-50 start-0 translate-middle-y ms-n4 d-none d-xl-block z-3">
                        <div class="hero-float-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-success">
                                    <i class="bi bi-graph-up-arrow fs-2"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-white">98% Success</h6>
                                    <small class="text-muted">Placement Rate</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hero-image-frame mx-auto d-block">
                        <img src="{{ asset('images/hero_custom.png') }}" alt="Mentorship Expert">
                    </div>

                    <div class="position-absolute bottom-0 end-0 mb-5 me-n4 d-none d-xl-block z-3">
                        <div class="hero-float-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-warning">
                                    <i class="bi bi-star-fill fs-2"></i>
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
            <div class="row g-4 reveal-stagger">
                <div class="col-md-4 reveal-on-scroll">
                    <div class="stat-card p-4 text-center h-100">
                        <div class="stat-icon-wrapper d-inline-flex p-3 mb-3 text-primary fs-2">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="font-heading display-6 fw-bold text-white">10,000+</h3>
                        <p class="text-muted mb-0 fw-medium">Active Students</p>
                    </div>
                </div>
                <div class="col-md-4 reveal-on-scroll">
                    <div class="stat-card p-4 text-center h-100">
                        <div class="stat-icon-wrapper d-inline-flex p-3 mb-3 text-warning fs-2">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h3 class="font-heading display-6 fw-bold text-white">5,000+</h3>
                        <p class="text-muted mb-0 fw-medium">Verified Mentors</p>
                    </div>
                </div>
                <div class="col-md-4 reveal-on-scroll">
                    <div class="stat-card p-4 text-center h-100">
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
            <div class="text-center mb-5 reveal-on-scroll">
                <span class="section-label">Core Features</span>
                <h2 class="fw-bold mb-3 display-6 font-heading">Why Choose MentorLink?</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">We provide all the tools you need for a successful mentorship journey in one unified platform.</p>
            </div>
            <div class="row g-4 reveal-stagger">
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-elevated feature-card h-100 p-5 text-center border-0">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle shadow-lg d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 64px; height: 64px;">
                            <i class="bi bi-search fs-2"></i>
                        </div>
                        <h4 class="font-heading fw-bold mb-3">Smart Discovery</h4>
                        <p class="text-muted mb-0">Easily find mentors by expertise, specific skills, or top ratings with our advanced directory.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-elevated feature-card h-100 p-5 text-center border-0">
                        <div class="feature-icon bg-success bg-gradient text-white rounded-circle shadow-lg d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 64px; height: 64px;">
                            <i class="bi bi-calendar-event fs-2"></i>
                        </div>
                        <h4 class="font-heading fw-bold mb-3">Seamless Scheduling</h4>
                        <p class="text-muted mb-0">Book sessions directly based on your mentor's real-time availability calendar.</p>
                    </div>
                </div>
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-elevated feature-card h-100 p-5 text-center border-0">
                        <div class="feature-icon bg-warning bg-gradient text-white rounded-circle shadow-lg d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 64px; height: 64px;">
                            <i class="bi bi-shield-check fs-2"></i>
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
            <div class="card card-elevated border-0 overflow-hidden reveal-on-scroll">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6 p-5">
                        <span class="section-label">Process</span>
                        <h2 class="fw-bold mb-5 display-6 font-heading">How It Works</h2>

                        <div class="d-flex mb-5 position-relative step-item">
                            <div class="me-4 position-relative z-2">
                                <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm">1</div>
                                <div class="step-connector"></div>
                            </div>
                            <div class="pt-2">
                                <h5 class="fw-bold mb-2 text-white">Create your profile</h5>
                                <p class="text-muted mb-0">Sign up as a student or apply to be a mentor. Complete your profile to get started.</p>
                            </div>
                        </div>

                        <div class="d-flex mb-5 position-relative step-item">
                            <div class="me-4 position-relative z-2">
                                <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm">2</div>
                                <div class="step-connector"></div>
                            </div>
                            <div class="pt-2">
                                <h5 class="fw-bold mb-2 text-white">Send a request</h5>
                                <p class="text-muted mb-0">Browse the mentor directory, find your match, and send a mentorship connection request.</p>
                            </div>
                        </div>

                        <div class="d-flex step-item">
                            <div class="me-4">
                                <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm">3</div>
                            </div>
                            <div class="pt-2">
                                <h5 class="fw-bold mb-2 text-white">Book and learn</h5>
                                <p class="text-muted mb-0">Once connected, book available time slots and start your one-on-one sessions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center p-5 bg-dark bg-opacity-25 h-100 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/how-it-works.svg') }}" alt="Mentorship Session" class="img-fluid rounded-4 shadow-lg border border-light border-opacity-10" style="width: 100%; max-width: 500px; background: rgba(255,255,255,0.05); padding: 2rem;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-6 pt-4">
        <div class="container page-inner py-5">
            <div class="text-center mb-5 reveal-on-scroll">
                <span class="section-label">Success Stories</span>
                <h2 class="fw-bold mb-3 display-6 font-heading">What Our Users Say</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">Real stories from students and mentors achieving greatness on MentorLink.</p>
            </div>
            <div class="row g-4 reveal-stagger">
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-elevated testimonial-card border-0 shadow-lg h-100 p-4">
                        <span class="testimonial-quote-mark">&ldquo;</span>
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
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-elevated testimonial-card border-0 shadow-lg h-100 p-4">
                        <span class="testimonial-quote-mark">&ldquo;</span>
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
                <div class="col-md-4 reveal-on-scroll">
                    <div class="card card-elevated testimonial-card border-0 shadow-lg h-100 p-4">
                        <span class="testimonial-quote-mark">&ldquo;</span>
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
            <div class="text-center mb-5 reveal-on-scroll">
                <span class="section-label">Support</span>
                <h2 class="fw-bold mb-3 display-6 font-heading">Frequently Asked Questions</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal-on-scroll">
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item faq-item mb-3">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How do I become a mentor?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    You can sign up as a user and choose the "Mentor" role. After filling out your profile, an administrator will review and verify your account.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item faq-item mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Are sessions free?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
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
    <footer class="site-footer py-5 mt-auto">
        <div class="container page-inner reveal-on-scroll">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <a class="navbar-brand d-inline-flex align-items-center mb-4 text-white" href="{{ url('/') }}">
                        <div class="logo-icon me-2">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <span class="font-heading fw-bold fs-4">MentorLink</span>
                    </a>
                    <p class="text-muted mb-4 pe-lg-4">Empowering the next generation of professionals through expert mentorship and seamless guidance.</p>
                    <div class="d-flex gap-2">
                        <a href="https://twitter.com/MentorLink" target="_blank" rel="noopener noreferrer" class="footer-social-icon twitter" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="https://linkedin.com/company/MentorLink" target="_blank" rel="noopener noreferrer" class="footer-social-icon linkedin" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="https://facebook.com/MentorLink" target="_blank" rel="noopener noreferrer" class="footer-social-icon facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide text-white mb-4">Platform</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#features" class="footer-link">Features</a></li>
                        <li class="mb-2"><a href="#how-it-works" class="footer-link">How it Works</a></li>
                        <li class="mb-2"><a href="#testimonials" class="footer-link">Testimonials</a></li>
                        <li><a href="#faq" class="footer-link">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide text-white mb-4">Contact Us</h6>
                    <ul class="list-unstyled mb-0 text-muted">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-envelope-fill text-primary mt-1"></i>
                            <a href="mailto:support@mentorlink.com" class="footer-link">support@mentorlink.com</a>
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
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                        <input type="email" class="form-control newsletter-input border-0" placeholder="Email address" aria-label="Email address">
                        <button class="btn btn-primary newsletter-btn" type="button"><i class="bi bi-send-fill"></i></button>
                    </div>
                </div>
            </div>

            <div class="border-top border-soft pt-4 mt-4 text-center text-md-start d-md-flex justify-content-between align-items-center text-muted small">
                <p class="mb-2 mb-md-0">&copy; {{ date('Y') }} MentorLink. All rights reserved.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="javascript:void(0)" class="footer-link">Privacy Policy</a>
                    <a href="javascript:void(0)" class="footer-link">Terms of Service</a>
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

    <!-- Scroll-triggered reveal & smooth scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // IntersectionObserver for scroll-triggered reveals
            var revealEls = document.querySelectorAll('.reveal-on-scroll');
            if ('IntersectionObserver' in window && revealEls.length) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
                revealEls.forEach(function (el) { observer.observe(el); });
            } else {
                // Fallback: reveal all immediately
                revealEls.forEach(function (el) { el.classList.add('revealed'); });
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>
</body>
</html>
