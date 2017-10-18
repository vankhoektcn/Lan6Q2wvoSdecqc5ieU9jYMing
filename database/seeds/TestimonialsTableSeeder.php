<?php

use Illuminate\Database\Seeder;
use App\Testimonial;
use App\TestimonialTranslation;
use App\Attachment;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$generator = \Faker\Factory::create('vi_VN');

        for ($i=0; $i < 10; $i++) {
			$entry = Testimonial::create([
				'priority' => 0,
				'published' => 1,
				'created_by' => 1
			]);
			$entry->translations()->save(new TestimonialTranslation ([
				'testimonial_id' => $entry->id,
				'locale' => 'vi',
				'full_name' => $generator->name,
				'job_title' => $generator->jobTitle,
				'company_name' => $generator->company,
				'content' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));
			$entry->attachments()->save( new Attachment ([
				'path' => 'testimonial.jpg',
				'priority' => 0,
				'published' => 1
			]));
		}
    }
}
