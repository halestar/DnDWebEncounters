<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
                                       'id'       => 100,
                                       'name'     => "German Kalinec",
                                       'email'    => 'gkalinec@gmail.com',
                                       'password' => bcrypt('nalin2d'),
	    ]);
	
	    $adminPermission = Permission::create(['name' => 'admin']);
	    $userPermission = Permission::create(['name' => 'user']);
	    $user = User::findOrFail(100);
	    $user->givePermissionTo('admin', 'user');
    }
}
