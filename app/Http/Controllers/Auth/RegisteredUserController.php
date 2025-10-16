<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Rules\StrongPassword;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', new StrongPassword],
        ], [
            'username.required' => 'Please choose a username.',
            'username.unique' => 'This username is already in use.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Normalize email to lowercase to avoid case-sensitivity login issues
        $validated['email'] = \Illuminate\Support\Str::lower(trim($validated['email']));

        $pepper = (string) env('APP_PEPPER', '');
        $userSalt = random_bytes(32);
        $saltB64 = base64_encode($userSalt);

        // Prehash with per-user salt and server-side pepper
        $pre = hash_hmac('sha256', $userSalt . $validated['password'], $pepper, true);
        $hashed = password_hash($pre, PASSWORD_ARGON2ID);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $hashed,
            'salt' => $saltB64,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
