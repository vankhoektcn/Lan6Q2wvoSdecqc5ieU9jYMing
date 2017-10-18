<?php

use Illuminate\Database\Seeder;
use App\AdditionalValue;
use App\AdditionalValueTranslation;

class AdditionalValuesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		// hidden controls
		$hiddenControls = ['Product[model]', 'Product[productColors][]', 'Product[producer_id]', 'Product[productColors][]', 'Product[warranty]', 'Product[price]', 'Product[sale_price]', 'Product[sale_ratio]', 'Product[productSizes][]', 'Product[custom_size]', 'Product[unit]', 'Product[tags][]', 'Product[origin]', 'Product[availability]', 'BannerCategory[parent_id]', 'BannerCategory[attachments]', 'Banner[tags][]', 'Banner[relatedBanners][]'];
		foreach ($hiddenControls as $control) {
			$entry = AdditionalValue::create([
				'additional_category_id' => 1,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 0,
				'created_by' => '1'
			]);

			$entry->translations()->save(new AdditionalValueTranslation ([
				'additional_value_id' => $entry->id,
				'locale' => 'vi',
				'name' => $control,
				'summary' => '',
				'content' => ''
			]));
		}
	}
}
