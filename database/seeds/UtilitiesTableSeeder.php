<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Utility;
use App\Common;

class UtilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Hồ bơi', 'Công viên', 'Khu thương mại', 'Phòng tập Gym', 'Siêu thị', 'Phòng Karaoke'];
        
        foreach ($names as $key => $value) 
        {
	        $utility = Utility::create([
	        	'key' => Common::createKeyURL($value),
                'name' => $value,
                'priority' => $key,
				'active' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
        }
    }
}
