@extends('layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Cadastro de Tipo de Painel
    </h4>

    <!-- Dados do novo Tipo de Painel -->
    <div class="row">
        <div class="card col-md-4 mb-4 mr-4">
            <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
                <div class="card-header-title">Cadastrar Tipo de Painel</div>
            </h6>
            <div class="row no-gutters">
                <div class="col-md-12 col-lg-12 col-xl-12 p-3">
                    <div class="card-body" id="dados_empresa">
                        <form action="{{ route('tipo.outdoor.add') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Tipo de Painel</label>
                                    <input type="text" value="{{ old('tipo') }}" name="tipo" id="tipo" class="form-control" placeholder="Ex.: A">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <button type="submit" name="btn-cadastrar" id="btn-cadastrar" class="btn btn-primary float-right">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Dados do novo Tipo de Painel -->


        <!-- Lista de Tipos de Painel -->
        <div class="card col-md-7 mb-4" style="max-height: 300px;">
            <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
                <div class="card-header-title">Tipos de Painel Cadastrados</div>
            </h6>
            <div class="row no-gutters overflow-auto">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Tipo</th>
                            <th class="text-center" scope="col">Exluir</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($outdoorTipo as $tipo)
                            <tr>
                                <td class="text-center">{{$tipo->id}}</td>
                                <td class="text-center">{{$tipo->tipo}}</td>
                                <td class="text-center">
                                    <a href="{{route('tipo.outdoor.del', ['id' => $tipo->id])}}" onclick="return confirm('Tem certeza que deseja excluir este arquivo?')" title="Excluir" alt="Excluir">
                                        <i class="sidenav-icon ion ion-md-backspace" style="color: #DC3545; font-size: 30px;"></i>
                                    </a>
                                </td>
                            </tr>     
                            @endforeach
                                              
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        
    </div>    
    <!-- Lista de Tipos de Painel -->
    
@endsection

