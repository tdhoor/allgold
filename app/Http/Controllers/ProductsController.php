<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')->paginate(10);

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $products
        ]);
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
            'productid' => 'required',
            'title' => 'required',
            'name' => 'required',
            'price' => 'required',
            'durability' => 'required'
        ]);

        $product = new Product();
        $product->productid = $request->input('productid');
        $product->title = $request->input('title');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->durability = $request->input('durability');
        $product->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => Product::find($id)
        ]);
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
            'productid' => 'required',
            'title' => 'required',
            'name' => 'required',
            'price' => 'required',
            'durability' => 'required'
        ]);

        $product = Product::find($id);
        $product->productid = $request->input('productid');
        $product->title = $request->input('title');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->durability = $request->input('durability');
        $product->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $product
        ]);
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
        
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $inventory
        ]);
    }
}
