<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('EntryCategoryTableSeeder');
        $this->call('EntryDatabaseTableSeeder');
        $this->call('EntryStateTableSeeder');
        $this->call('EntryActionTableSeeder');
		$this->call('UserTableSeeder');
        $this->call('EntryTableSeeder');
        $this->call('EntryLogTableSeeder');
        $this->call('RoleTableSeeder');
        $this->call('PermissionTableSeeder');
	}

}
