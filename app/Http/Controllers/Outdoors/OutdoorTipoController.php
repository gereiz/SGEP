<?php

namespace App\Http\Controllers\Outdoors;

use App\Http\Controllers\Controller;
use App\Models\OutdoorTipo;
use Illuminate\Http\Request;
use DB;
use Exception;

class OutdoorTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->name;
        $outdoorTipo = OutdoorTipo::all();
        
        return view('outdoors.Outdoor_tipo', ['user' => $user, 'outdoorTipo' => $outdoorTipo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required'
        ]);

        $outdoorTipo = new OutdoorTipo();

        $outdoorTipo->tipo = $request->tipo;

        $outdoorTipo->save();
        
        return back()->with('success', 'Tipo de Painel cadastrado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try  
        {
            DB::beginTransaction();
            OutdoorTipo::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }
        DB::commit();
        return back()->with('success', 'Tipo de Outdoor excluído!');
    }
}
