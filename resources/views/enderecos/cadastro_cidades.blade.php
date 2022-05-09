@extends('layouts.layout-2')

@section('content')
    @if(isset($cidade))
        <h4 class="font-weight-bold py-3 mb-4"> 
            Edição de Cidade
        </h4>
    @else 
        <h4 class="font-weight-bold py-3 mb-4"> 
            Cadastro de Cidade
        </h4>
    @endif

    <!-- Dados da Empresa -->
    <div class="card mb-4">
        <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
            <div class="card-header-title">Dados da Cidade</div>
        </h6>
        <div class="row no-gutters">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card-body" id="dados_empresa">
                    <form action="{{route('cadastra.cidade')}}" method="POST">
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
                                <input type="text" name="nome_cidade" id="nome_cidade" class="form-control" placeholder="Nome da Cidade" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Estado</label>
                                <select name="estado_id" id="estado_id" class="form-control">
                                    @foreach($ufs as $uf)
                                        <option value="{{$uf->id}}"> {{$uf->nome}} </option>
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

        @if(isset($cidade))
            $('#id').val('{{$cidade->id}}')
            $('#nome_cidade').val('{{$cidade->nome}}')
            $('#estado_id').val('{{$cidade->uf_id}}')
        @endif
});
</script>

@endsection

