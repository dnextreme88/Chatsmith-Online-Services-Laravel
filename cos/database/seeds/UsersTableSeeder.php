<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

		$password = 'cos12345';

		User::create([
			'name' => 'Chatsmith Online Services',
			'email' => 'chatsmithonline.management@gmail.com',
			'username' => 'cos_management',
			'profile_image' => 'images\cos_management_1580472306.jpg',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'name' => 'Chatsmith Online Services Recruitment',
			'email' => 'chatsmithonline.recruitment@gmail.com',
			'username' => 'cos_recruitment',
			'profile_image' => 'images\cos_recruitment_1580466419.jpg',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'name' => 'Mary Grace Zabala Torio',
			'email' => 'marytorio@chatsmithonline.net',
			'username' => 'cos_may',
			'profile_image' => 'images\default_avatar.png',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'name' => 'Pauline Calip Tesorio',
			'email' => 'chatsmithonline.pau@gmail.com',
			'username' => 'tesoriopauline18',
			'profile_image' => 'images\default_avatar.png',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);
	}
}
