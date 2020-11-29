<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

use Converter;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::all();
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $inventories);
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

        $inventory = new Inventory();
        $inventory->fk_productId = $request->input('fk_productid');
        $inventory->fk_stationId = $request->input('fk_stationid');
        $inventory->currentAmount = $request->input('currentAmount');
        $inventory->targetAmount = $request->input('targetAmount');
        $inventory->save();

        return Converter::handleResponse('Successfully created!', 'Error by creating!', $inventory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $inventory);
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
            'fk_productid' => 'required',
            'fk_stationid' => 'required',
            'currentAmount' => 'required',
            'targetAmount' => 'required'
        ]);

        $inventory = Inventory::find($id);
        $inventory->fk_productId = $request->input('fk_productid');
        $inventory->fk_stationId = $request->input('fk_stationid');
        $inventory->currentAmount = $request->input('currentAmount');
        $inventory->targetAmount = $request->input('targetAmount');
        $inventory->save();

        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $inventory);
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

        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $inventory);
    }

    public static function getInventoryById($id){
        $inventory = Inventory::find($id);
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $inventory);
    }

    public static function getInventoryByStationId($id){
        //return DB::table('inventories')->rightJoin('products', 'inventories.fk_productID', '=', 'products.productID')->where('fk_stationID', '=', $id)->paginate(15);
        $inventory = DB::table('inventories')->rightJoin('products', 'inventories.fk_productID', '=', 'products.productID')->where('fk_stationID', '=', $id)->get();
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $inventory);
    }
}
