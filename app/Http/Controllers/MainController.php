<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){


    	return view('dashboard');
    }

    public function graph(){
    	$expenses = Expense::all();
    	$categories = Category::all();

    	$main_array = array();

    	foreach ($categories as $category) {
			$category_total = 0;

			foreach ($expenses as $expense) {
	    		if ($category->id == $expense->category_id) {
	    			$category_total += $expense->amount;
	    		}    	
    		}

    		array_push($main_array, [
    			'category'=>$category->name,
    			'total'=>$category_total
    		]);
    	}

    	return response()->json(compact('main_array'));
    }

}
