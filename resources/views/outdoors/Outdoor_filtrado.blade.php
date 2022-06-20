@extends('layouts.application')

<html>
    <div>
        <div class="col-md-12 grid_paineis">
            @foreach($paineis as $p)
                <header>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                </header>
                <div class="col-md-6 card_painel">
                    <div class="card mt-6" style="width: 575; height:320; margin: 0% 2% 0% -2%;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Identificação: {{$p->identificacao}}</h5>
                                    <br>
                                    <p><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}},</p> 
                                    <p><b>Bairro:</b>  {{$p->bairro->nome}}</p> 
                                    <br>
                                    <p><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
                                </div>
                                <div class="col-md-6">
                                    <img class="rounded float-left grid_painel_img" src="{{ asset('storage/'.$p->image_url)}}" alt="" style="padding-right: 5%;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button role="button" type="button" class="btn btn-success" data-toggle="modal" data-target="#modals-slide{{$p->id}}">Reservar</button>
                                    <a role="button" href="{{url('Outdoors/viewFormOutdoor')}}/{{$p->id}}" type="button" class="btn btn-info">Visualizar</a>
                                    <a role="button" href="{{url('Outdoors/editFormOutdoor')}}/{{$p->id}}"  type="button" class="btn btn-warning">Editar</a>
                                    <a role="button" onclick=" return confirm('Tem certeza que deseja excluir este registro?')" href="{{url('Outdoors/deleteOutdoor')}}/{{$p->id}}" type="button" class="btn btn-danger">Excluir</a>
                                </div>
                            </div>
                            <div class="row">
                                <p class="card-text">{{$p->localizacao}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal template -->
                <div class="modal modal-slide fade" id="modals-slide{{$p->id}}">
                    <div class="modal-dialog">
                        <form class="modal-content" action="{{route('res.outdoor')}}" method="POST">
                            @csrf
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Outdoor</label>
                                        <input class="form-control" type="hidden" name="outdoor" id="outdoor" value="{{$p->id}}">
                                        <input class="form-control" type="text" name="outdoor" id="outdoor" value="Identificação: {{$p->identificacao}}" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Cliente</label>
                                        <select class="custom-select" id="cliente" name="cliente">
                                            <option>Selecione o Cliente</option>
                                            @foreach ($clientes as $cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nome_fantasia}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Bi-Semana</label>
                                        <select class="custom-select" id="bisemana" name="bisemana">
                                            <option>Selecione o Período da Reserva</option>
                                            @foreach ($bisemanas as $bisemana)
                                            <option value="{{$bisemana->id}}">{{date('d/m/Y', strtotime($bisemana->inicio))}} - {{date('d/m/Y', strtotime($bisemana->fim))}}</option>
                                            @endforeach
                
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Observações</label>
                                        <textarea class="form-control" placeholder="Observações" id="observacoes" name="observacoes"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Reservar</button>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
    <br>

    <div class="col-md-12">
        {{$paineis->links() }}

    </div>

</html>