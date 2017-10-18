<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\ProjectTranslation;
use App\ProjectCategory;
use App\ProjectType;
use App\Attachment;
use App\Common;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = \Faker\Factory::create('vi_VN');

        $categories = ProjectCategory::pluck('id')->toArray();
		$types = ProjectType::pluck('id')->toArray();

		for ($i=0; $i < 100; $i++) {
			$name = $generator->sentence($nbWords = 6);
			
			$entry = Project::create([
				'key' => Common::createKeyURL($name),
				'project_type_id'=> $generator->randomElement($types),
				'province_id' => 1,
				'priority' => 0,
				'published' => 1,
				// 'not_delete' => 0,
				//'execution_time' => $generator->dateTimeThisYear($max = 'now'),
				'website' => '',
				'created_by' => '1',
				'published_by' => '1',
				'published_at' => $generator->dateTimeThisYear($max = 'now')
			]);

			$entry->translations()->save( new ProjectTranslation ([
				'project_id' => $entry->id,
				'locale' => 'vi',
				'name' => $name,
				'address' => $generator->realText($maxNbChars = 50, $indexSize = 2),
				'summary' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'price_description' => 'Trên 3 tỷ',
				'content' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'meta_keywords' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));

			$entry->attachments()->save( new Attachment ([
				'path' => 'project.png',
				'priority' => 0,
				'published' => 1
			]));

			$entry->projectCategories()->attach($generator->randomElement($categories));
			//$entry->projectTypes()->attach($generator->randomElement($types));
		}
    }
}
