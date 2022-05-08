@extends('layouts.layout-2')

@section('content')
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-strong">@if(isset($painel)) Editar Painel @else Cadastrar Novo Painel @endif</span> 
    </h4>

    <div class="card">
        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Identificação</label>
                <input type="text" class="form-control" id="identificacao">
            </div>

            <div class="card-body col-md-8">
                <label class="form-label">Localização</label>
                <input type="text" class="form-control" id="localizacao">
            </div>
        </div>

        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Posição</label>
                <input type="text" class="form-control" id="posicao">
            </div>

            <div class="card-body col-md-4">
                <label class="form-label">Dimensão</label>
                <input type="text" class="form-control" id="dimensao">
            </div>

            <div class="card-body col-md-4">
                <label class="form-label">Dimensão da Lona</label>
                <input type="text" class="form-control" id="dimensao_lona">
            </div>
        </div>

        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Ponto de Referência</label>
                <input type="text" class="form-control" id="referencia">
            </div>

            <div class="card-body col-md-4">
                <label class="form-label">Latitude</label>
                <input type="text" class="form-control" id="lat">
            </div>

            <div class="card-body col-md-4">
                <label class="form-label">Longitude</label>
                <input type="text" class="form-control" id="long">
            </div>
        </div>
        <div class="row">
            <div class="card-body col-md-4">
                <label class="form-label">Imagem</label>
                <input type="file" id="imageDialog" name="image" class="form-control">
            </div>

            <div class="card-body col-md-8">
                <button id="btn-add-edit"  class="btn btn-primary float-right" style="margin-top: 40px;">
                    <i class="fa fa-btn fa-envelope"></i>
                    Salvar
                </button>
            </div>
        </div>
    </div>


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
        
        $('#btn-add-edit').on('click', function(){
            identificacao = $('#identificacao').val();
            localizacao = $('#localizacao').val();
            posicao = $('#posicao').val();
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
            if(localizacao == '')
            {
                return alert('Informe a Localizção');
            }
            if(posicao == '')
            {
                return alert('Informe a Posição');
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
            {
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
                    localizacao:localizacao,
                    posicao:posicao,
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
                    window.location.href = "{{url('outdoorsGrid')}}";
                }else{
                    alert(JSON.stringify(resposta));
                }
            },
            error: function(error)
            {
                alert(JSON.stringify(error));
            }
            });
        });
        
        @if(isset($painel))
            $('#identificacao').val('{{$painel->identificacao}}');
            $('#localizacao').val('{{$painel->localizacao}}');
            $('#posicao').val('{{$painel->posicao}}');
            $('#dimensao').val('{{$painel->dimensao}}');
            $('#dimensao_lona').val('{{$painel->dimensao_lona}}');
            $('#referencia').val('{{$painel->ponto_referencia}}');
            $('#lat').val('{{$painel->latitude}}');
            $('#long').val('{{$painel->longitude}}');
        @endif
    });
    </script>
@endsection

