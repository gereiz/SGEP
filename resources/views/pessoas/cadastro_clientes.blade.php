@extends('layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Cadastro de Clientes
    </h4>


    <!-- Dados da Empresa -->
    <div class="card mb-4">
        <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
            <div class="card-header-title">Dados da empresa</div>
        </h6>
        <div class="row no-gutters">
            <div class="col-md-12 col-lg-12 col-xl-12 p-3">
                <div class="card-body" id="dados_empresa">
                    <form action="{{route('cadastra.cliente')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Razão Social</label>
                                <input type="text" value="{{ old('razao') }}" name="razao" id="razao" class="form-control" placeholder="Razão Social" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Nome Fantasia</label>
                                <input type="text" value="{{ old('n_fantasia') }}" name="n_fantasia" id="n_fantasia" class="form-control" placeholder="Nome Fantasia">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">CNPJ / CPF</label>
                                <input type="text" value="{{ old('cpf_cnpj') }}" name="cpf_cnpj" id="cpf_cnpj" class="form-control" placeholder="CNPJ / CPF" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Inscrição Estadual</label>
                                <input type="text" value="{{ old('nro_insc') }}" name="nro_insc" id="nro_insc" class="form-control" placeholder="Nº da Inscrição Estadual">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Contato/Responsável</label>
                                <input type="text" value="{{ old('responsavel') }}" name="responsavel" id="responsavel" class="form-control" placeholder="Nome do Contato">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">Celular do Responsável</label>
                                <input type="text" value="{{ old('tel_responsavel') }}" name="tel_responsavel" id="tel_responsavel" class="form-control cel" placeholder="(XX) XXXX-XXXX">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">E-mail do Responsável</label>
                                <input type="email" value="{{ old('email_responsavel') }}" name="email_responsavel" id="email_responsavel" class="form-control">
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Endereço</label>
                                <input type="text" value="{{ old('endereco') }}" name="endereco" id="endereco" class="form-control" placeholder="Rua ABCD... ">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">Número</label>
                                <input type="text" value="{{ old('numero') }}" name="numero" id="numero" class="form-control" placeholder="0000">
                            </div>
                        </div>    

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Bairro</label> 
                                <select name="bairro_id" id="bairro_id" class="form-control">
                                    <option value="">Selecione o Bairro</option>
                                    @foreach($bairros as $b)
                                        <option value="{{$b->id}}"> {{$b->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Cidade</label>
                                <select name="cidade_id" id="cidade_id" class="form-control">
                                    <option value="">Selecione a Cidade</option>
                                    @foreach($cidade as $c)
                                        <option value="{{$c->id}}"> {{$c->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="form-row px-4">
                            <div class="form-group col-md-2">
                                <label class="form-label">UF</label>
                                <select class="custom-select" name="uf" id="uf">
                                    <option value="">Selecione o Estado</option>
                                    @foreach($uf as $u)
                                        <option value="{{$u->id}}"> {{$u->nome}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">CEP</label>
                                <input type="text" value="{{ old('cep') }}" name="cep" id="cep" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">E-mail</label>
                                <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-row px-4">
                            <div class="form-group col-md-2">
                                <label class="form-label">Telefone</label>
                                <input type="text" value="{{ old('telefone') }}" name="telefone" id="telefone" class="form-control"placeholder="(XX) XXXX-XXXX">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">Celular / Whatsapp</label>
                                <input type="text" value="{{ old('celular') }}" name="celular" id="celular" class="form-control cel" placeholder="(XX) 9XXXX-XXXX">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label">Tipo</label>
                                <select class="custom-select" name="tipo" id="tipo">
                                    <option value="0">Selecione</option>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 ml-4 mt-4">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" name="ativo" id="ativo" class="custom-control-input">
                                    <span class="custom-control-label">Ativo</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" name="btn-cadastrar" id="btn-cadastrar" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Dados da Empresa -->


<script>
$(document).ready(function() {
    $('#telefone').mask('(00) 0000-0000');
    $('.cel').mask('(00) 00000-0000');
    $('#cep').mask('00000-000');

    $("#cpf_cnpj").keydown(function(){
        try {
            $("#cpf_cnpj").unmask();
        } catch (e) {}

        var tamanho = $("#cpf_cnpj").val().length;

        if(tamanho < 11){
            $("#cpf_cnpj").mask("999.999.999-99");
        } else {
            $("#cpf_cnpj").mask("99.999.999/9999-99");
        }

        // ajustando foco
        var elem = this;
        setTimeout(function(){
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });

});
</script>

@endsection

