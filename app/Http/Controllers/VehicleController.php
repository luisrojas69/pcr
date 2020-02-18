<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function getVehicles()
    {
        return Vehicle::orderBy('id', 'DESC')->get();
    }

    public function index()
    {
        return View('pages.vehicle');
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

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);;
        return $vehicle;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'plate'     =>  'required|string|max:10|unique:vehicles',
            'mark'      =>  'required|string|min:2|max:20',
            'model'     =>  'required|string|min:2|max:20',
            'color'     =>  'required|string|min:2|max:15',
            'comment'   =>  'max:100',
        ]);

        Vehicle::create($request->all());
        return;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request,[
            'plate'     =>  'required|string|max:10',
            'mark'      =>  'required|string|min:2|max:20',
            'model'     =>  'required|string|min:2|max:20',
            'color'     =>  'required|string|min:2|max:15',
            'comment'   =>  'max:100',
        ]);

        Vehicle::findOrFail($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
    }
}
