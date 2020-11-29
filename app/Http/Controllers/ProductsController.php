<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Converter;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'price' => 'required',
            'durability' => 'required'
        ]);

        $product = new Product();
        $product->title = $request->input('title');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->durability = $request->input('durability');
        $product->save();

        return Converter::handleResponse('Successfully created!', 'Error by creating!', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'price' => 'required',
            'durability' => 'required'
        ]);

        $product = Product::find($id);
        $product->title = $request->input('title');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->durability = $request->input('durability');
        $product->save();

        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $product);
    }
}
