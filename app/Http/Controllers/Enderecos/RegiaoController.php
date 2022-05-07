<?php

namespace App\Http\Controllers\Enderecos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Regiao;
use App\Models\User;

class RegiaoController extends Controller
{
    public function index() {

        $user = User::all();
        $cidades = Cidade::all();
        
        return view('enderecos.cadastro_regioes', ['user' => $user, 'cidades' => $cidades]);

    }

    public function cadastraRegiao(Request $request) {

        $dados = $request->all();

        $regiao  = new Regiao;

        $regiao->nome = $request->nome_regiao;
        $regiao->cidade_id = $request->cidade_id;

        $regiao->save();

        return back()->with('success', 'Região cadastrada com sucesso!');


    }

}
