<?php

namespace App\Console\Commands;

use Filament\Facades\Filament;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class MakeCustomFilamentUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'make:filament-admin
                            {--name= : The name of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

	protected array $options;

	/**
	 * @return array{'name': string, 'email': string, 'password': string}
	 */
	protected function getUserData(): array
	{
		return [
			'name' => $this->options['name'] ?? text(
					label: 'Name',
					required: true,
				),

			'email' => $this->options['email'] ?? text(
					label: 'Email address',
					required: true,
					validate: fn (string $email): ?string => match (true) {
						! filter_var($email, FILTER_VALIDATE_EMAIL) => 'The email address must be valid.',
						static::getUserModel()::where('email', $email)->exists() => 'A user with this email address already exists',
						default => null,
					},
				),

			'password' => Hash::make($this->options['password'] ?? password(
				label: 'Password',
				required: true,
			)),
			'role' => 1,
		];
	}

	protected function createUser(): Authenticatable
	{
		return static::getUserModel()::create($this->getUserData());
	}

	protected function sendSuccessMessage(Authenticatable $user): void
	{
		$loginUrl = Filament::getLoginUrl();

		$this->components->info('Success! ' . ($user->getAttribute('email') ?? $user->getAttribute('username') ?? 'You') . " may now log in at {$loginUrl}");
	}

	protected function getAuthGuard(): Guard
	{
		return Filament::auth();
	}

	protected function getUserProvider(): UserProvider
	{
		return $this->getAuthGuard()->getProvider();
	}

	protected function getUserModel(): string
	{
		/** @var EloquentUserProvider $provider */
		$provider = $this->getUserProvider();

		return $provider->getModel();
	}

	public function handle(): int
	{
		$this->options = $this->options();

		if (! Filament::getCurrentPanel()) {
			$this->error('Filament has not been installed yet: php artisan filament:install --panels');

			return static::INVALID;
		}

		$user = $this->createUser();
		$this->sendSuccessMessage($user);

		return static::SUCCESS;
	}
}
