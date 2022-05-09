@extends('layouts.layout-2')

@section('content')
    @if(isset($regiao))
        <h4 class="font-weight-bold py-3 mb-4"> 
            Edição de Região
        </h4>
    @else 
        <h4 class="font-weight-bold py-3 mb-4"> 
            Cadastro de Região
        </h4>
    @endif

    <!-- Dados da Empresa -->
    <div class="card mb-4">
        <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
            <div class="card-header-title">Dados da Região</div>
        </h6>
        <div class="row no-gutters">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card-body" id="dados_empresa">
                    <form action="{{route('cadastra.regiao')}}" method="POST">
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
                                <input type="text" name="nome_regiao" id="nome_regiao" class="form-control" placeholder="Nome da Região" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Cidade</label>
                                <select name="cidade_id" id="cidade_id" class="form-control">
                                    @foreach($cidades as $cidade)
                                        <option value="{{$cidade->id}}"> {{$cidade->nome}} - {{$cidade->uf->sigla}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="btn-cadastrar" id="btn-cadastrar" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Dados da Empresa -->


<script>
    $(document).ready(function() {

    @if(isset($regiao))
        $('#id').val('{{$regiao->id}}')
        $('#nome_regiao').val('{{$regiao->nome}}')
        $('#cidade_id').val('{{$regiao->cidade_id}}')
    @endif
  
});
</script>

@endsection

