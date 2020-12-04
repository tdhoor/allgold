<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RefillCar;
use Illuminate\Support\Facades\DB;

use Converter;


class RefillCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refillcars = RefillCar::all();
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $refillcars);
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
            'fk_refillId' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $refillcar = new RefillCar();
        $refillcar->fk_productId = $request->input('fk_productId');
        $refillcar->fk_refillId = $request->input('fk_refillId');
        $refillcar->amount = $request->input('amount');
        $refillcar->save();

        return Converter::handleResponse('Successfully created!', 'Error by creating!', $refillcar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $refillcar = refillcar::find($id);
        return Converter::handleResponse('Successfully found!', 'Error by finding!', $refillcar);
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
            'fk_refillId' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $refillcar = RefillCar::find($id);
        $refillcar->fk_productId = $request->input('fk_productId');
        $refillcar->fk_refillId = $request->input('fk_refillId');
        $refillcar->amount = $request->input('amount');
        $refillcar->save();
        
        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $refillcar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $refillcar = RefillCar::find($id);
        $refillcar->delete();

        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $refillcar);
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
