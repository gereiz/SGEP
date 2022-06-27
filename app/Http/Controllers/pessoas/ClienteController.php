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

       //$dados = $request->all();

        $request->validate([
        'razao' => 'min:5|max:40',
        'cpf_cnpj' => 'min:11|max:15',
        'responsavel' => 'min:5|max:40',
        'tel_responsavel' => 'min:10|max:12',
        'endereco' => 'min:5|max:40',
        'numero' => 'min:2|max:10',
        'bairro_id' => 'required',
        'cidade_id' => 'required',
        'uf' => 'required',
        'cep' => 'min:5|max:10',
        'celular' => 'min:10|max:12',
        'tipo' => 'required'
        ]);

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
        $clientes = Cliente::where('ativo', 1)->get();

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
        $uf = UF::all();
        $cliente = Cliente::find($id);


       //dd($cliente->num);
        return view('pessoas.edit_clientes',[
            'cliente' => $cliente,
            'user' => $user,
            'bairros' => $bairros,
            'cidade' => $cidade,
            'uf' => $uf,

        ]);
    }

    public function editAction(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $cliente->razao_social = $request->razao;

        $cliente->save();

        return redirect('pessoas.lista_clientes')->with('success', 'Cliente editado com sucesso!');

    }


    public function delete($id) 
    {
        $cliente = Cliente::find($id);

        $cliente->ativo = 0;  

        $cliente->save();

        return response()->json(['success' => true, 'message' => 'Registro Deletado com Sucesso!']);


    }


}
