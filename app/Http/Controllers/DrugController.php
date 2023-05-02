<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\DrugType;
use Redirect;
class DrugController extends Controller{


	public function __construct(){
        $this->middleware('auth');
    }

    public function getdrug(Request $request){
        $drugs = Drug::where('category_id',$request->category)->get();
        return response()->json(['drugs'=>$drugs,'status'=>true]);

    }

    //
    public function create(){
        $category = DrugType::all();
    	return view('drug.create',compact('category'));

    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'trade_name' => 'required',
        	'generic_name' => 'required',
    	]);
        $drug = new Drug;
        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;
        $drug->note = $request->note;
        $drug->category_id = $request->category_id;
    	$drug->save();

    	return Redirect::route('drug.all')->with('success', __('sentence.Drug added Successfully'));
    }

    public function all(){
    	$drugs = Drug::all();

    	return view('drug.all',['drugs' => $drugs]);
    }


    public function edit($id){
        $drug = Drug::find($id);
        return view('drug.edit',['drug' => $drug]);
    }

    public function store_edit(Request $request){
            
        $validatedData = $request->validate([
            'trade_name' => 'required',
            'generic_name' => 'required',
        ]);
        
        $drug = Drug::find($request->drug_id);

        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;

        $drug->save();

        return Redirect::route('drug.all')->with('success', __('sentence.Drug Edited Successfully'));

    }

        public function destroy($id){

        Drug::destroy($id);
        return Redirect::route('drug.all')->with('success', __('sentence.Drug Deleted Successfully'));

    }
}
