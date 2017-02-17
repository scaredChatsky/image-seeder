<?php

namespace ScaredChatsky\ImageSeeder\Facades;

use Illuminate\Support\Facades\Facade;

class ImageSeeder extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'image-seeder';
	}

}
