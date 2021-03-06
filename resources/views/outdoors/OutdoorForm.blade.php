@extends('layouts.layout-2')

@section('content')
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-strong">@if(isset($painel)) Editar Painel @else Cadastrar Novo Painel @endif</span> 
    </h4>
    <form action="{{route('insert_outdoor')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row">
                <div class="card-body col-md-1"> 
                    <label class="form-label">Cod.</label>
                    <input type="text" class="form-control" id="id" name="id" readonly>
                </div>
                
                <div class="card-body col-md-2">
                    <label class="form-label">Identificação</label>
                    <input type="text" value="{{ old('identificacao') }}" class="form-control" id="identificacao" name="identificacao">
                </div>

                <div class="card-body col-md-4">
                    <label class="form-label">Bairro</label> 
                    <select name="bairro_id" id="bairro_id" class="form-control">
                        <option value="">Selecione o Bairro</option>
                        @foreach($bairros as $b)
                            <option value="{{$b->id}}"> {{$b->nome}} - {{$b->regiao->cidade->nome}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="card-body col-md-3">
                    <label class="form-label">Logradouro</label>
                    <input type="text" value="{{ old('logradouro') }}" class="form-control" id="logradouro" name="logradouro">
                </div>

                <div class="card-body col-md-2">
                    <label class="form-label">Número</label>
                    <input type="text" value="{{ old('numero') }}" class="form-control" id="numero" name="numero"> 
                </div>
            </div>

            <div class="row">
                <div class="card-body col-md-2">
                    <label class="form-label">CADAN</label>
                    <input type="text" value="{{ old('cadan') }}" class="form-control" id="cadan" name="cadan">
                </div>

                <div class="card-body col-md-2">
                    <label class="form-label">Posição</label>
                    <input type="text" value="{{ old('posicao') }}" class="form-control" id="posicao" name="posicao">
                </div>

                <div class="card-body col-md-4">
                    <label class="form-label">Dimensão</label>
                    <input type="text" value="{{ old('dimensao') }}" class="form-control" id="dimensao" name="dimensao">
                </div>

                <div class="card-body col-md-4">
                    <label class="form-label">Dimensão da Lona</label>
                    <input type="text" value="{{ old('dimensao_lona') }}" class="form-control" id="dimensao_lona" name="dimensao_lona">
                </div>
            </div>

            <div class="row">
                <div class="card-body col-md-4">
                    <label class="form-label">Ponto de Referência</label>
                    <input type="text" value="{{ old('referencia') }}" class="form-control" id="referencia" name="referencia">
                </div>

                <div class="card-body col-md-4">
                    <label class="form-label">Latitude</label>
                    <input type="text" value="{{ old('lat') }}" class="form-control" id="lat" name="lat">
                </div>

                <div class="card-body col-md-4">
                    <label class="form-label">Longitude</label>
                    <input type="text" value="{{ old('long') }}" class="form-control" id="long" name="long">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ isset($painel) ? asset('storage/'.$painel->image_url) : '' }}" alt="" style="width:50%;">
                </div>
                <div class="card-body col-md-5">
                    <label class="form-label">Imagem</label>
                    <input type="file" id="imageDialog" name="image" class="form-control" {{isset($painel) ? '' : 'required'}}>
                </div>
                <div class="card-body col-md-2 mt-1">
                    <label class="form-label">Tipo de Painel</label>
                    <select class="custom-select" id="tipoPainel" name="tipoPainel">
                        <option value="0" disabled selected>Selecione o Tipo</option>
                        @foreach ($painelTipo as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row"> 
                <div class="card-body col-md-7">
                    <button id="btn-add-edit"  type="submit" class="btn btn-primary" style="margin: 5% 0% -1% 1% ">
                        <i class="fa fa-btn fa-envelope"></i>
                        Salvar
                    </button>
                </div>  
            </div>
            
        </div>
    </form>

    <script>
    $(document).ready(function () 
    {
        let base64String = "";
  
        function imageUploaded() {
            var file = document.querySelector(
                'input[type=file]')['files'][0];
        
            var reader = new FileReader();
            console.log("next");
            
            reader.onload = function () {
                base64String = reader.result.replace("data:", "")
                    .replace(/^.+,/, "");
        
                imageBase64Stringsep = base64String;
        
                // alert(imageBase64Stringsep);
                console.log(base64String);
            }
            reader.readAsDataURL(file);
        }

        $('#imageDialog').on('change', function() {
            imageUploaded();
        })
        
        /*$('#btn-add-edit').on('click', function(){
            identificacao = $('#identificacao').val();
            bairro_id = $('#bairro_id').val();
            logradouro = $('#logradouro').val();
            numero = $('#numero').val();
            posicao = $('#posicao').val();
            cadan = $('#cadan').val();
            dimensao = $('#dimensao').val();
            dimensao_lona = $('#dimensao_lona').val();
            ponto_referencia = $('#referencia').val();
            latitude = $('#lat').val();
            longitude = $('#long').val();
            files = $('#imageDialog')[0].files;
            url = "{{route('insert_outdoor')}}";    
            if(identificacao == 0) 
            {
                return alert('Informe a Identificação');
            }
            if(logradouro == '')
            {
                return alert('Informe o Logradouro');
            }
            if(bairro_id == '')
            {
                return alert('Informe o Bairro');
            }
            if(numero == '')
            {
                return alert('Informe o Número');
            }
            if(posicao == '')
            {
                return alert('Informe a Posição');
            }
            if(cadan == '')
            {
                return alert('Informe o Nº do CADAN');
            }
            if(dimensao == '')
            {
                return alert('Informe a Dimensão');
            }
            if(dimensao_lona == '')
            {
                return alert('Informe a Dimensão da Lona');
            }
            if(ponto_referencia == '')
            {
                return alert('Informe o Ponto de Referência');
            }
            if(latitude == '')
            {
                return alert('Informe a Latitude');
            }
            if(longitude == '')
            {
                return alert('Informe a Longitude');
            }
            if(base64String == '')
            /*{
                return alert('Selecione uma Imagem');
            }
            @if(isset($painel))
            {
                id = '{{$painel->id}}'
            }
            @else
            {
                id = 0;
            }
            @endif
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: url,
                data:{
                    id:id,
                    identificacao:identificacao,
                    bairro_id:bairro_id,
                    logradouro:logradouro,
                    numero:numero,
                    posicao:posicao,
                    cadan:cadan,
                    dimensao: dimensao,
                    dimensao_lona: dimensao_lona,
                    ponto_referencia: ponto_referencia,
                    latitude: latitude,
                    longitude: longitude,
                    image: base64String,
                },
            success: function(resposta){
                if (resposta.success){
                    alert(resposta.message, true);
                    window.location.href = "{{url('Outdoors/outdoorsGrid')}}";
                }else{
                    alert(JSON.stringify(resposta));
                }
            },
            error: function(error)
            {
                alert(JSON.stringify(error));
            }
            });
        });*/
        
        @if(isset($painel))
            $('#id').val('{{$painel->id}}');
            $('#identificacao').val('{{$painel->identificacao}}');
            $('#bairro_id').val('{{$painel->bairro_id}}');
            $('#logradouro').val('{{$painel->logradouro}}');
            $('#numero').val('{{$painel->numero}}');
            $('#cadan').val('{{$painel->cadan}}');
            $('#posicao').val('{{$painel->posicao}}');
            $('#cadan').val('{{$painel->cadan}}');
            $('#dimensao').val('{{$painel->dimensao}}');
            $('#dimensao_lona').val('{{$painel->dimensao_lona}}');
            $('#referencia').val('{{$painel->ponto_referencia}}');
            $('#lat').val('{{$painel->latitude}}');
            $('#long').val('{{$painel->longitude}}');
            $('#tipoPainel').val('{{$painel->tipo}}');
        @endif
    });
    </script>
@endsection

