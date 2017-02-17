<?php

namespace ScaredChatsky\ImageSeeder\Seeders;

use Faker\Factory;
use File;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
	const CONFIG_KEY = 'image-seeder';

	public function run()
	{
		$faker = Factory::create();

		File::delete(File::allFiles(config(static::CONFIG_KEY . '.images-path')));

		for ($i = 0; $i < config(static::CONFIG_KEY . '.images-count'); $i ++) {
			$faker->image(
				config(static::CONFIG_KEY . '.images-path'),
				config(static::CONFIG_KEY . '.images-width'),
				config(static::CONFIG_KEY . '.images-height')
			);
		}
	}

	public function getRandomImage($imagePrefix = '')
	{
		return array_first($this->getRandomImages(1, $imagePrefix));
	}

	/**
	 * Get random images from images-path directory, defined in image-seeder config
	 *
	 * @param int    $count
	 * @param string $imagePrefix
	 *
	 * @return string[]
	 */
	public function getRandomImages($count, $imagePrefix = '')
	{
		$faker = Factory::create();

		$images = array_filter(scandir(config(static::CONFIG_KEY . '.images-path')), function ($el) {

			foreach (config(static::CONFIG_KEY . '.excluded') as $excluded) {
				if ($el === $excluded) {
					return false;
				}
			}

			return $el !== '..' && $el !== '.';
		});

		return $faker->randomElements(array_map(function ($el) use ($imagePrefix) {
			return $imagePrefix . $el;
		}, $images), $count);
	}

}
