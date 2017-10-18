<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\District;
use App\Province;
use App\Common;
use App\DistrictTranslation;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = ['Quận 1', 'Quận 2', 'Quận 3', 'Quận 4', 'Quận 5', 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 9', 'Quận Thủ Đức', 'Quận Bình Thạnh', 'Quận Phú Nhuận', 'Quận Tân Phú', 'Quận Tân Bình', 'Huyện Hóc Môn', 'Huyện Bình Chánh', 'Huyện Nhà Bè', 'Huyện Củ Chi', 'Huyện Cần Giờ'];
        $provinces = Province::where('is_publish',1)->orderBy('priority')->take(1)->get();
        $province_id = 1;
        if(is_null($provinces) || $provinces->count() ==0)
        	$province_id = $provinces[0]->id;
        foreach ($districts as $key => $value) 
        {
	        $district = district::create([
				'key' => Common::createKeyURL($value),
				'province_id' => $province_id,
				'priority' => $key,
				'is_publish' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			DistrictTranslation::create([
				'district_id' => $district->id,
				'locale' => 'vi',
				'name' => $value,
                'meta_description' => 'Bán căn hộ '.$value . ', sang nhượng căn hộ '.$value . ', cho thuê căn hộ '.$value,
                'meta_keywords' => 'Bán căn hộ '.$value . ', sang nhượng căn hộ '.$value . ', cho thuê căn hộ '.$value,
			]);
        }
    }
}
