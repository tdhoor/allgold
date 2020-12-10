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
        if(count($inventories) === 0)
            $inventories = null;
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
            'fk_productId' => 'required',
            'fk_stationId' => 'required',
            'currentAmount' => 'required',
            'targetAmount' => 'required'
        ]);

        $inventory = new Inventory();
        $inventory->fk_productId = $request->input('fk_productId');
        $inventory->fk_stationId = $request->input('fk_stationId');
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
            'fk_productId' => 'required',
            'fk_stationId' => 'required',
            'currentAmount' => 'required',
            'targetAmount' => 'required'
        ]);

        $inventory = Inventory::find($id);
        $inventory->fk_productId = $request->input('fk_productId');
        $inventory->fk_stationId = $request->input('fk_stationId');
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
        $inventory = DB::table('inventories')->leftJoin('products', 'inventories.fk_productId', '=', 'products.productId')->where('fk_stationId', '=', $id)->get();
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $inventory);
    }

    public static function getRefill(){


        $inventories = Inventory::whereRaw('currentAmount < targetAmount')
            ->join('stations', 'stations.stationId', '=', 'inventories.fk_stationId')
            ->join('products', 'products.productId', '=', 'inventories.fk_productId')
            ->orderBy('fk_stationId', 'asc')
            ->get();

        return Converter::handleResponse('Successfully found!', 'Error by finding!', $inventories);
    }
}
