<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = User::create([
			'last_name'		=> 'Phan',
			'first_name'	=> 'Sang',
			'job_title'		=> 'Quản lý',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'https://facebook.com/phantsang',
			'email'			=> 'admin@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 1,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
		$user->roles()->attach([1]);


		$userCw = User::create([
			'last_name'		=> 'Copy',
			'first_name'	=> 'Writer',
			'job_title'		=> 'Copywriter',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'https://facebook.com/phantsang',
			'email'			=> 'copywriter@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 1,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
		$userCw->roles()->attach([4]);

		/*
		User::create([
			'last_name'		=> 'User',
			'first_name'	=> 'Normal',
			'job_title'		=> 'Normal',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'http://facebook.com/phantsang',
			'email'			=> 'normal@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 0,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
		*/
	}
}
