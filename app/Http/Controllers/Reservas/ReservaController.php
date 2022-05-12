<?php

namespace App\Http\Controllers\Reservas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use DB;

class ReservaController extends Controller
{
    public function index() {

       $user = auth()->user()->name;
        $reservas = Reserva::paginate(10);
        
        return view('reservas.nome_do_grid', ['user' => $user, 'reservas' => $reservas]);

    }

    public function dataForm() {
  
       $user = auth()->user()->name;
        
        return view('reservas.nome_do_form', ['user' => $user]);

    }
    

    public function cadastraReserva(Request $request) {

        $dados = $request->all();

        $reserva  = new Reserva;
        if(Reserva::find($request->id))
        {
            $reserva = Reserva::find($request->id);
        }

        $reserva->cliente_id = $request->cliente_id;
        $reserva->outdoor_id = $request->outdoor_id;
        $reserva->bisemana_id = $request->bisemana_id;
        $reserva->observacao = $request->observacao;

        $reserva->save();

        if(Bairro::find($request->id))
            return redirect()->route('rota_da_grid')->with('success', 'Reserva editada com sucesso!');

        return back()->with('success', 'Reserva cadastrada com sucesso!');

    }

    public function delete($id)
    {
        try 
        {
            DB::beginTransaction();
            Reserva::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        DB::commit();
        return response()->json(['success' => true, 'message' => 'Registro Deletado com sucesso!']);

    }

}