<?php

use Illuminate\Database\Seeder;
use App\ProjectCategory;
use App\ProjectCategoryTranslation;
use App\Attachment;
use App\Common;


class ProjectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = \Faker\Factory::create('vi_VN');

		$categories = ['Đang làm móng', 'Đang xây thô', 'Đang hoàn thiện', 'Dự án nổi bật', 'Dự án mới nhất', 'Căn hộ sang nhượng', "Căn hộ cho thuê", 'Slideshow chính', 'Slideshow footer'];
		$published = [1, 1, 1, 0, 0, 0, 0, 0, 0];

		foreach ($categories as $key => $category) {
			$entry = ProjectCategory::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => $published[$key],
				'not_delete' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ProjectCategoryTranslation ([
				'project_category_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category
			]));
			/*
			$entry->attachments()->save( new Attachment ([
				'path' => Common::createKeyURL($category) .'.jpg',
				'priority' => 0,
				'published' => 1
			]));
			*/
		}
    }
}
