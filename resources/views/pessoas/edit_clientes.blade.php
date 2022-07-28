@extends('layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Editar Cliente
    </h4>

    <!-- Dados da Empresa -->
    <div class="card mb-4">
        <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
            <div class="card-header-title">Dados da empresa</div>
        </h6>
        <div class="row no-gutters">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card-body" id="dados_empresa">
                    <form action="{{route('editar_cliente', ['id' =>$cliente->id])}}" method="POST"> 
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Razão Social</label>
                                <input type="text" name="razao" id="razao" class="form-control" placeholder="Razão Social" value="{{$cliente->razao_social}}"  >
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Nome Fantasia</label>
                                <input type="text" name="n_fantasia" id="n_fantasia" class="form-control" placeholder="Nome Fantasia" value="{{$cliente->nome_fantasia}}"  >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">CNPJ / CPF</label>
                                <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control" placeholder="CNPJ / CPF" value="{{$cliente->cpf_cnpj}}"  >
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Inscrição Estadual</label>
                                <input type="text" name="nro_insc" id="nro_insc" class="form-control" placeholder="Nº da Inscrição Estadual" value="{{$cliente->nro_insc}}"  >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Contato/Responsável</label>
                                <input type="text" name="responsavel" id="responsavel" class="form-control" placeholder="Nome do Contato" value="{{$cliente->responsavel}}"  >
                            </div>
                            <div class="form-group col-2">
                                <label class="form-label">Telefone do Responsável</label>
                                <input type="text" name="tel_responsavel" id="tel_responsavel" class="form-control" placeholder="(XX) XXXX-XXXX" value="{{$cliente->tel_responsavel}}"  >
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">E-mail do Responsável</label>
                                <input type="text" name="email_responsavel" id="email_responsavel" class="form-control" value="{{$cliente->email_responsavel}}"  >
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Rua ABCD... " value="{{$cliente->endereco}}"  >
                            </div>
                            <div class="form-group col-2">
                                <label class="form-label">Número</label>
                                <input type="text" name="numero" id="numero" class="form-control" placeholder="0000" value="{{$cliente->num}}"  >
                            </div>
                        </div>    

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Bairro</label> 
                                <select name="bairro_id" id="bairro_id" class="form-control" value="{{$cliente->bairro_id}}"  >
                                    @foreach($bairros as $b)
                                        <option value="{{$b->id}}"> {{$b->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4"> 
                                <label class="form-label">Cidade</label>
                                <select name="cidade_id" id="cidade_id" class="form-control" value="{{$cliente->cidade_id}}"  >
                                    @foreach($cidade as $c)
                                        <option value="{{$c->id}}"> {{$c->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label class="form-label">UF</label>
                                <select class="custom-select" name="uf" id="uf"  >
                                    <option value="">Selecione o Estado</option>
                                    @foreach($uf as $u)
                                        <option value="{{$u->id}}"> {{$u->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control" value="{{$cliente->cep}}"  >
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">E-mail</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{$cliente->email}}"  >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control"placeholder="(XX) XXXX-XXXX" value="{{$cliente->telefone}}"  >
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">Celular / Whatsapp</label>
                                <input type="text" name="celular" id="celular" class="form-control" placeholder="(XX) 9XXXX-XXXX" value="{{$cliente->celular}}"  >
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">Tipo</label>
                                <select class="custom-select" name="tipo" id="tipo" >
                                    <option value="0">Selecione</option>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                </select>
                            </div>
                            <div class="form-group col-4" style="margin: 2% 0% 0% 5%;">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" name="ativo" id="ativo" class="custom-control-input" {{ ($cliente->ativo == 1) ? "checked" : "" }} >
                                    <span class="custom-control-label">Ativo</span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="btn-atualizar" id="btn-atualizar" class="btn btn-primary">Atualizar</a>
                    </form>
                    <br>
                </div>
            </div>
        </div> 
    </div>
    <!-- / Dados da Empresa -->
<script>
    $(document).ready(function() {
        @if (isset($cliente))
            $('#uf').val('{{$cliente->uf}}');
            $('#cidade_id').val('{{$cliente->cidade}}');
            $('#bairro_id').val('{{$cliente->bairro}}');
            $('#tipo').val('{{$cliente->tipo}}');
        @endif
  
    });
</script>

@endsection

