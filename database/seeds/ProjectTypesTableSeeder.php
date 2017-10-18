<?php

use Illuminate\Database\Seeder;
use App\ProjectType;
use App\ProjectTypeTranslation;
use App\Attachment;
use App\Common;

class ProjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = \Faker\Factory::create('vi_VN');

		$project_types = ['Căn hộ cao cấp'
        , 'Khu biệt thự'
        , 'Cao ốc văn phòng'
        , 'Khu thương mại'
        , 'Khu dân cư'
        , 'Nhà ở xã hội'
        , 'Khu đô thị mới'];
        $project_types_meta_description = ['Căn hộ cao cấp'
        , 'Khu biệt thự'
        , 'Cao ốc văn phòng'
        , 'Khu thương mại'
        , 'Khu dân cư'
        , 'Nhà ở xã hội'
        , 'Khu đô thị mới'];
        $project_types_meta_keywords = ['Căn hộ cao cấp'
        , 'Khu biệt thự'
        , 'Cao ốc văn phòng'
        , 'Khu thương mại'
        , 'Khu dân cư'
        , 'Nhà ở xã hội'
        , 'Khu đô thị mới'];

		foreach ($project_types as $key => $category) {
			$entry = ProjectType::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ProjectTypeTranslation ([
				'project_type_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $project_types_meta_description[$key],
				'meta_description' => $project_types_meta_description[$key],
				'meta_keywords' => $project_types_meta_keywords[$key]
			]));
		}
    }
}
