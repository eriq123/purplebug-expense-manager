<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(){
    	$panel_title = "Role";
    	$add_button_name = "Add Role";

    	$roles = Role::all();

    	return view('roles',compact('roles','panel_title','add_button_name'));
    }

    public function action(Request $request){

    	if ($request->get('submit') == "delete") {
    		$role = Role::findorFail($request->get('id'));
    		$role->delete();
    		
    		return redirect()->back()->withSuccess("Role Deleted!");
    	}

    	$request->validate([
    		'name' => 'required|max:191',
    		'description' => 'required|max:191',
    	]);

    	if ($request->get('submit') == "add") {
    		$role = new Role();
    	}elseif ($request->get('submit') == "update") {
    		$role = Role::findorFail($request->get('id'));
    	}

    		$role->name = $request->get('name');
    		$role->description = $request->get('description');
    		$role->save();

    	if ($request->get('submit') == "add") {
    		return redirect()->back()->withSuccess("Role Added!");
    	}elseif ($request->get('submit') == "update") {
    		return redirect()->back()->withSuccess("Role Updated!");
    	}
    }
}
