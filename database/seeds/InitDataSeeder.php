<?php

use Illuminate\Database\Seeder;

class InitDataSeeder extends Seeder {

	const RECORD_FIRST_NUMBER = 1;
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$users_count = DB::table('users')->count();
		if ($users_count != 0) {
			return;
		}
		
		DB::table('permissions')->insert([
			'id' => self::RECORD_FIRST_NUMBER,
			'name' => 'admin',
			'label' => 'admin',
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()'),
		]);
		
		DB::table('roles')->insert([
			'id' => self::RECORD_FIRST_NUMBER,
			'name' => 'admin',
			'label' => 'admin',
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()'),
		]);
		
		DB::table('permission_role')->insert([
			'permission_id' => self::RECORD_FIRST_NUMBER,
			'role_id' => self::RECORD_FIRST_NUMBER,
		]);
		
		DB::table('users')->insert([
			'id' => self::RECORD_FIRST_NUMBER,
			'name' => 'Admin',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()'),
		]);
		
		DB::table('role_user')->insert([
			'role_id' => self::RECORD_FIRST_NUMBER,
			'user_id' => self::RECORD_FIRST_NUMBER,
		]);
	}

}
