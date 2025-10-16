<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class PepperAuthServiceProvider extends ServiceProvider
{
	public function register(): void {}

	public function boot(): void
	{
		Auth::provider('pepper-eloquent', function (Application $app, array $config) {
			return new class($app['hash'], $config['model']) extends EloquentUserProvider {
				protected string $pepper;

				public function __construct(HasherContract $hasher, string $model)
				{
					parent::__construct($hasher, $model);
					$this->pepper = (string) env('APP_PEPPER', '');
				}

                public function validateCredentials($user, array $credentials)
                {
                    $plain = (string) ($credentials['password'] ?? '');

                    // Preferred: salted + peppered prehash (Argon2id has its own internal salt too)
                    $saltB64 = (string) ($user->salt ?? '');
                    if ($saltB64 !== '') {
                        $salt = base64_decode($saltB64, true) ?: '';
                        $preSalted = hash_hmac('sha256', $salt . $plain, $this->pepper, true);
                        if (password_verify($preSalted, (string) $user->password)) {
                            return true;
                        }
                    }

                    // Fallback: legacy pepper-only prehash; if valid, upgrade to salted scheme
                    $prePepperOnly = hash_hmac('sha256', $plain, $this->pepper, true);
                    if (password_verify($prePepperOnly, (string) $user->password)) {
                        $newSalt = random_bytes(32);
                        $newSaltB64 = base64_encode($newSalt);
                        $preNew = hash_hmac('sha256', $newSalt . $plain, $this->pepper, true);
                        $user->password = password_hash($preNew, PASSWORD_ARGON2ID);
                        $user->salt = $newSaltB64;
                        $user->save();

                        // Immediately refresh to ensure in-memory model matches DB
                        $user->refresh();
                    }

                    return false;
                }
			};
		});
	}
}
