<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Station;
use Illuminate\Support\Facades\DB;

class StationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = DB::table('stations')->paginate(10);

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $stations
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
            'coordsA' => 'required',
            'coordsB' => 'required',
            'location' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $station = new Station();
        $station->coordsA = $request->input('coordsA');
        $station->coordsB = $request->input('coordsB');
        $station->location = $request->input('location');
        $station->type = $request->input('type');
        $station->description = $request->input('description');
        $station->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $station
        ]);
    }

    /**
     * Display the specified resources.
     *
     * @param  int  $value = primaryKey (stationID) || location
     * @return \Illuminate\Http\Response
     */
    public function show($value)
    {
        if(preg_match('/\\d/', $value)){
            $stations = Station::find($value);
            if($stations != null)
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'data' => $station
                ]);
        }

        $stations = Station::where('location', $value)->paginate(15);
        
        if(count($stations) > 0)
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => $station
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
            'coordsA' => 'required',
            'coordsB' => 'required',
            'location' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $station = Station::find();
        $station->coordsA = $request->input('coordsA');
        $station->coordsB = $request->input('coordsB');
        $station->location = $request->input('location');
        $station->type = $request->input('type');
        $station->description = $request->input('description');
        $station->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $station
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
        $station = Station::find($id);
        $station->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => $station
        ]);
    }
}
