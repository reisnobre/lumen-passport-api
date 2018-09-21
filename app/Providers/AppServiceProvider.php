<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
		// Configs
		$this->app->configure('database');
		//
		// Enable queues
		$this->app->make('queue');

		$this->app->singleton(
			'mailer',
			function ($app) {
				return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer');
			}
		);
		// Aliases
		$this->app->alias('mailer', \Illuminate\Contracts\Mail\Mailer::class);
	}
}
