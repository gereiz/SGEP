<table style="overflow: hidden; width:50%">
            @foreach($paineis as $p){
            <tr>
              <td style="padding:5px;">
              <div class="card" style="margin-bottom:3px;">
                            <div class="text-center" style="background-color:#E0E0E0;">
                                <h6 class="card-title">Identificação: {{$p->identificacao}}</h6>
                            </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="text-center">
                                            <img src="{{ asset('storage/'.$p->image_url)}}" alt="" style="width:50%; height:128px;">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div>
                                            <p><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}}
                                            <p><b>Bairro:</b>  {{$p->logradouro}} nº{{$p->numero}} </p>
                                            <p><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="card-text">{{$p->localizacao}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
              </td>
            </tr>
            @endforeach
        </table> 
