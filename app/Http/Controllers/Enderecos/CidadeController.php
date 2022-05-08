<?php

namespace App\Http\Controllers\Enderecos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\UF;
use App\Models\Bairro;
use App\Models\User;
use DB;

class CidadeController extends Controller
{
    public function index() {

        $user = User::all();
        $cidades = Cidade::paginate(7);
        return view('enderecos.cidades_grid', ['user' => $user,'cidades' => $cidades]);
    }

    public function dataForm() {
  
        $user = User::all();
        $ufs = UF::all();
        
        return view('enderecos.cadastro_cidades', ['user' => $user, 'ufs' => $ufs]);

    }

    public function cadastraCidade(Request $request) {

        $dados = $request->all();

        $cliente  = new Cidade;

        $cliente->nome = $request->nome_cidade;
        $cliente->uf_id = $request->estado_id;

        $cliente->save();

        return back()->with('success', 'Cidade cadastrada com sucesso!');


    }

    public function delete($id)
    {
        if(Bairro::where('cidade_id',$id))
        {
            return response()->json(['success' => false, 'message' => 'Cidade já está sendo usada em algum bairro!']);
        }

        try 
        {
            DB::beginTransaction();
            Cidade::find($id)->delete();
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        DB::commit();
        return response()->json(['success' => true, 'message' => 'Registro Deletado com sucesso!']);

    }

}
