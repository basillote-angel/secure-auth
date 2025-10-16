<x-guest-layout>
    <div class="auth-wrapper">
        <div class="row g-0">
            <div class="col-12 col-lg-6 auth-left">
                <div class="d-block d-md-none mb-3 mobile-hero p-4">
                    <div class="text-center">
                        @if (file_exists(public_path('assets/img/logo.png')))
                            <img src="/assets/img/logo.png" alt="Logo" class="mb-2" style="height:36px" />
                        @endif
                        <div class="fw-semibold">Welcome</div>
                    </div>
                </div>
                <div class="mb-4">
                    <h1 class="h5 fw-semibold mb-1" style="color:var(--brand-primary)">Create an account</h1>
                    <div class="text-muted small">Join to report or find lost items quickly.</div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        @if ($errors->count() === 1)
                            {{ $errors->first() }}
                        @else
                            Please review the highlighted issues below.
                        @endif
                    </div>
                @endif

                <form id="registerForm" method="POST" action="{{ route('register') }}">
        @csrf

                

        <!-- Username -->
                <div class="mt-3">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="form-control mt-1" type="text" name="username" :value="old('username')" required autocomplete="username" />
                    
                </div>

        <!-- Email Address -->
                <div class="mt-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autocomplete="email" />
                    
                </div>

        <!-- Password -->
                <div class="mt-3">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="new-password" />
                    
                    <div class="mt-2">
                        <div id="meter" class="meter"><span class="seg"></span><span class="seg"></span><span class="seg"></span><span class="seg"></span></div>
                        <small id="passwordStrength" class="d-block mt-1 text-muted"></small>
                    </div>
                    <ul id="policyChecklist" class="text-sm mt-2 list-unstyled ms-1"></ul>
                </div>

        <!-- Confirm Password -->
                <div class="mt-3">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="form-control mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                    
                </div>

                <div class="form-check mt-2">
                    <input id="showPasswordRegister" class="form-check-input" type="checkbox">
                    <label for="showPasswordRegister" class="form-check-label small">Show passwords</label>
                </div>

        <script>
        (function(){
            const pwd = document.getElementById('password');
            const s = document.getElementById('passwordStrength');
            const list = document.getElementById('policyChecklist');
            const meter = document.getElementById('meter');
            if(!pwd) return;
            function renderPolicy(p){
                const checks = [
                    { ok: p.length >= 12, text: 'At least 12 characters' },
                    { ok: /[A-Z]/.test(p), text: 'At least one uppercase letter' },
                    { ok: /[a-z]/.test(p), text: 'At least one lowercase letter' },
                    { ok: /\d/.test(p), text: 'At least one digit' },
                    { ok: /[^A-Za-z0-9]/.test(p), text: 'At least one special symbol' },
                ];
                list.innerHTML = checks.map(c => `<li class="${c.ok ? 'text-success' : 'text-danger'}">${c.text}</li>`).join('');
                return checks;
            }
            function label(score){ return ['Very Weak','Weak','Medium','Strong','Very Strong'][score] || 'Unknown'; }
            function onInput(){
                const v = pwd.value;
                const checks = renderPolicy(v);
                const passed = checks.filter(c => c.ok).length; // 0..5
                const unmet = 5 - passed;
                // When empty, hide label and meter state
                if (v.length === 0) {
                    meter.classList.remove('weak','medium','strong');
                    s.textContent = '';
                    return;
                }
                // Base score from passed checks, mapped to 0..4
                let score = Math.min(4, Math.max(0, passed - 1));
                // Never show Strong unless ALL checks pass
                if (unmet > 0) score = Math.min(score, 2);
                s.className = 'text-sm ' + (score >= 3 ? 'text-success' : score === 2 ? 'text-warning' : 'text-danger');
                s.textContent = 'Strength: ' + label(score);
                meter.classList.remove('weak','medium','strong');
                if (score <= 1) meter.classList.add('weak');
                else if (score === 2) meter.classList.add('medium');
                else meter.classList.add('strong');
            }
            pwd.addEventListener('input', onInput);
        })();
        </script>
        
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <a class="text-decoration-none small link-accent" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Already have an account? Sign In') }}
                    </a>
                    <button type="submit" class="btn btn-brand">{{ __('Create') }}</button>
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
                        <p class="mt-2 mb-0" style="max-width: 420px">Create your account to post lost items, claim found ones, and receive updates in real-time. Together, let’s return belongings to their owners.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function(){
        const form = document.getElementById('registerForm');
        form?.addEventListener('submit', function(e){
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const pwd = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            if(!name.value.trim() || !email.value.trim() || !pwd.value.trim() || !confirm.value.trim()){
                e.preventDefault();
                alert('Please fill in all required fields.');
                return;
            }
            if(pwd.value !== confirm.value){
                e.preventDefault();
                alert('Passwords do not match.');
            }
        });

        const showPasswordCheckbox = document.getElementById('showPasswordRegister');
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        showPasswordCheckbox?.addEventListener('change', function(){
            const newType = this.checked ? 'text' : 'password';
            if (passwordField) passwordField.type = newType;
            if (confirmField) confirmField.type = newType;
        });
    })();
    </script>
</x-guest-layout>
