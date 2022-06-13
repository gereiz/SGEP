@extends('layouts.layout-2')

@section('content')
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-strong">Visualizar Paniel</span> 
    </h4>

    <div class="card">

        <div class="card-body col-md-12" style="text-align: center">
            <img id="imageShow" src="{{asset('storage/'.$painel->image_url)}}" alt="imagem do painel" title="imagem do painel" style="max-width:450px;">
        </div>
        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Identificação</label> 
                <input type="text" class="form-control" id="identificacao" disabled>
            </div>

            <div class="card-body col-md-8">
                <label class="form-label">Localização</label>
                <input type="text" class="form-control" id="localizacao" disabled>
            </div>
        </div>

        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Posição</label>
                <input type="text" class="form-control" id="posicao" disabled>
            </div>

            <div class="card-body col-md-4">
                <label class="form-label">Dimensão</label>
                <input type="text" class="form-control" id="dimensao" disabled>
            </div>

            <div class="card-body col-md-4">
                <label class="form-label">Dimensão da Lona</label>
                <input type="text" class="form-control" id="dimensao_lona" disabled>
            </div>
        </div>

        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Ponto de Referência</label>
                <input type="text" class="form-control" id="referencia" disabled>
            </div>

            <div class="card-body col-md-8" style="margin-top:30px;">
                <a href="" id="mapsLink" target="_blank">Ver localização no mapa</a>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function () 
    {
        
        @if(isset($painel))
            $('#identificacao').val('{{$painel->identificacao}}');
            $('#localizacao').val('{{$painel->logradouro}}'+' - '+'{{$painel->numero}}');
            $('#posicao').val('{{$painel->posicao}}');
            $('#dimensao').val('{{$painel->dimensao}}');
            $('#dimensao_lona').val('{{$painel->dimensao_lona}}');
            $('#cadan').val('{{$painel->cadan}}');
            $('#referencia').val('{{$painel->ponto_referencia}}');
            $("#mapsLink").attr("href", "https://maps.google.com/?q=" + '{{$painel->latitude}}' + ',' + '{{$painel->longitude}}');
           // $("#imageShow").attr("src", "/storage/{{$painel->image_url}}");
        @endif
    });
    </script>
@endsection

