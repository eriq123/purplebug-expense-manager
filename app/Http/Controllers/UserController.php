<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	$panel_title = "Users";
    	$add_button_name = "Add User";

    	$users = User::all();
    	$roles = Role::all();
    	
    	return view('user',compact('users','roles','panel_title','add_button_name'));
    }

    public function action(Request $request){
    	if ($request->get('submit') == "delete") {
    		$user = User::findorFail($request->get('id'));
    		$user->delete();
    		
    		return redirect()->back()->withSuccess("User Deleted!");
    	}

    	$request->validate([
    		'first_name' => 'required | max:191',
    		'last_name' => 'required | max:191',
    		'role' => 'required',
    	]);

    	if ($request->get('submit') == "add") {
    		$request->validate([
    			'email' => 'unique:users',
    			'password' => ' min:6 | string | confirmed'
    		]);

    		$user = new User();

    	}elseif ($request->get('submit') == "update") {

    		$request->validate([
    			'password' => ' nullable | min:6 | string | confirmed'
    		]);

    		$user = User::findorFail($request->get('id'));
    	}

    		$user->role_id = $request->get('role');
    		$user->first_name = $request->get('first_name');
    		$user->last_name = $request->get('last_name');
    		$user->email = $request->get('email');

    		if ($request->get('password')) {
	    		$user->password = bcrypt($request->get('password'));
    		}

    		$user->save();

    	if ($request->get('submit') == "add") {
    		return redirect()->back()->withSuccess("User Added!");
    	}elseif ($request->get('submit') == "update") {
    		return redirect()->back()->withSuccess("User Updated!");
    	}
    }

    public function CheckRole(Request $request){

    	$role = Role::all();
    	$user = User::with('role')->find($request->id);
    	return response()->json(compact('role','user'));

    }
}
