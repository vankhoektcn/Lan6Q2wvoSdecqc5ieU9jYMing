<?php

use Illuminate\Database\Seeder;
use App\Province;
use App\ProvinceTranslation;
use App\Common;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = ['Hồ Chí Minh', 'Hà Nội'];

        foreach ($provinces as $key => $value) 
        {
	        $province = Province::create([
				'key' => Common::createKeyURL($value),
				'priority' => $key,
				'is_publish' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			ProvinceTranslation::create([
				'province_id' => $province->id,
				'locale' => 'vi',
				'name' => $value,
                'meta_description' => 'Bán căn hộ '.$value . ', sang nhượng căn hộ '.$value . ', cho thuê căn hộ '.$value,
                'meta_keywords' => 'Bán căn hộ '.$value . ', sang nhượng căn hộ '.$value . ', cho thuê căn hộ '.$value,
			]);
        }
    }
}
