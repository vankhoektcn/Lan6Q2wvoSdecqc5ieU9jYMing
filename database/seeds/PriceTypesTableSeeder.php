<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\PriceType;
use App\PriceTypeTranslation;
use App\Common;

class PriceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Thỏa thuận', 'Triệu', 'Tỷ', 'Trăm nghìn/m2', 'Triệu/m2'];
        $from = [0, 1000000, 1000000000, 100000, 1000000];
        foreach ($names as $key => $value) 
        {
	        $entry = PriceType::create([
	        	'key' => Common::createKeyURL($value),
                'value' => $from[$key],
                'priority' => $key,
				'active' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
            $entry->translations()->save( new PriceTypeTranslation ([
                'price_type_id' => $entry->id,
                'locale' => 'vi',
                'name' => $value,
                'summary' => $value,
                'meta_description' => $value,
                'meta_keywords' => $value
            ]));
        }
    }
}
