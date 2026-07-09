<x-guest-layout>
    <div class="mb-4 text-muted small">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-100 mt-1" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-100">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
        
        <div class="text-center mt-4 text-muted small">
            <a href="{{ route('login') }}" class="auth-footer-link">Back to login</a>
        </div>
    </form>
</x-guest-layout>
