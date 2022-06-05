<html>
<header>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                </header>
            <body>
    <div class="col-md-1">
            @foreach($paineis as $p)
                    <div class="col-md-6">
                        <div class="card" style="margin-bottom:3px;">
                            <div class="text-center" style="background-color:#E0E0E0;">
                                <h6 class="card-title">Identificação: {{$p->identificacao}}</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="text-center">
                                            <img src="{{ asset('storage/'.$p->image_url)}}" alt="" style="width:250px; height:160px;">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div>
                                            <p><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}}, <b>Bairro:</b>  {{$p->logradouro}} nº{{$p->numero}} </p>
                                            <p><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="card-text">{{$p->localizacao}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
    </div>
    <br>
</body>
</html>
