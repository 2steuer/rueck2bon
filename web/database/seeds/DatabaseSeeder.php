<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$user = new User;
		$user->email = "admin@admin.com";
		$user->name = "Admin";
		$user->password = Hash::make('admin');
		$user->save();
	}

}
