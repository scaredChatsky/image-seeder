<?php

namespace ScaredChatsky\ImageSeeder;

use Illuminate\Support\ServiceProvider;
use ScaredChatsky\ImageSeeder\Commands\DBImagesSeed;
use ScaredChatsky\ImageSeeder\Seeders\ImageSeeder;

class ImageSeederServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/image-seeder.php' => config_path('image-seeder.php'),
		]);

		if ($this->app->runningInConsole()) {
			$this->commands([
				DBImagesSeed::class,
			]);
		}
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/image-seeder.php', 'image-seeder'
		);

		$this->app->singleton('image-seeder', function($app) {
			return new ImageSeeder();
		});
	}
}
