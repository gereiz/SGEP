@extends('layouts.layout-2')

@section('content')
    @if(isset($bairro))
        <h4 class="font-weight-bold py-3 mb-4"> 
            Edição de Bairro
        </h4>
    @else 
        <h4 class="font-weight-bold py-3 mb-4"> 
            Cadastro de Bairro
        </h4>
    @endif


    <!-- Dados da Empresa -->
    <div class="card mb-4">
        <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
            <div class="card-header-title">Dados do Bairro</div>
        </h6>
        <div class="row no-gutters">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card-body" id="dados_empresa">
                    <form action="{{route('cadastra.bairro')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label class="form-label">ID</label>
                                <input type="text" name="id" id="id" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome_bairro" id="nome_bairro" class="form-control" placeholder="Nome do Bairro" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Região</label>
                                <select name="regiao_id" id="" class="form-control">
                                    @foreach($regioes as $regiao)
                                        <option value="{{$regiao->id}}"> {{$regiao->nome}} - {{$regiao->cidade->nome}} - {{$regiao->cidade->uf->sigla}} </option>
                                    @endforeach
                                </select>
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

        @if(isset($bairro))
            $('#id').val('{{$bairro->id}}')
            $('#nome_bairro').val('{{$bairro->nome}}')
            $('#regiao_id').val('{{$bairro->regiao_id}}')
        @endif
});
</script>

@endsection

