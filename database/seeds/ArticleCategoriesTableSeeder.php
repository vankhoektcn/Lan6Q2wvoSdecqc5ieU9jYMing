<?php

use Illuminate\Database\Seeder;
use App\ArticleCategory;
use App\ArticleCategoryTranslation;
use App\Attachment;
use App\Common;

class ArticleCategoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		$categories = [
			['parent' => 'Thị trường', 'childrens' => ['Thị trường căn hộ', 'Thị trường nhà đất', 'Tổng quan']],
			['parent' => 'Dự án', 'childrens' => ['Căn hộ cao cấp', 'Căn hộ tầm trung', 'Căn hộ giá rẻ']],
			['parent' => 'Phân tích - nhận định', 'childrens' => ['Góc nhìn chuyên gia', 'Bất động sản thế giới']]
		];

		foreach ($categories as $key => $category) {
			$entry = ArticleCategory::create([
				'key' => Common::createKeyURL($category['parent']),
				'parent_id' => 0,
				'priority' => $key,
				'published' => 1,
				'not_delete' => 0,
				'menu_display' => 1,
				'sitemap_display' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ArticleCategoryTranslation ([
				'article_category_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category['parent'],
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category['parent']
			]));

			$entry->attachments()->save( new Attachment ([
				'path' => 'articlecategory.jpg',
				'priority' => 0,
				'published' => 1
			]));

			foreach ($category['childrens'] as $key => $children) {
				$entrySub = ArticleCategory::create([
					'key' => Common::createKeyURL($children),
					'parent_id' => $entry->id,
					'priority' => $key,
					'published' => 1,
					'not_delete' => 0,
					'menu_display' => 1,
					'sitemap_display' => 1,
					'created_by' => 1,
					'updated_by' => 1
				]);
				$entrySub->translations()->save( new ArticleCategoryTranslation ([
					'article_category_id' => $entrySub->id,
					'locale' => 'vi',
					'name' => $children,
					'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
					'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
					'meta_keywords' => $children
				]));

				$entrySub->attachments()->save( new Attachment ([
					'path' => 'articlecategory.jpg',
					'priority' => 0,
					'published' => 1
				]));
			}
		}

		$categories = ['Lời khuyên', 'Xu hướng', 'Hệ thống', /*'Cộng đồng'*/];
		$published = [1, 1, 0];

		foreach ($categories as $key => $category) {
			$entry = ArticleCategory::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => ($key+5),
				'published' => $published[$key],
				'not_delete' => 1,
				'menu_display' => 0,
				'sitemap_display' => Common::createKeyURL($category) == 'he-thong' ? 0 : 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ArticleCategoryTranslation ([
				'article_category_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category
			]));
			$entry->attachments()->save( new Attachment ([
				'path' => 'articlecategory.jpg',
				'priority' => 0,
				'published' => 1
			]));
		}

		/** Cagegories Hiển thị bài viết **/
		/*$categories = [
			['parent' => 'Hiển thị bài viết', 'childrens' => ['Master top', 'Master logo', 'Slider lớn trang chủ', 'Slider nhỏ trang chủ', 'Slider footer', 'Galleries Footer']]
		];

		foreach ($categories as $category) {
			$entry = ArticleCategory::create([
				'key' => Common::createKeyURL($category['parent']),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 0,
				'not_delete' => 1,
				'menu_display' => 0,
				'sitemap_display' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ArticleCategoryTranslation ([
				'article_category_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category['parent'],
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category['parent']
			]));

			$entry->attachments()->save( new Attachment ([
				'path' => 'articlecategory.jpg',
				'priority' => 0,
				'published' => 1
			]));

			foreach ($category['childrens'] as $children) {
				$entrySub = ArticleCategory::create([
					'key' => Common::createKeyURL($children),
					'parent_id' => $entry->id,
					'priority' => 0,
					'published' => 0,
					'not_delete' => 1,
					'menu_display' => 0,
					'sitemap_display' => 0,
					'created_by' => 1,
					'updated_by' => 1
				]);
				$entrySub->translations()->save( new ArticleCategoryTranslation ([
					'article_category_id' => $entrySub->id,
					'locale' => 'vi',
					'name' => $children,
					'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
					'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
					'meta_keywords' => $children
				]));

				$entrySub->attachments()->save( new Attachment ([
					'path' => 'articlecategory.jpg',
					'priority' => 0,
					'published' => 1
				]));
			}
		}*/
		
	}
}
