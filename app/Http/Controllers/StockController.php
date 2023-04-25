<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Http\Controllers\Controller;
use App\{StockCategory,User};
use Illuminate\Http\Request;
use Redirect;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Stock::paginate(10);
        return view('stock.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = StockCategory::all();
        $users = User::all();
        $data = null;
        return view('stock.create',compact('categories','users','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = new Stock;
        $stock->stock_category_id = $request->input('category');
        $stock->qty = $request->input('qty');
        $stock->name = $request->input('name');
        $stock->save();
        return Redirect::route('stock.index')->with('success', 'New stock has been added');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $data = $stock;
        $users = User::all();
        $categories = StockCategory::all();

        return view('stock.create',compact('data','categories','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
