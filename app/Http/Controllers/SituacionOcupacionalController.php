<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SituacionOcupacional;

class SituacionOcupacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $situacionesocupacionales = SituacionOcupacional::orderBy('idsituacionesOcupacionales','desc')->where('estado',1)->paginate(5);

        return view('situacionocupacional.index', ['situacionesocupacionales'=>$situacionesocupacionales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('situacionocupacional.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $situacionocupacional = new SituacionOcupacional;
        $situacionocupacional->nombre = $request->get('nombre');
        $situacionocupacional->estado = 1;
        $situacionocupacional->save();

        return redirect()->route('situacionocupacional.index');
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
        $situacionocupacional = SituacionOcupacional::findOrFail($id);

        return view('situacionocupacional.edit',['situacionocupacional'=>$situacionocupacional]);
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
        $situacionocupacional = SituacionOcupacional::findOrFail($id);
        $situacionocupacional->nombre = $request->get('nombre');
        $situacionocupacional->update();

        return redirect()->route('situacionocupacional.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $situacionocupacional = SituacionOcupacional::findOrFail($id);
        $situacionocupacional->estado=0;
        $situacionocupacional->update();

        return redirect()->route('situacionocupacional.index');
    }
}
