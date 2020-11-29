<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ShoppingCar;
use Illuminate\Support\Facades\DB;

use Converter;

class ShoppingCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppingcars = ShoppingCar::all();
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $shoppingcars);
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
            'fk_productId' => 'required|integer',
            'fk_saleId' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $shoppingcar = new ShoppingCar();
        $shoppingcar->fk_productId = $request->input('fk_productId');
        $shoppingcar->fk_saleId = $request->input('fk_saleId');
        $shoppingcar->amount = $request->input('amount');
        $shoppingcar->save();

        return Converter::handleResponse('Successfully created!', 'Error by creating!', $shoppingcar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shoppingcar = ShoppingCar::find($id);
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $shoppingcar);
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
            'fk_productId' => 'required|integer',
            'fk_saleId' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $shoppingcar = ShoppingCar::find($id);
        $shoppingcar->fk_productId = $request->input('fk_productId');
        $shoppingcar->fk_saleId = $request->input('fk_saleId');
        $shoppingcar->amount = $request->input('amount');
        $shoppingcar->save();
        
        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $shoppingcar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shoppingcar = ShoppingCar::find($id);
        $shoppingcar->delete();

        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $shoppingcar);
    }

    private function handleResponse($message, $errorMessage, $data){
        $isValid = false;

        if($data == null)
        {
            $isValid = false;
        }
        else if(is_object($data))
        {
            $isValid = $data != null;
        }
        else if(is_array($data))
        {
            $isValid = count($data) != 0;
        }

        return response()->json([
            'status'    => $isValid    ?   Response::HTTP_OK   : 404 ,
            'message'   => $isValid    ?   $message            : $errorMessage,
            'data'      => $data
        ]);

    }
}
