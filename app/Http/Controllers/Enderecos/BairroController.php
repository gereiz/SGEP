<?php

namespace App\Http\Controllers\Enderecos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bairro;
use App\Models\Regiao;
use App\Models\User;

class BairroController extends Controller
{
    public function index() {

        $user = User::all();
        $regioes = Regiao::all();
        
        return view('enderecos.cadastro_bairros', ['user' => $user, 'regioes' => $regioes]);

    }

    public function cadastraBairro(Request $request) {

        $dados = $request->all();

        $regiao  = new Bairro;

        $regiao->nome = $request->nome_bairro;
        $regiao->regiao_id = $request->regiao_id;

        $regiao->save();

        return back()->with('success', 'Bairro cadastrado com sucesso!');


    }

}
