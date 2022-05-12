<?php

namespace App\Http\Controllers\Reservas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bisemana;
use App\Models\Reserva;
use DB;

class BisemanaController extends Controller
{
    public function index() {

       $user = auth()->user()->name;
        $bisemanas = Bisemana::paginate(10);
        
        return view('reservas.nome_do_grid', ['user' => $user, 'bisemanas' => $bisemanas]);

    }

    public function dataForm() {
  
       $user = auth()->user()->name;
        
        return view('reservas.nome_do_form', ['user' => $user]);

    }
    

    public function cadastraBisemana(Request $request) {

        $dados = $request->all();

        $bisemana  = new Bisemana;
        if(Bisemana::find($request->id))
        {
            $bisemana = Bisemana::find($request->id);
        }

        $bisemana->inicio = $request->inicio;
        $bisemana->fim = $request->fim;

        $bisemana->save();

        if(Bairro::find($request->id))
            return redirect()->route('rota_da_grid')->with('success', 'Bisemana editada com sucesso!');

        return back()->with('success', 'Bisemana cadastrada com sucesso!');

    }

    public function delete($id)
    {
        if(count(Reserva::where('bisemana_id',$id)->get()) > 0)
        {
            return response()->json(['success' => false, 'message' => 'Bisemana já está sendo usado em alguma reserva!']);
        }

        try 
        {
            DB::beginTransaction();
            Bisemana::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        DB::commit();
        return response()->json(['success' => true, 'message' => 'Registro Deletado com sucesso!']);

    }

}
