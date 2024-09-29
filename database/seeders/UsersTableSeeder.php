<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_password = Hash::make('cos12345');
        $timestamp_value = '1580378520'; // Jan 30, 2020 06:02 PM

        User::create([
            'first_name' => 'Chatsmith Online Services',
            'last_name' => 'Management',
            'email' => 'chatsmithonline.management@gmail.com',
            'username' => 'cos_management',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Angelica',
            'maiden_name' => 'Parco',
            'last_name' => 'Villanueva',
            'email' => 'chatsmithonline.recruitment@gmail.com',
            'username' => 'cos_recruitment',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Mary Grace',
            'maiden_name' => 'Zabala',
            'last_name' => 'Torio',
            'email' => 'marytorio@chatsmithonline.net',
            'username' => 'cos_may',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Pauline',
            'maiden_name' => 'Calip',
            'last_name' => 'Tesorio',
            'email' => 'chatsmithonline.pau@gmail.com',
            'username' => 'tesoriopauline18',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Nicole Alyza Umeres',
            'maiden_name' => 'Paragas',
            'last_name' => 'Amansec',
            'email' => 'chatsmithonline.nicx@gmail.com',
            'username' => 'amansecnicole17',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Beverly',
            'maiden_name' => 'Pig-ang',
            'last_name' => 'Balanta',
            'email' => 'chatsmithonline.beverly@gmail.com',
            'username' => 'balantabeverly16',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Archie',
            'maiden_name' => 'Tinapngan',
            'last_name' => 'Lapnawan',
            'email' => 'chatsmithonline.archie@gmail.com',
            'username' => 'lapnawanarchie14',
            'password' => $default_password,
            'is_staff' => 1,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Jeanne Kevin Arnmani',
            'maiden_name' => 'Tibayan',
            'last_name' => 'Decena',
            'email' => 'chatsmithonline.jeanne@gmail.com',
            'username' => 'decenakevin09',
            'password' => $default_password,
            'is_staff' => 0,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Mark Anthony',
            'maiden_name' => 'Lucero',
            'last_name' => 'Sanchez',
            'email' => 'chatsmithonline.madisson@gmail.com',
            'username' => 'sanchezmarkanthony10',
            'password' => $default_password,
            'is_staff' => 0,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);

        User::create([
            'first_name' => 'Mila Rose',
            'maiden_name' => 'Gellecanao',
            'last_name' => 'Lachica',
            'email' => 'chatsmithonline.miles@gmail.com',
            'username' => 'lachicamila19',
            'password' => $default_password,
            'is_staff' => 0,
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value,
        ]);
    }
}
