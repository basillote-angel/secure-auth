<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            <div class="mt-2">
                <div id="meterProfile" class="meter"><span class="seg"></span><span class="seg"></span><span class="seg"></span><span class="seg"></span></div>
                <small id="passwordStrengthProfile" class="d-block mt-1 text-muted"></small>
            </div>
            <ul id="policyChecklistProfile" class="text-sm mt-2 list-unstyled ms-1"></ul>
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <script>
    (function(){
        const pwd = document.getElementById('update_password_password');
        const s = document.getElementById('passwordStrengthProfile');
        const list = document.getElementById('policyChecklistProfile');
        const meter = document.getElementById('meterProfile');
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
            const passed = checks.filter(c => c.ok).length;
            const unmet = 5 - passed;
            if (v.length === 0) {
                meter.classList.remove('weak','medium','strong');
                s.textContent = '';
                return;
            }
            let score = Math.min(4, Math.max(0, passed - 1));
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
</section>
