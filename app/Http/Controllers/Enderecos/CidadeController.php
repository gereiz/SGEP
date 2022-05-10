<?php

namespace App\Http\Controllers\Enderecos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\UF;
use App\Models\Bairro;
use App\Models\Regiao;
use App\Models\User;
use DB;

class CidadeController extends Controller
{
    public function index() {

       $user = auth()->user()->name;
        $cidades = Cidade::paginate(7);
        return view('enderecos.cidades_grid', ['user' => $user,'cidades' => $cidades]);
    }

    public function dataForm() {
  
       $user = auth()->user()->name;
        $ufs = UF::all();
        
        return view('enderecos.cadastro_cidades', ['user' => $user, 'ufs' => $ufs]);

    }

    public function editDataForm($id) {

       $user = auth()->user()->name;
        $ufs = UF::all();
        $cidade = Cidade::find($id);
        
        return view('enderecos.cadastro_cidades', ['user' => $user, 'ufs' => $ufs, 'cidade' => $cidade]);

    }

    public function cadastraCidade(Request $request) {

        $dados = $request->all();

        $cidade  = new Cidade;
        if(Cidade::find($request->id))
        {
            $cidade = Cidade::find($request->id);
        }

        $cidade->nome = $request->nome_cidade;
        $cidade->uf_id = $request->estado_id;

        $cidade->save();

        if(Cidade::find($request->id))
            return redirect()->route('cad.cidades')->with('success', 'Cidade editada com sucesso!');

        return back()->with('success', 'Cidade cadastrada com sucesso!');

    }

    public function delete($id)
    {
        if(count(Regiao::where('cidade_id',$id)->get()) > 0)
        {
            return response()->json(['success' => false, 'message' => 'Cidade já está sendo usada em alguma região!']);
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
