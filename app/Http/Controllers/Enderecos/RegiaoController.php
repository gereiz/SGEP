<?php

namespace App\Http\Controllers\Enderecos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Regiao;
use App\Models\User;
use App\Models\Bairro;
use DB;

class RegiaoController extends Controller
{
    public function index() {

        $user = User::all();
        $regioes = Regiao::paginate(7);
        
        return view('enderecos.regioes_grid', ['user' => $user, 'regioes' => $regioes]);

    }

    public function dataForm() {
  
        $user = User::all();
        $cidades = Cidade::all();
        
        return view('enderecos.cadastro_regioes', ['user' => $user, 'cidades' => $cidades]);

    }

    public function editDataForm($id) {

        $user = User::all();
        $cidades = Cidade::all();
        $regiao = Regiao::find($id);
        
        return view('enderecos.cadastro_regioes', ['user' => $user, 'cidades' => $cidades, 'regiao' => $regiao]);

    }

    public function cadastraRegiao(Request $request) {

        $dados = $request->all();

        $regiao  = new Regiao;
        if(Regiao::find($request->id))
        {
            $regiao = Regiao::find($request->id);
        }

        $regiao->nome = $request->nome_regiao;
        $regiao->cidade_id = $request->cidade_id;

        $regiao->save();

        if(Regiao::find($request->id))
            return redirect()->route('cad.regioes')->with('success', 'Região editada com sucesso!');

        return back()->with('success', 'Região cadastrada com sucesso!');

    }

    public function delete($id)
    {
        if(count(Bairro::where('regiao_id',$id)->get()) > 0)
        {
            return response()->json(['success' => false, 'message' => 'Região já está sendo usada em algum bairro!']);
        }

        try 
        {
            DB::beginTransaction();
            Regiao::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        DB::commit();
        return response()->json(['success' => true, 'message' => 'Registro Deletado com sucesso!']);

    }

}
