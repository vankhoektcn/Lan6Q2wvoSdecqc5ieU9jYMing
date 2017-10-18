<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Ward;
use App\District;
use App\Common;

class WardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // QUẬN 1
        $wards_quan1 = ['Bến Nghé', 'Bến Thành', 'Cầu Kho', 'Cầu Ông Lãnh', 'Cô Giang', 'Đa Kao', 'Nguyễn Cư Trinh', 'Nguyễn Thái Bình', 'Phạm Ngũ Lão', 'Tân Định'];
        $quan1 = District::where('key','quan-1')->get();
        $quan1_id = 1;
        $quan1_name = 'Quận 1';
        if(is_null($quan1) || $quan1->count() ==0)
        {
            $quan1_id = $quan1_id[0]->id;
            $quan1_name = $quan1_id[0]->name;
        }
        foreach ($wards_quan1 as $key => $value) 
        {
            $ward = Ward::create([
                'key' => Common::createKeyURL($value.' '.$quan1_name),
                'name' => $value,
                'district_id' => $quan1_id,
                'meta_description' => 'Bán căn hộ phường '.$value .' '. $quan1_name . ', sang nhượng căn hộ phường '.$value .' '. $quan1_name . ', cho thuê căn hộ phường '.$value .' ' . $quan1_name,
                'meta_keywords' => 'Bán căn hộ phường '.$value .' '. $quan1_name . ', sang nhượng căn hộ phường '.$value .' '. $quan1_name . ', cho thuê căn hộ phường '.$value .' ' . $quan1_name,
                'priority' => $key,
                'is_publish' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }

        // QUẬN 2
        $wards_quan2 = ['An Khánh', 'An Lợi Đông', 'An Phú', 'Bình An', 'Bình Khánh', 'Bình Trưng Tây', 'Bình Trưng Đông', 'Cát Lái', 'Thạnh Mỹ Lợi', 'Thảo Điền', 'Thủ Thiêm'];
        $quan2 = District::where('key','quan-2')->get();
        $quan2_id = 2;
        $quan2_name = 'Quận 2';
        if(is_null($quan2) || $quan2->count() ==0)
        {
            $quan2_id = $quan2_id[0]->id;
            $quan2_name = $quan2_id[0]->name;
        }
        foreach ($wards_quan2 as $key => $value) 
        {
	        $ward = Ward::create([
				'key' => Common::createKeyURL($value.' '.$quan2_name),
                'name' => $value,
                'district_id' => $quan2_id,
                'meta_description' => 'Bán căn hộ phường '.$value .' '. $quan2_name . ', sang nhượng căn hộ phường '.$value .' '. $quan2_name . ', cho thuê căn hộ phường '.$value .' ' . $quan2_name,
                'meta_keywords' => 'Bán căn hộ phường '.$value .' '. $quan2_name . ', sang nhượng căn hộ phường '.$value .' '. $quan2_name . ', cho thuê căn hộ phường '.$value .' ' . $quan2_name,
				'priority' => $key,
				'is_publish' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
        }

        // QUẬN 9
        $wards_quan9 = ['Hiệp Phú', 'Long Bình', 'Long Phước', 'Long Thạnh Mỹ', 'Long Trường', 'Phú Hữu', 'Phước Bình', 'Phước Long A', 'Phước Long B', 'Tân Phú', 'Tăng Nhơn Phú A', 'Tăng Nhơn Phú B', 'Trường Thạnh'];
        $quan9 = District::where('key','quan-9')->get();
        $quan9_id = 9;
        $quan9_name = 'Quận 9';
        if(is_null($quan9) || $quan9->count() ==0)
        {
            $quan9_id = $quan9_id[0]->id;
            $quan9_name = $quan9_id[0]->name;
        }
        foreach ($wards_quan9 as $key => $value) 
        {
            $ward = Ward::create([
                'key' => Common::createKeyURL($value.' '.$quan9_name),
                'name' => $value,
                'district_id' => $quan9_id,
                'meta_description' => 'Bán căn hộ phường '.$value .' '. $quan9_name . ', sang nhượng căn hộ phường '.$value .' '. $quan9_name . ', cho thuê căn hộ phường '.$value .' ' . $quan9_name,
                'meta_keywords' => 'Bán căn hộ phường '.$value .' '. $quan9_name . ', sang nhượng căn hộ phường '.$value .' '. $quan9_name . ', cho thuê căn hộ phường '.$value .' ' . $quan9_name,
                'priority' => $key,
                'is_publish' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }

        // QUẬN Thủ Đức
        $wards_quan_thu_duc = ['Bình Chiểu', 'Bình Thọ', 'Hiệp Bình Chánh', 'Hiệp Bình Phước', 'Linh Chiểu', 'Linh Đông', 'Linh Tây', 'Linh Trung', 'Linh Xuân', 'Tam Bình', 'Tam Phú', 'Trường Thọ'];
        $quan_thu_duc = District::where('key','quan-thu-duc')->get();
        $quan_thu_duc_id = 10;
        $quan_thu_duc_name = 'Quận Thủ Đức';
        if(is_null($quan_thu_duc) || $quan_thu_duc->count() ==0)
        {
            $quan_thu_duc_id = $quan_thu_duc_id[0]->id;
            $quan_thu_duc_name = $quan_thu_duc_id[0]->name;
        }
        foreach ($wards_quan_thu_duc as $key => $value) 
        {
            $ward = Ward::create([
                'key' => Common::createKeyURL($value.' '.$quan_thu_duc_name),
                'name' => $value,
                'district_id' => $quan_thu_duc_id,
                'meta_description' => 'Bán căn hộ phường '.$value .' '. $quan_thu_duc_name . ', sang nhượng căn hộ phường '.$value .' '. $quan_thu_duc_name . ', cho thuê căn hộ phường '.$value .' ' . $quan_thu_duc_name,
                'meta_keywords' => 'Bán căn hộ phường '.$value .' '. $quan_thu_duc_name . ', sang nhượng căn hộ phường '.$value .' '. $quan_thu_duc_name . ', cho thuê căn hộ phường '.$value .' ' . $quan_thu_duc_name,
                'priority' => $key,
                'is_publish' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
