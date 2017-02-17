<?php

namespace ScaredChatsky\ImageSeeder\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use ScaredChatsky\ImageSeeder\Seeders\ImageSeeder;

class DBImagesSeed extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:images-seed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		echo "Images seeding\n";
		Artisan::call('db:seed', [
			'--class' => ImageSeeder::class,
		]);

		echo "Database seeding\n";
		Artisan::call('db:seed');
	}
}
