<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales = DB::table('sales')->paginate(10);

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $sales
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
            'stationid' => 'required|integer',
            'totalprice' => 'required',
        ]);

        $sale = new Sale();
        $sale->fk_stationID = $request->input('stationid');
        $sale->totalPrice = $request->input('totalprice');
        $sale->save();
             
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $sale
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
        $this->validate($request, [
            'stationid' => 'required'
        ]);

        $stationID = $request->input('stationid');

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => Inventroy::find($id)
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
            'stationid' => 'required|integer',
            'totalprice' => 'required',
        ]);

        $sale = Sale::find($id);
        $sale->fk_stationID = $request->input('stationid');
        $sale->totalPrice = $request->input('totalprice');
        $sale->save();
             
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $sale
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
        $sale = Sale::find($id);
        $sale->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $sale
        ]);
    }

    public function getNewPrimaryKey(){
        $id = DB::table('sales')->max('saleID') | 1;

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => [
                'sale' => [
                    'saleid' => $id,
                    'stationid' => 1,
                    'price' => 99.99
                ]
                ],
                
        ]);
    }
}
