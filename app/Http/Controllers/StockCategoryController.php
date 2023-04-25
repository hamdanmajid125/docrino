<?php

namespace App\Http\Controllers;

use App\StockCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StockCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StockCategory::paginate(10);
        return view('stockcat.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;
        return view('stockcat.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockCategory  $stockCategory
     * @return \Illuminate\Http\Response
     */
    public function show(StockCategory $stockCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockCategory  $stockCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(StockCategory $stockCategory)
    {
        $data = $stockCategory;
        return view('stockcat.create',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockCategory  $stockCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockCategory $stockCategory)
    {
        $stockCategory->update($request->all());

        return Redirect::to(route('stock-category.index'))->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockCategory  $stockCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockCategory $stockCategory)
    {
        //
    }
}
