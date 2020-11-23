<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = DB::table('inventories')->paginate(10);
        
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $inventories
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
            'fk_productid' => 'required',
            'fk_stationid' => 'required',
            'currentAmount' => 'required',
            'targetAmount' => 'required'
        ]);

        $inventory = new Inventroy();
        $inventory->fk_productID = $request->input('fk_productid');
        $inventory->fk_stationID = $request->input('fk_stationid');
        $inventory->currentAmount = $request->input('currentAmount');
        $inventory->targetAmount = $request->input('targetAmount');
        $inventory->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $inventory
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
            'fk_productID' => 'required',
            'fk_stationID' => 'required',
            'currentAmount' => 'required',
            'targetAmount' => 'required'
        ]);

        $inventory = Inventroy::find($id);
        $inventory->fk_productID = $request->input('fk_productID');
        $inventory->fk_stationID = $request->input('fk_stationID');
        $inventory->currentAmount = $request->input('currentAmount');
        $inventory->targetAmount = $request->input('targetAmount');
        $inventory->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $inventory
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
        $inventory = Inventory::find($id);
        $inventory->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $inventory
        ]);
    }

    public static function getInventoryById($id){
        return Inventory::find($id);
    }

    public static function getInventoryByStationId($id){
        return DB::table('inventories')->leftJoin('products', 'inventories.fk_productID', '=', 'products.productID')->where('fk_stationID', '=', $id)->paginate(15);
    }
}
