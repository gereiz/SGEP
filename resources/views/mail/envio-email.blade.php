@extends('layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4"> 
        Teste de Envio de Email
    </h4>

    <!-- Dados da Empresa -->
    <div class="card mb-4">
        <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
            <div class="card-header-title">Dados do Email</div>
        </h6>
        <div class="row no-gutters">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card-body" id="dados_empresa">
                    <form action="{{route('email')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Nome do Cliente</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome..." required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">Email do Cliente</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email..." required>
                            </div>
                        </div>

                        <button type="submit" name="btn-cadastrar" id="btn-cadastrar" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Dados da Empresa -->


<script>
    $(document).ready(function() {
  
});
</script>

@endsection

