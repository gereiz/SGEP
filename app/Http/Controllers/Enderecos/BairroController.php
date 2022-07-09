<?php

namespace App\Http\Controllers\Enderecos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bairro;
use App\Models\Regiao;
use App\Models\User;
use App\Models\Outdoor;
use DB;

class BairroController extends Controller
{
    public function index() {

       $user = auth()->user()->name;
        $bairros = Bairro::orderBy('nome')->paginate(8);
        
        return view('enderecos.bairros_grid', ['user' => $user, 'bairros' => $bairros]);

    }

    public function dataForm() {
  
       $user = auth()->user()->name;
        $regioes = Regiao::all();
        
        return view('enderecos.cadastro_bairros', ['user' => $user, 'regioes' => $regioes]);

    }

    public function editDataForm($id) {

       $user = auth()->user()->name;
        $regioes = Regiao::all();
        $bairro = Bairro::find($id);
        
        return view('enderecos.cadastro_bairros', ['user' => $user, 'regioes' => $regioes, 'bairro' => $bairro]);

    }
    

    public function cadastraBairro(Request $request) {

        $dados = $request->all();

        $bairro  = new Bairro;
        if(Bairro::find($request->id))
        {
            $bairro = Bairro::find($request->id);
        }

        $bairro->nome = $request->nome_bairro;
        $bairro->regiao_id = $request->regiao_id;

        $bairro->save();

        if(Bairro::find($request->id))
            return redirect()->route('cad.bairros')->with('success', 'Bairro editado com sucesso!');

        return back()->with('success', 'Bairro cadastrado com sucesso!');

    }

    public function delete($id)
    {
        /*if(count(Outdoor::where('bairro_id',$id)->get()) > 0)
        {
            return response()->json(['success' => false, 'message' => 'Bairro já está sendo usado em algum painel!']);
        }*/

        try 
        {
            DB::beginTransaction();
            Bairro::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        DB::commit();
        return response()->json(['success' => true, 'message' => 'Registro Deletado com sucesso!']);

    }

}
