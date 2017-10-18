<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		$this->call(ProvincesTableSeeder::class);
		$this->call(DistrictsTableSeeder::class);
		$this->call(WardsTableSeeder::class);
		$this->call(StreetsTableSeeder::class);
		$this->call(PriceTypesTableSeeder::class);
		$this->call(PriceRangesTableSeeder::class);
		$this->call(AreaRangeTableSeeder::class);
		$this->call(IncenseTypeTableSeeder::class);

		$this->call(LanguagesTableSeeder::class);
		$this->call(ConfigsTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(TagTableSeeder::class);
		$this->call(ArticleCategoriesTableSeeder::class);
		$this->call(ArticleTypesTableSeeder::class);
		$this->call(ArticlesTableSeeder::class);
		/*$this->call(ProducersTableSeeder::class);
		$this->call(ProductCategoriesTableSeeder::class);
		$this->call(ProductColorsTableSeeder::class);
		$this->call(ProductSizesTableSeeder::class);
		$this->call(ProductTypesTableSeeder::class);
		$this->call(ProductsTableSeeder::class);*/
		$this->call(ProjectCategoriesTableSeeder::class);
		$this->call(ProjectTypesTableSeeder::class);
		$this->call(ProjectsTableSeeder::class);
		$this->call(BannerCategoriesTableSeeder::class);
		$this->call(BannersTableSeeder::class);
		$this->call(TestimonialsTableSeeder::class);
		$this->call(AdditionalCategoriesTableSeeder::class);
		$this->call(AdditionalValuesTableSeeder::class);
	}
}
