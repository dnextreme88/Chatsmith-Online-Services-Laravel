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
			'first_name' => 'Chatsmith Online Services',
			'email' => 'chatsmithonline.management@gmail.com',
			'username' => 'cos_management',
			'profile_image' => 'images\cos_management_1580472306.png',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'first_name' => 'Chatsmith Online Services',
			'last_name' => 'Recruitment',
			'email' => 'chatsmithonline.recruitment@gmail.com',
			'username' => 'cos_recruitment',
			'profile_image' => 'images\cos_recruitment_1580466419.png',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'first_name' => 'Mary Grace',
			'maiden_name' => 'Zabala',
			'last_name' => 'Torio',
			'email' => 'marytorio@chatsmithonline.net',
			'username' => 'cos_may',
			'profile_image' => 'images\default_avatar.png',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'first_name' => 'Pauline',
			'maiden_name' => 'Calip',
			'last_name' => 'Tesorio',
			'email' => 'chatsmithonline.pau@gmail.com',
			'username' => 'tesoriopauline18',
			'profile_image' => 'images\tesoriopauline18_1580660315.jpg',
			'password' => Hash::make($password),
			'is_staff' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		User::create([
			'first_name' => 'Jeanne Kevin Arnmani',
			'maiden_name' => 'Tibayan',
			'last_name' => 'Decena',
			'email' => 'chatsmithonline.jeanne@gmail.com',
			'username' => 'decenakevin09',
			'profile_image' => 'images\decenakevin09_1580660062.jpg',
			'password' => Hash::make($password),
			'is_staff' => 'False',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);
	}
}
