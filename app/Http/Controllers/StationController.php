<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    private $action = 'management/station/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $station = Station::all();
        return view('station.tableManage')->with(['stations' => $station]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('station.form')->with([
            'method' => 'POST',
            'action' => $this->action
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name_th' => 'required|string|unique:stations,station_name_th',
            'name_en' => 'required|string|unique:stations,station_name_en',
            'descript' => 'required|string'      
        ]);   

        $station = new Station;
        $station->station_name_th = $request->input('name_th');
        $station->station_name_en = $request->input('name_en');
        $station->station_description = $request->input('descript');
        $station->save();
        return redirect($this->action);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $station = Station::find($id);
        if ($station) {
            return view('station.form')->with([
                'method' => 'PUT',
                'action' => $this->action . $id,
                'station' => $station
            ]);
        }
        return redirect($this->action);
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
        $station = Station::find($id);
        if ($station) {
            $validator = $request->validate([
                'name_th' => 'required|string|unique:stations,station_name_th,' . $id .',station_id',
                'name_en' => 'required|string|unique:stations,station_name_en,' . $id .',station_id',
                'descript' => 'required|string'
            ]);   
    
            $station->station_name_th = $request->input('name_th');
            $station->station_name_en = $request->input('name_en');
            $station->station_description = $request->input('descript');
            $station->save();
        }
        return redirect($this->action);
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
        if ($station) {
            $station->delete();
            return response()->json(['errors' => null]);
        }

        return response()->json(['errors' => 'The selected id is invalid.']);
    }
}
