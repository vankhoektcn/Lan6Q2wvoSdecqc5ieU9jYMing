<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\IncenseType;
use App\IncenseTypeTranslation;
use App\Common;

class IncenseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Đông', 'Tây', 'Nam', 'Bắc', 'Đông Nam' ,'Đông Bắc', 'Tây Nam', 'Tây Bắc'];
        
        foreach ($names as $key => $value) 
        {
	        $entry = IncenseType::create([
	        	'key' => Common::createKeyURL($value),
                'priority' => $key,
				'active' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new IncenseTypeTranslation ([
				'incense_type_id' => $entry->id,
				'locale' => 'vi',
				'name' => $value,
				'summary' => $value,
				'meta_description' => $value,
				'meta_keywords' => $value
			]));
        }
    }
}
