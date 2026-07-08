<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MentorLink') }} — @yield('title', 'Dashboard')</title>
        <meta name="description" content="MentorLink — Connect students with expert mentors for guided learning sessions.">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <!-- Custom Design System -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">

        {{-- Flash Messages (auto-dismiss) --}}
        @if(session('success') || session('error'))
        <div id="flash-toast-container" aria-live="polite" aria-atomic="true"
             style="position:fixed;top:5rem;right:1.5rem;z-index:9999;min-width:320px;max-width:420px;">
            @if(session('success'))
            <div class="toast show align-items-center text-bg-success border-0 shadow-lg mb-2" role="alert"
                 id="toast-success" style="border-radius:1rem;overflow:hidden;">
                <div class="d-flex p-1">
                    <div class="toast-body fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="toast show align-items-center text-bg-danger border-0 shadow-lg mb-2" role="alert"
                 id="toast-error" style="border-radius:1rem;overflow:hidden;">
                <div class="d-flex p-1">
                    <div class="toast-body fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill fs-5"></i>
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
            @endif
        </div>
        @endif

        <div class="d-flex flex-column" style="min-height:100vh;">
            {{-- Navigation --}}
            @include('layouts.navigation')

            {{-- Page Heading (Hero Area) --}}
            @isset($header)
                <div class="page-hero shadow-sm">
                    <div class="page-inner page-hero-inner">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            {{-- Page Content --}}
            <main class="flex-grow-1 page-content mt-5">
                <div class="page-inner">
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <footer class="py-4 mt-auto bg-white border-top border-soft">
                <div class="page-inner">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                        <span class="text-muted small fw-medium">
                            &copy; {{ date('Y') }}
                            <strong class="text-primary font-heading fs-6">MentorLink</strong>
                        </span>
                        <span class="text-muted small">University Web Programming Lab Project</span>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEls = document.querySelectorAll('#flash-toast-container .toast');
            toastEls.forEach(function(el) {
                var toast = new bootstrap.Toast(el, { delay: 5000 });
                toast.show();
            });
        });
        </script>
    </body>
</html>
