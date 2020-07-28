<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departaments;
use App\Workers;

class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $departamentId = $request->workerId;
      $departaments = Departaments::get();
        if ($departamentId != '') {
          foreach ($departaments as $departament) {
            $workers = Workers::where('departaments_id', $departamentId)->get();
          }
          return $workers;
        } else {
          return $departaments;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departament = new Departaments ([
            'departament_name' => $request->name
        ]);

        $departament->save();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $departaments = Departaments::find($id);
        $departaments->departament_name = $request->name;
        $departaments->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departaments::find($id)->delete();
        Workers::where('departaments_id', $id)->delete();
    }
}
