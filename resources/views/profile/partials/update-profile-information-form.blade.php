<section>
    <header class="mb-4">
        <p class="text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" class="form-label fw-bold" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="text-danger mt-1 small" :messages="$errors->get('name')" />
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="form-label fw-bold" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="text-danger mt-1 small" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 alert alert-warning p-3">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-exclamation-triangle-fill fs-5 mt-1"></i>
                        <div>
                            <p class="mb-2 text-dark small fw-medium">
                                {{ __('Your email address is unverified.') }}
                            </p>
                            <button form="send-verification" class="btn btn-sm btn-dark fw-bold rounded-pill px-3 shadow-sm">
                                {{ __('Re-send verification email') }}
                            </button>
                        </div>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium small text-success">
                        <i class="bi bi-check-circle-fill me-1"></i>{{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary px-4 fw-bold hover-lift-btn rounded-pill">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-success small fw-medium mb-0">
                   <i class="bi bi-check-circle-fill me-1"></i>{{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
