<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\PriceRange;
use App\PriceRangeTranslation;
use App\Common;

class PriceRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Thỏa thuận', '< 500 triệu', '500 - 800 triệu', '800 triệu - 1 tỷ', '1 - 2 tỷ'
        		,'2 - 3 tỷ', '3 - 5 tỷ', '5 - 7 tỷ', '7 - 10 tỷ', '10 - 20 tỷ', '20 - 30 tỷ', '> 30 tỷ'];
        $from = [0, 0, 500000000, 800000000, 1000000000
        		,2000000000, 3000000000, 5000000000, 7000000000, 10000000000, 20000000000, 30000000000];
        $to = [0, 499999999, 800000000, 1000000000, 2000000000
        		,3000000000, 5000000000, 7000000000, 10000000000, 20000000000, 30000000000, 100000000000];
        foreach ($names as $key => $value) 
        {
	        $entry = PriceRange::create([
	        	'key' => Common::createKeyURL($value),
                'from' => $from[$key],
                'to' => $to[$key],
                'priority' => $key,
				'active' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new PriceRangeTranslation ([
				'price_range_id' => $entry->id,
				'locale' => 'vi',
				'name' => $value,
				'summary' => $value,
				'meta_description' => $value,
				'meta_keywords' => $value,
			]));
        }
    }
}
