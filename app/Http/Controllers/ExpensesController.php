<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
	public function index(){
    	$panel_title = "Expenses";
    	$add_button_name = "Add Expense";

    	$expenses = Expense::all();
    	$categories = Category::all();

		return view('expenses',compact('panel_title','add_button_name','expenses','categories'));
	}

	public function action(Request $request){
    	if ($request->get('submit') == "delete") {
    		$expense = Expense::findorFail($request->get('id'));
    		$expense->delete();
    		
    		return redirect()->back()->withSuccess("Expense Deleted!");
    	}

    	$request->validate([
            'category' => 'required',
    		'amount' => 'required',
    		'entry_date' => 'required',
    	]);
		
		$amount = preg_replace("/[^0-9.]/", "", $request->get('amount'));

    	if ($request->get('submit') == "add") {
    		$expense = new Expense();
    	}elseif ($request->get('submit') == "update") {
    		$expense = Expense::findorFail($request->get('id'));
    	}

    		$expense->category_id = $request->get('category');
    		$expense->amount = $amount;
    		$expense->entry_date = $request->get('entry_date');
    		$expense->save();

    	if ($request->get('submit') == "add") {
    		return redirect()->back()->withSuccess("Expense Added!");
    	}elseif ($request->get('submit') == "update") {
    		return redirect()->back()->withSuccess("Expense Updated!");
    	}

	}

	public function UpdateModal(Request $request){
		$categories = Category::all();
		$expense = Expense::find($request->id);

		return response()->json(compact('categories','expense'));
	}
}
