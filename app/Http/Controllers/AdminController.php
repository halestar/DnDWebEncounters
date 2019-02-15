<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'permission:admin']);
	}
	
	public function users()
	{
		return view('admin.users.users');
	}
	
	public function usersTable(Request $request)
	{
		$users = User::all();
		return Datatables::of($users)->make(true);
	}
	
	public function editUser(Request $request, User $user)
	{
		return view('admin.users.edit', compact('user'));
	}
	
	public function updateUser(Request $request, User $user)
	{
		$data = $request->validate(
			[
				'name' => 'required|max:255',
				'email' => 'required|email',
				'password' => 'nullable|min:8',
				'avatar_url' => 'nullable|url',
				'monster_initiative' => 'checkbox',
				'monster_hp' => 'checkbox',
			]
		);
		$user->name = $data['name'];
		$user->email = $data['email'];
		$user->avatar_url = $data['avatar_url'];
		$user->monster_initiative = $data['monster_initiative'];
		$user->monster_hp = $data['monster_hp'];
		if($data['password'] != "")
			$user->password = bcrypt($data['password']);
		$user->save();
		return redirect()->route('admin.users')->with('success_message', 'User Updated');
	}
	
	public function permissions()
	{
	
	}
}
