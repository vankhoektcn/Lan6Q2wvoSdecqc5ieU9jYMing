<?php

use Illuminate\Database\Seeder;
use App\Config;

class ConfigsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Config::create([
			'key' => 'site_name',
			'text' => 'Tên trang web',
			'value' => 'Chia sẻ kinh nghiệm cưới'
		]);
		/*
		Config::create([
			'key' => 'website_maintenance',
			'text' => 'Bảo trì website(0/1)',
			'value' => '0'
		]);
		Config::create([
			'key' => 'website_maintenance_message',
			'text' => 'Thông báo bảo trì',
			'value' => 'Website - Đang trong giai đoạn cập nhật, quý khách vui lòng truy cập sau.'
		]);
		*/
		Config::create([
			'key' => 'site_title',
			'text' => 'Tiêu đề trang web',
			'value' => 'Chia sẻ kinh nghiệm cưới'
		]);
		Config::create([
			'key' => 'meta_description',
			'text' => 'Meta Description',
			'value' => 'Chia sẻ kinh nghiệm cưới'
		]);
		Config::create([
			'key' => 'meta_keywords',
			'text' => 'Meta Keywords',
			'value' => 'Chia sẻ kinh nghiệm cưới'
		]);
		Config::create([
			'key' => 'headquarter_address_street',
			'text' => 'Tên đường',
			'value' => ' 1015 Trần Hưng Đạo'
		]);
		Config::create([
			'key' => 'headquarter_address_ward',
			'text' => 'Phường',
			'value' => 'P. 5'
		]);
		Config::create([
			'key' => 'headquarter_address_district',
			'text' => 'Quận/Huyện',
			'value' => 'Quận 5'
		]);
		Config::create([
			'key' => 'headquarter_address_locality',
			'text' => 'Miền',
			'value' => 'Hồ Chí Minh'
		]);
		Config::create([
			'key' => 'headquarter_address_region',
			'text' => 'Vùng',
			'value' => 'Hồ Chí Minh'
		]);
		Config::create([
			'key' => 'headquarter_address_latitude',
			'text' => 'Google Map Latitude',
			'value' => '10.7537298'
		]);
		Config::create([
			'key' => 'headquarter_address_longitude',
			'text' => 'Google Map Longitude',
			'value' => '106.6627572'
		]);
		Config::create([
			'key' => 'headquarter_phone_number',
			'text' => 'Số điện thoại trụ sở chính',
			'value' => '090 685 56 54'
		]);
		Config::create([
			'key' => 'headquarter_fax_number',
			'text' => 'Số fax trụ sở chính',
			'value' => ''
		]);
		Config::create([
			'key' => 'hot_line',
			'text' => 'Hotline',
			'value' => '090 685 56 54'
		]);
		Config::create([
			'key' => 'opening_hours',
			'text' => 'Giờ hoạt động',
			'value' => 'Mo-Su'
		]);
		Config::create([
			'key' => 'currencies_accepted',
			'text' => 'Đơn vị tiền tệ',
			'value' => 'VNĐ'
		]);
		Config::create([
			'key' => 'address_sender_mail',
			'text' => 'Địa chỉ gửi email',
			'value' => 'info@benhvienfuji.vn'
		]);
		Config::create([
			'key' => 'display_name_send_mail',
			'text' => 'Tên hiển thị trên email liên hệ',
			'value' => 'Chia sẻ kinh nghiệm cưới'
		]);
		Config::create([
			'key' => 'address_received_mail',
			'text' => 'Địa chỉ nhận email liên hệ',
			'value' => 'info@benhvienfuji.vn'
		]);
		Config::create([
			'key' => 'rows_per_page_article',
			'text' => 'Số bài viết hiển thị trên một trang',
			'value' => '10'
		]);
		Config::create([
			'key' => 'facebook_page',
			'text' => 'Địa chỉ Facebook',
			'value' => 'https://facebook.com'
		]);
		Config::create([
			'key' => 'plus_google',
			'text' => 'Google plus',
			'value' => 'https://plus.google.com'
		]);
		Config::create([
			'key' => 'youtube_channel',
			'text' => 'Youtube Channel',
			'value' => 'https://youtube.com'
		]);
		Config::create([
			'key' => 'zalo_offical',
			'text' => 'Zalo Offical',
			'value' => 'https://zaloapp.com'
		]);
		Config::create([
			'key' => 'twitter_page',
			'text' => 'Twitter',
			'value' => 'https://twitter.com'
		]);
		Config::create([
			'key' => 'linkedin_page',
			'text' => 'Linkedin',
			'value' => 'https://www.linkedin.com'
		]);
		Config::create([
			'key' => 'instagram_page',
			'text' => 'Instagram',
			'value' => 'https://www.instagram.com'
		]);
		Config::create([
			'key' => 'pinterest_page',
			'text' => 'Pinterest',
			'value' => 'https://www.pinterest.com'
		]);	
		Config::create([
			'key' => 'rss',
			'text' => 'RSS',
			'value' => '/rss'
		]);		
		Config::create([
			'key' => 'facebook_app_id',
			'text' => 'Facebook App ID',
			'value' => ''
		]);
		Config::create([
			'key' => 'facebook_fanpage_id',
			'text' => 'Facebook Fanpage ID',
			'value' => ''
		]);
		Config::create([
			'key' => 'embed_script_head',
			'text' => 'Script head',
			'value' => ''
		]);		
		Config::create([
			'key' => 'embed_script_body_top',
			'text' => 'Script body top',
			'value' => ''
		]);
		Config::create([
			'key' => 'embed_script_body_bottom',
			'text' => 'Script body bottom',
			'value' => ''
		]);
		Config::create([
			'key' => 'password_protect_website',
			'text' => 'Yêu cầu nhập mật mã truy cập',
			'value' => 'abc123'
		]);
	}
}
