<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('users')->insert([
	    	'id' => 100,
		    'name' => "German Kalinec",
		    'email' => 'gkalinec@gmail.com',
		    'password' => bcrypt('secret'),
	    ]);
    }
}
