<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();


		// users table testing data
		// \App\Models\User::factory()->create([
		//     'name' => 'joyce_cpy',
		//     'employee_id' => '1234',
		//     'email' => 'joyce.chan@mrdiy.com',
		//     'password' => Hash::make('1234')
		// ]);
		$this->call([
			PermissionTableSeeder::class,
			CreateAdminUserSeeder::class,
		]);
	}
}
