<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use Illuminate\Support\Facades\DB;

use  Converter;

class StationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all();
        if(count($stations) === 0)
            $stations = null;
        return Converter::handleResponse('Successfully found!', 'No search result!', $stations);
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
            'coordsA' => 'required|numeric',
            'coordsB' => 'required|numeric',
            'location' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        $station = new Station();
        $station->coordsA = $request->input('coordsA');
        $station->coordsB = $request->input('coordsB');
        $station->location = $request->input('location');
        $station->type = $request->input('type');
        $station->description = $request->input('description');
        $station->save();

        return Converter::handleResponse('Successfully created!', 'Error by created!', $station);
    }

    /**
     * Display the specified resources.
     *
     * @param  int  $value = primaryKey (stationid) || location
     * @return \Illuminate\Http\Response
     */
    public function show($value)
    {
        // search by id
        if(preg_match('/\\d/', $value))
        {
            $stations = Station::find($value);
            return Converter::handleResponse('Successfully found!', 'No search result', $stations);
        }
        // search by location
        $stations = Station::where('location', $value)->get();
        if(count($stations) == 0)
        {
            return Converter::handleResponse('Successfully found!', 'No search result', null);
        }
        return Converter::handleResponse('Successfully found!', 'No search result', $stations);
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
            'coordsA' => 'required',
            'coordsB' => 'required',
            'location' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $station = Station::find($id);
        $station->coordsA = $request->input('coordsA');
        $station->coordsB = $request->input('coordsB');
        $station->location = $request->input('location');
        $station->type = $request->input('type');
        $station->description = $request->input('description');
        $station->save();

        return Converter::handleResponse('Successfully updated!', 'Error by updating!', $station);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $station = Station::find($id);
        $station->delete();

        return Converter::handleResponse('Successfully deleted!', 'Error by deleting!', $station);
    }
}
