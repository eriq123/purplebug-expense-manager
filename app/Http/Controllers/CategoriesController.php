<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index(){
    	$panel_title = "Expense Categories";
    	$add_button_name = "Add Category";

    	$categories = Category::all();

    	return view('categories',compact('categories','panel_title','add_button_name'));
	}

	public function action(Request $request){

    	if ($request->get('submit') == "delete") {
    		$categories = Category::findorFail($request->get('id'));
    		$categories->delete();
    		
    		return redirect()->back()->withSuccess("Category Deleted!");
    	}

    	$request->validate([
    		'name' => 'required|max:191',
    		'description' => 'required|max:191',
    	]);

    	if ($request->get('submit') == "add") {
    		$categories = new Category();
    	}elseif ($request->get('submit') == "update") {
    		$categories = Category::findorFail($request->get('id'));
    	}

    		$categories->name = $request->get('name');
    		$categories->description = $request->get('description');
    		$categories->save();

    	if ($request->get('submit') == "add") {
    		return redirect()->back()->withSuccess("Category Added!");
    	}elseif ($request->get('submit') == "update") {
    		return redirect()->back()->withSuccess("Category Updated!");
    	}
    	
	}
}
