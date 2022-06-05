<table class="text-center" style="page-break-after:always;">
<?php
$i = 0;
foreach ($paineis as $p) {
?>
    <?php if ($i / 2 == 0) { ?>
        <tr>
        <?php } ?>
        <td style="padding:5px; width:350px;">
            <div class="col-md-12">
                        <div class="card" style="margin-bottom:3px;">
                            <div class="text-center" style="background-color:#E0E0E0;">
                                <h6 class="card-title">Identificação: {{$p->identificacao}}</h6>
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="text-center">
                                            <img src="{{ asset('storage/'.$p->image_url)}}" alt="" style="width:200px; height:128px;">
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
                    </div>
        </td>
        <p>{{$i}}</p>
        <?php if ($i / 2 != 0) { ?>
        </tr>
        </br>
    <?php } ?>
<?php $i++;
} ?>
</table>

<div class="col-md-12">
            <div>
                <p style="margin : 0; padding-top:0;"><b>Filtros Utilizados:</b></p>
                <p style="margin : 0; padding-top:0;"><b>Bisemana: <i>{{$data}}</i></b></p>
                <p style="margin : 0; padding-top:0;"><b>Status: <i>{{$status}}</i></b></p>
            </div>
        </div>

<style>
    td {
        text-align: center;
    }
</style>        