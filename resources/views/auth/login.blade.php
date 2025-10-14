<x-guest-layout>
    <div class="auth-wrapper">
        <div class="row g-0">
            <div class="col-12 col-lg-6 auth-left">
                <div class="d-block d-md-none mb-3 mobile-hero p-4">
                    <div class="text-center">
                        @if (file_exists(public_path('assets/img/logo.png')))
                            <img src="/assets/img/logo.png" alt="Logo" class="mb-2" style="height:36px" />
                        @endif
                        <div class="fw-semibold">Lost &amp; Found</div>
                    </div>
                </div>
                <div class="mb-4">
                    <h1 class="h5 fw-semibold mb-1" style="color:var(--brand-primary)">Welcome back</h1>
                    <div class="text-muted small">Log in to manage your lost &amp; found items.</div>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
                    </div>
                @endif

                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email or Username')" />
                        <x-text-input id="email" class="input-style form-control mt-1" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-2">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="input-style form-control mt-1" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="form-check-label d-flex align-items-center gap-2">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <span class="small">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none small link-accent" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-brand w-100">{{ __('Sign In') }}</button>

                    <div class="text-center mt-3 small">
                        {{ "Don't have an account?" }}
                        <a class="link-accent" href="{{ route('register') }}">{{ __('Sign Up Now') }}</a>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6 auth-right d-none d-md-block d-lg-block">
                <div class="overlay"></div>
                <div class="content">
                    <div class="w-100 d-flex justify-content-between align-items-start">
                        @if (file_exists(public_path('assets/img/logo.png')))
                            <img src="/assets/img/logo.png" alt="Logo" class="mb-3" style="height:42px" />
                        @endif
                    </div>
                    <div class="mt-auto text-center">
                        <h2 class="fw-bold" style="letter-spacing:1px">Lost &amp; Found</h2>
                        <p class="mt-2 mb-0" style="max-width: 420px">Post what you lost, browse found items, and get notified when there’s a match. Help reunite items with their owners—securely and fast.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function(){
        const form = document.getElementById('loginForm');
        form?.addEventListener('submit', function(e){
            const email = document.getElementById('email');
            const pwd = document.getElementById('password');
            if(!email.value.trim() || !pwd.value.trim()){
                e.preventDefault();
                alert('Please fill in both email/username and password.');
            }
        });
    })();
    </script>
</x-guest-layout>
