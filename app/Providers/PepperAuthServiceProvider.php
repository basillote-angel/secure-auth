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
					$saltB64 = (string) ($user->salt ?? '');
					$salt = base64_decode($saltB64, true) ?: '';
					$pre = hash_hmac('sha256', $salt . $plain, $this->pepper, true);
					return password_verify($pre, (string) $user->password);
				}
			};
		});
	}
}
