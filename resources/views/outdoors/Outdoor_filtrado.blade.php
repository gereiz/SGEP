<html>
<div class="col-md-12 grid_paineis">
    @foreach($paineis as $p)
        <header>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
        </header>
        <div class="col-md-6 card_painel">
            <div class="card mt-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Identificação: {{$p->identificacao}}</h5>
                            <br>
                            <p><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}}, <b>Bairro:</b>  {{$p->logradouro}} nº{{$p->numero}} </p>
                            <p><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}} </p>
                            <br>
                            <p><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
                        </div>
                        <div class="col-md-6 d-flex flex-row-reverse">
                            <img class="rounded float-left grid_painel_img" src="{{ asset('storage/'.$p->image_url)}}" alt="" style="width:30%; height:20%;">
                        </div>
                    </div>
                    <div class="row">
                        <p class="card-text">{{$p->localizacao}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<br>

<div class="col-md-12">
    {{$paineis->links() }}

</div>

</html>