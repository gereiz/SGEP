<?php

namespace App\Http\Controllers\pessoas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\UF;
use App\Models\Cidade;
use App\Models\Bairro;

class ClienteController extends Controller
{
    public function index() {

        $user = auth()->user()->name;
        $uf = UF::all();
        $bairros = Bairro::all();
        $cidades = Cidade::all();

        return view('pessoas.cadastro_clientes', ['user' => $user,
                                                  'bairros' => $bairros,
                                                  'cidade' => $cidades,
                                                  'uf' => $uf
                                                 ]);

    }

    public function cadastraCliente(Request $request) {

       // $dados = $request->all();

        $cliente  = new Cliente;

        $cliente->razao_social = $request->razao;
        $cliente->nome_fantasia = $request->n_fantasia;
        $cliente->cpf_cnpj = $request->cpf_cnpj;
        $cliente->nro_insc = $request->nro_insc;
        $cliente->responsavel = $request->responsavel;
        $cliente->tel_responsavel = $request->tel_responsavel;
        $cliente->email_responsavel = $request->email_responsavel;
        $cliente->endereco = $request->endereco;
        $cliente->num = $request->numero;
        $cliente->bairro = $request->bairro_id;
        $cliente->cidade = $request->cidade_id;
        $cliente->uf = $request->uf;
        $cliente->cep = $request->cep;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->celular = $request->celular;
        $cliente->tipo = $request->tipo;
        $cliente->ativo = isset($request->ativo)? 1 : 0;

        $cliente->save();

        return back()->with('success', 'Cliente cadastrado com sucesso!');


    }

    public function listaClientes() {

        $user = auth()->user()->name;
        $clientes = Cliente::all();

        return view('pessoas.lista_clientes', ['user' => $user,
                                               'clientes' => $clientes  
    
                                              ]);

    }


    public function viewClientes($id)
    { 
        $user = auth()->user()->name;
        $bairros = Bairro::all();
        $cidade = Cidade::all();
        $cliente = Cliente::find($id);
        $uf = UF::all();

        //dd($cliente->ativo);
        return view('pessoas.view_clientes',[
            'cliente' => $cliente,
            'user' => $user,
            'bairros' => $bairros,
            'cidade' => $cidade,
            'uf' => $uf,

        ]);
    }

    public function editCliente($id)
    { 
        $user = auth()->user()->name;
        $bairros = Bairro::all();
        $cidade = Cidade::all();
        $cliente = Cliente::find($id);
        $uf = UF::all();

        //dd($cliente->num);
        return view('pessoas.edit_clientes',[
            'cliente' => $cliente,
            'user' => $user,
            'bairros' => $bairros,
            'cidade' => $cidade,
            'uf' => $uf,

        ]);
    }


}
