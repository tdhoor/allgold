<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

use Converter;

class SaleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales = Sale::all();
        return Converter::handleResponse('Successfully found!', 'No search result!', $sales);
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
            'stationId' => 'required|integer',
            'totalPrice' => 'required',
        ]);

        $sale = new Sale();
        $sale->fk_stationId = $request->input('stationId');
        $sale->totalPrice = $request->input('totalPrice');
        $sale->save();
             
        return Converter::handleResponse('Successfully created!', 'Error by created!', $sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        return Converter::handleResponse('Successfully found!', 'No search result', $sale);
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
            'fk_stationId' => 'required|integer',
            'totalPrice' => 'required',
        ]);

        $sale = Sale::find($id);
        $sale->fk_stationId = $request->input('fk_stationId');
        $sale->totalPrice = $request->input('totalPrice');
        $sale->save();
             
        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();

        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $sale);
    }

    public function getNewPrimaryKey(){
        $id = DB::table('sales')->max('saleId') | 1;

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => [
                'sale' => [
                    'saleid' => $id,
                    'stationId' => 1,
                    'price' => 99.99
                ]
                ],
                
        ]);
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
