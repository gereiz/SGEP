@extends('layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Cadastro de Novo Usuário
    </h4>

    <!-- Dados do novo Usuário -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <!-- Espaço Vazio -->
        </div>
        <div class="card col-md-4 mb-4">
            <h6 class="card-header with-elements collapsed" data-toggle="collapse" href="#dados_empresa" aria-expanded="true" aria-controls="dados_empresa">
                <div class="card-header-title">Dados do usuário</div>
            </h6>
            <div class="row no-gutters">
                <div class="col-md-12 col-lg-12 col-xl-12 p-3">
                    <div class="card-body" id="dados_empresa">
                        <form action="{{ route('cadastro.usuario.action') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Nome</label>
                                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="Nome do usuário" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control" placeholder="Email do usuário" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Senha</label>
                                    <input type="password" value="{{ old('password') }}" name="password" id="password" class="form-control" placeholder="Senha" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Digite a Senha Novamente</label>
                                    <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmação de senha" required>
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
    </div>    
    <!-- / Dados do novo Usuário -->
    
@endsection

