<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MentorLink') }} - Find Your Perfect Mentor</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #334155;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0f172a !important;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 400px;
            height: 400px;
            background: rgba(13, 110, 253, 0.05);
            border-radius: 50%;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero-title {
            font-weight: 800;
            font-size: 4rem;
            color: #0f172a;
            letter-spacing: -0.05rem;
            line-height: 1.1;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            color: #475569;
            margin-bottom: 2.5rem;
        }
        .feature-card {
            border: none;
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }
        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 1.5rem;
        }
        .stats-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            padding: 80px 0;
        }
        .stat-item h3 {
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 0.5rem;
            background: -webkit-linear-gradient(#fff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .footer {
            background: #f8fafc;
            padding: 60px 0 20px;
            border-top: 1px solid #e2e8f0;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            font-weight: 600;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-glass sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fade-in" href="{{ url('/') }}">
                <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 40px; height: 40px;">
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
                        <a class="nav-link px-3" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#how-it-works">How it Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#faq">FAQ</a>
                    </li>
                </ul>
                <div class="d-flex gap-3 align-items-center mt-3 mt-lg-0">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary rounded-pill px-4 hover-lift-btn">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-semibold px-2 hover-lift">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary-custom text-white">Get Started Free</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0 fade-in">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3 fw-bold tracking-wide">THE #1 MENTORING PLATFORM</span>
                    <h1 class="hero-title mb-4">Accelerate Your Career with <span class="text-primary">Expert Mentorship</span></h1>
                    <p class="hero-subtitle">Connect with industry professionals, book one-on-one sessions, and achieve your goals faster than ever before.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg text-white">Find a Mentor</a>
                        <a href="#how-it-works" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm hover-lift-btn border">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative fade-in" style="animation-delay: 0.2s;">
                    <!-- Custom Generated Hero Photo -->
                    <img src="{{ asset('images/hero_custom.png') }}" alt="Mentorship Expert" class="img-fluid rounded-circle shadow-lg mx-auto d-block border border-4 border-white" style="width: 80%; object-fit: cover; aspect-ratio: 1/1;">
                    
                    <!-- Floating Stats Cards -->
                    <div class="position-absolute top-50 start-0 translate-middle-y ms-n4 d-none d-xl-block hover-lift">
                        <div class="bg-white p-3 rounded-4 shadow-lg border border-light">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success">
                                    <i class="bi bi-graph-up-arrow fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">98% Success</h6>
                                    <small class="text-muted">Placement Rate</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="position-absolute bottom-0 end-0 mb-5 me-n4 d-none d-xl-block hover-lift">
                        <div class="bg-white p-3 rounded-4 shadow-lg border border-light">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-circle text-warning">
                                    <i class="bi bi-star-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">4.9/5 Rating</h6>
                                    <small class="text-muted">Avg Mentor Score</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="stats-section text-center position-relative">
        <div class="container">
            <div class="row fade-in">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="stat-item hover-lift">
                        <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                        <h3>10,000+</h3>
                        <p class="text-white-50 mb-0 fw-medium">Active Students</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="stat-item hover-lift">
                        <i class="bi bi-star-fill fs-1 text-warning mb-3"></i>
                        <h3>5,000+</h3>
                        <p class="text-white-50 mb-0 fw-medium">Verified Mentors</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item hover-lift">
                        <i class="bi bi-calendar2-check-fill fs-1 text-success mb-3"></i>
                        <h3>50,000+</h3>
                        <p class="text-white-50 mb-0 fw-medium">Sessions Completed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-6 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 fade-in">
                <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Core Features</span>
                <h2 class="fw-bold mb-3 display-6">Why Choose MentorLink?</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">We provide all the tools you need for a successful mentorship journey in one unified platform.</p>
            </div>
            <div class="row g-4 fade-in">
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-5 text-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex mx-auto p-4 mb-4">
                            <i class="bi bi-search fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Smart Discovery</h4>
                        <p class="text-muted mb-0">Easily find mentors by expertise, specific skills, or top ratings with our advanced directory.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-5 text-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex mx-auto p-4 mb-4">
                            <i class="bi bi-calendar-event fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Seamless Scheduling</h4>
                        <p class="text-muted mb-0">Book sessions directly based on your mentor's real-time availability calendar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-5 text-center">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex mx-auto p-4 mb-4">
                            <i class="bi bi-shield-check fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Verified Experts</h4>
                        <p class="text-muted mb-0">Every mentor is manually verified by our admins to ensure top-quality guidance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-6 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 fade-in">
                    <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Process</span>
                    <h2 class="fw-bold mb-5 display-6">How It Works</h2>
                    
                    <div class="d-flex mb-5">
                        <div class="me-4 position-relative">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.25rem; z-index: 2; position: relative;">1</div>
                            <div class="position-absolute" style="left: 28px; top: 56px; bottom: -40px; width: 2px; background: #e2e8f0; z-index: 1;"></div>
                        </div>
                        <div class="pt-2">
                            <h5 class="fw-bold mb-2">Create your profile</h5>
                            <p class="text-muted mb-0">Sign up as a student or apply to be a mentor. Complete your profile to get started.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-5">
                        <div class="me-4 position-relative">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.25rem; z-index: 2; position: relative;">2</div>
                            <div class="position-absolute" style="left: 28px; top: 56px; bottom: -40px; width: 2px; background: #e2e8f0; z-index: 1;"></div>
                        </div>
                        <div class="pt-2">
                            <h5 class="fw-bold mb-2">Send a request</h5>
                            <p class="text-muted mb-0">Browse the mentor directory, find your match, and send a mentorship connection request.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="me-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 56px; height: 56px; font-size: 1.25rem; z-index: 2; position: relative;">3</div>
                        </div>
                        <div class="pt-2">
                            <h5 class="fw-bold mb-2">Book and learn</h5>
                            <p class="text-muted mb-0">Once connected, book available time slots and start your one-on-one sessions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fade-in text-center">
                    <img src="{{ asset('images/how-it-works.svg') }}" alt="Mentorship Session" class="img-fluid bg-white p-3 rounded-5 shadow-lg border border-light" style="width: 100%; max-width: 500px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-6 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5 fade-in">
                <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Success Stories</span>
                <h2 class="fw-bold mb-3 display-6">What Our Users Say</h2>
                <p class="text-muted lead mx-auto" style="max-width: 600px;">Real stories from students and mentors achieving greatness on MentorLink.</p>
            </div>
            <div class="row g-4 fade-in">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 hover-lift">
                        <div class="card-body">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4 lh-lg">"MentorLink helped me land my first software engineering job. The guidance I received was invaluable!"</p>
                            <div class="d-flex align-items-center mt-auto">
                                <img src="https://ui-avatars.com/api/?name=Sarah+J&background=0d6efd&color=fff" alt="Sarah J" class="rounded-circle me-3 border" width="56">
                                <div>
                                    <h6 class="fw-bold mb-0">Sarah J.</h6>
                                    <small class="text-muted">Computer Science Student</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 hover-lift">
                        <div class="card-body">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4 lh-lg">"Being a mentor here allows me to give back to the community. The booking system is seamless and easy to use."</p>
                            <div class="d-flex align-items-center mt-auto">
                                <img src="https://ui-avatars.com/api/?name=David+Chen&background=198754&color=fff" alt="David Chen" class="rounded-circle me-3 border" width="56">
                                <div>
                                    <h6 class="fw-bold mb-0">David Chen</h6>
                                    <small class="text-muted">Senior Developer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 hover-lift">
                        <div class="card-body">
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p class="fst-italic text-muted mb-4 lh-lg">"I found the perfect mentor for UI/UX design. The platform made it so easy to connect and schedule sessions."</p>
                            <div class="d-flex align-items-center mt-auto">
                                <img src="https://ui-avatars.com/api/?name=Elena+R&background=fd7e14&color=fff" alt="Elena R" class="rounded-circle me-3 border" width="56">
                                <div>
                                    <h6 class="fw-bold mb-0">Elena R.</h6>
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
    <section id="faq" class="py-6 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5 fade-in">
                <span class="text-primary fw-bold tracking-wide text-uppercase small mb-2 d-block">Support</span>
                <h2 class="fw-bold mb-3 display-6">Frequently Asked Questions</h2>
            </div>
            <div class="row justify-content-center fade-in">
                <div class="col-lg-8">
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-bold px-4 py-3 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How do I become a mentor?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted px-4 py-4">
                                    You can sign up as a user and choose the "Mentor" role. After filling out your profile, an administrator will review and verify your account.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold px-4 py-3 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Are sessions free?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted px-4 py-4">
                                    Currently, MentorLink provides a platform for free mentorship connections to help students grow their careers.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Footer -->
    <footer class="footer mt-0 bg-dark text-white pt-6 pb-4">
        <div class="container fade-in">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <a class="navbar-brand d-inline-flex align-items-center mb-4 text-white" href="#">
                        <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <span class="text-white">MentorLink</span>
                    </a>
                    <p class="text-white-50 mb-4 pe-lg-4">Empowering the next generation of professionals through expert mentorship and seamless guidance.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white-50 hover-lift"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white-50 hover-lift"><i class="bi bi-linkedin fs-5"></i></a>
                        <a href="#" class="text-white-50 hover-lift"><i class="bi bi-github fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide mb-4">Platform</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#features" class="text-white-50 text-decoration-none hover-lift d-inline-block">Features</a></li>
                        <li class="mb-2"><a href="#how-it-works" class="text-white-50 text-decoration-none hover-lift d-inline-block">How it Works</a></li>
                        <li class="mb-2"><a href="#testimonials" class="text-white-50 text-decoration-none hover-lift d-inline-block">Testimonials</a></li>
                        <li><a href="#faq" class="text-white-50 text-decoration-none hover-lift d-inline-block">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="fw-bold text-uppercase tracking-wide mb-4">Contact Us</h6>
                    <ul class="list-unstyled mb-0 text-white-50">
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
                    <h6 class="fw-bold text-uppercase tracking-wide mb-4">Newsletter</h6>
                    <p class="text-white-50 small mb-3">Subscribe to get the latest updates and mentoring tips.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="Email address" aria-label="Email address">
                        <button class="btn btn-primary" type="button"><i class="bi bi-send-fill"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="border-top border-secondary pt-4 mt-4 text-center text-md-start d-md-flex justify-content-between align-items-center text-white-50 small">
                <p class="mb-2 mb-md-0">&copy; {{ date('Y') }} MentorLink. All rights reserved.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-white-50 text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-white-50 text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
