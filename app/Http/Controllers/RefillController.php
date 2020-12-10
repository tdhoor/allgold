<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Refill;
use Illuminate\Support\Facades\DB;

use Converter;


class RefillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $refills = Refill::all();
        return Converter::handleResponse('Successfully found!', 'No search result!', $refills);
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
            'fk_stationId' => 'required|integer',
            'fk_productId' => 'required|integer',
            'amount' => 'required',
            'status' => 'required'
        ]);

        $refill = new Refill();
        $refill->fk_stationId = $request->input('fk_stationId');
        $refill->fk_productId = $request->input('fk_productId');
        $refill->amount = $request->input('amount');
        $refill->status = $request->input('status');
        $refill->save();
             
        return Converter::handleResponse('Successfully created!', 'Error by created!', $refill);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $refill = Refill::find($id);
        return Converter::handleResponse('Successfully found!', 'No search result', $refill);
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
            'fk_productId' => 'required|integer',
            'amount' => 'required',
            'status' => 'required'
        ]);

        $refill = Refill::find($id);
        $refill->fk_stationId = $request->input('fk_stationId');
        $refill->fk_productId = $request->input('fk_productId');
        $refill->amount = $request->input('amount');
        $refill->status = $request->input('status');
        $refill->save();
             
        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $refill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $refill = Refill::find($id);
        $refill->delete();

        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $refill);
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
