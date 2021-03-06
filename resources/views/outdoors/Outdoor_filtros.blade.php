@extends('layouts.layout-2')

<link rel="stylesheet" href="{{asset('assets/css/paineis.css')}}"> 

@section('content')

<header>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</header>
<div class="card">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card-body" id="dados_empresa">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label">Bisemana</label>
                        <select name="bisemana_id" id="bisemana_id" class="form-control opt">
                            @foreach($bisemanas as $b)
                                <option value="{{$b->id}}"> {{date('d/m/Y', strtotime($b->inicio))}} até {{date('d/m/Y', strtotime($b->fim))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-control opt">,
                            <option value="0">Todos</option>
                            <option value="1">Disponível</option> 
                            <option value="2">Reservado</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label">Cidade</label>
                        <select class="js-example-basic-multiple form-control opt" name="cidades[]" multiple="multiple" id="cidades">
                            @foreach($cidades as $c)
                                <option value="{{$c->id}}"> {{$c->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label class="form-label">Identificação</label>
                        <select class="js-example-basic-multiple form-control opt" name="ids[]" multiple="multiple" id="ids">
                            @foreach($paineisFiltro as $pf)
                                <option value="{{$pf->id}}"> {{$pf->identificacao}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <a href="/Outdoors/OutdoorsDisponiveisFilter?status=3&bisemana=1" style="margin-top:20px; margin-bottom:18px" class="btn btn-primary request" id="btn_filter">Filtrar</a>
                        <!--<button name="filtrar" id="filtrar" class="btn btn-primary request" style="margin-top:25px; margin-bottom:18px;">Filtrar</button>-->
                    </div>

                    <div class="form-group col-md-2">
                        <button class="btn btn-primary dropdown-toggle" style="margin-left: -45%; margin-top:20px; margin-bottom:18px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Enviar Lista
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a name="pdf" id="pdf" class="dropdown-item">Download do Relatório</a>
                            <a name="enviar" id="enviar" class="dropdown-item">Enviar por Email</a> 
                            <a name="wpp" id="wpp" class="dropdown-item">Enviar por Whatsapp</a> 
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group col-md-1">
                    <button name="pdf" id="pdf" class="btn btn-primary" style="margin-top:25px; margin-bottom:18px;">Relatório</button> 
                </div>
                <div class="form-group col-md-1">
                    <button name="enviar" id="enviar" class="btn btn-primary request" style="margin-top:25px; margin-bottom:18px;">Enviar</button> 
                </div>
                <div class="form-group col-md-1">
                    <button name="wpp" id="wpp" class="btn btn-primary request" style="margin-top:25px; margin-bottom:18px;">Whatsapp</button> 
                </div> --}}
                <div class="col-md-12 grid_paineis" id="outdoors" style="margin-left: -0.6%">
                @isset($paineis)
                    @foreach($paineis as $p) 
                        <header>
                        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                        </header>
                        <div class="col-md-6 card_painel">
                            <div class="card mt-6" style="max-width: 575; max-height:320;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Identificação: {{$p->identificacao}}</h5>
                                            <br>
                                            <p><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}},</p> 
                                            <p><b>Bairro:</b>  {{$p->bairro->nome}}</p> 
                                            <p><b>ID:</b>  {{$p->id}}</p> 
                                            <br>
                                            <p><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
                                        </div>
                                        <div class="col-md-6">
                                            <img class="rounded float-left grid_painel_img mb-3 pr-4" src="{{ asset('storage/'.$p->image_url)}}" alt="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                        @if($reservado == 1)
                                            <button role="button" type="button" class="btn btn-success" data-toggle="modal" data-target="#modals-reserva{{$p->id}}">Reservar</button>
                                            @elseif ($reservado == 2)
                                            <button role="button" type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#modals-canc_reserva{{$p->id}}">Canc. Reserva</button>
                                        @endif
                                            <a role="button" href="{{url('Outdoors/viewFormOutdoor')}}/{{$p->id}}" type="button" class="btn btn-info">Visualizar</a>
                                            @if (session('nivel_acesso') == 9)
                                            <a role="button" href="{{url('Outdoors/editFormOutdoor')}}/{{$p->id}}"  type="button" class="btn btn-warning">Editar</a>
                                            @endif
                                            <a role="button" onclick=" return confirm('Tem certeza que deseja excluir este registro?')" href="{{url('Outdoors/deleteOutdoor')}}/{{$p->id}}" type="button" class="btn btn-danger">Excluir</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="card-text">{{$p->localizacao}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Reserva -->
                        <div class="modal modal-slide fade" id="modals-reserva{{$p->id}}">
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
                                                    <option value="0" disabled selected>Selecione o Cliente</option>
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
                                                    <option value="0" disabled selected>Selecione o Período da Reserva</option>
                                                    @foreach ($bisemanas as $bisemana)
                                                    <option value="{{$bisemana->id}}">{{date('d/m/Y', strtotime($bisemana->inicio))}} - {{date('d/m/Y', strtotime($bisemana->fim))}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                                <label class="form-label" for="invalidCheck" style="margin-top: 3px;">
                                                    Já Existe uma P.I para esta reserva
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="form-group col-md-12">
                                                <label class="form-label">Observações</label>
                                                <textarea class="form-control" placeholder="Observações" id="observacoes" name="observacoes"></textarea>
                                            </div>
                                        </div>
                                        <button id="modReservar" type="submit" class="btn btn-success btn-block">Reservar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Cancela Reserva -->
                        <div class="modal fade show" id="modals-canc_reserva{{$p->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">×</button>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h1>Tem certeza que deseja excluir esse agendamento?</h1>
                                            </div>   
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                @foreach ($reserva as $r)
                                                    
                                                @endforeach
                                                <a href="{{route('cancel.reserva', ['id' => $r->id])}}" class="btn btn-danger text-white btn-block">Cancelar Reserva</a>   
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" aria-label="Close">Sair</button>
                                            </div>    
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12">
                        {{$paineis->links() }}
                    </div>

                @endisset
                </div>
                <div>
            </div>
        </div>
    </div>
</div>
<br> 

<script>
    $(document).ready(function () 
    {
        $('.js-example-basic-multiple').select2();

        @if(isset($reservado))
            $("#status").val('{{$reservado}}');
        @endif

        @if(isset($bisemana_id))
            $("#bisemana_id").val('{{$bisemana_id}}');
        @endif

        @if(isset($ids))
            idsArray = '{{$ids}}'.split(",");
            $("#ids").val(idsArray);
            $("#ids").select2();
        @endif

        @if(isset($id_cidades))
            cidadesArray = '{{$id_cidades}}'.split(",");
            $("#cidades").val(cidadesArray);
            $("#cidades").select2();
        @endif

        cidades = $("#cidades").val().length > 0 ? "&id_cidades=" + $("#cidades").val() : "&id_cidades=0"
        ids = $("#ids").val().length > 0 ? "&ids=" + $("#ids").val() : "&ids=0"
        btn_url = "/Outdoors/OutdoorsDisponiveisFilter?status=" + $("#status").val() + "&bisemana=" + $("#bisemana_id").val() + cidades + ids;
        $("#btn_filter").attr("href", btn_url);

        $(".opt").on("change", function(){
            cidades = $("#cidades").val().length > 0 ? "&id_cidades=" + $("#cidades").val() : "&id_cidades=0"
            ids = $("#ids").val().length > 0 ? "&ids=" + $("#ids").val() : "&ids=0"
            newUrl = "/Outdoors/OutdoorsDisponiveisFilter?status=" + $("#status").val() + "&bisemana=" + $("#bisemana_id").val() + cidades + ids;
            $("#btn_filter").attr("href", newUrl);
        })

        $('#cidades').on('change',function(e)
        {
            cidade_ids = $("#cidades").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('get_identificacoes') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    cidade_ids: cidade_ids,
                },
                success: function(resposta){
                    var $ids = $('#ids');
                    $ids.empty();
                    $ids.select2('destroy');
                    for (var i = 0; i < resposta.length; i++) {
                        $ids.append(new Option(resposta[i].identificacao, resposta[i].id, false, false));
                    }

                    $ids.select2();
                }
            });

        });

        $('#enviar').on('click',function(e)
        {
            tipo = e.target.id;
            bisemana = $('#bisemana_id').val();
            status = $('#status').val();
            out_ids = $("#ids").val();
            cidade_ids = $("#cidades").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('view_outdoor_filter') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    bisemana: bisemana,
                    status: status,
                    tipo: tipo,
                    cidade_ids: cidade_ids,
                    out_ids: out_ids,
                },
                success: function(resposta){
                    //$('#outdoors').html(resposta);  
                }
            });

        });

        $('#wpp').on('click',function(e)
        {
            tipo = e.target.id;
            bisemana = $('#bisemana_id').val();
            status = $('#status').val();
            out_ids = $("#ids").val();
            cidade_ids = $("#cidades").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('view_outdoor_filter') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    bisemana: bisemana,
                    status: status,
                    tipo: tipo,
                    cidade_ids: cidade_ids,
                    out_ids: out_ids,
                },
                success: function(resposta){
                    url = resposta.message
                    console.log(url); 
                }
            });

        });

        $('#pdf').on('click',function(e)
        {
            tipo = e.target.id;
            bisemana = $('#bisemana_id').val();
            status = $('#status').val();
            out_ids = $("#ids").val();
            cidade_ids = $("#cidades").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('view_outdoor_filter') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    bisemana: bisemana,
                    status: status,
                    tipo: tipo,
                    cidade_ids: cidade_ids,
                    out_ids: out_ids,
                },
                xhrFields: { 
                responseType: 'blob' 
                }, 
                success: function(resposta){
                    var blob = new Blob([resposta]); 
                    var link = document.createElement('a'); 
                    link.href = window.URL.createObjectURL(blob); 
                    link.download = "Outdoors.pdf"; 
                    link.click();
                },
                error: function(error){
                    alert('Não há dados para os filtros informados');
                }
            });

        });
                
    });
            

</script>
@endsection