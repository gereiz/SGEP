<link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/bootstrap.css')}}"> 
<table class="text-center" style="page-break-after:always;">

<thead>
    <h2 class="text-center">Mídias Exteriores Disponíveis</h2>
</thead>
<?php
$i = 1;
foreach ($paineis as $p) {
?>
    <?php if ($i % 2 != 0) { ?>
        <tr>
        <?php } ?>
        <td style="max-width:350px; max-height:200px;">
            <div class="col-md-12" style="max-width:350px">
                <div class="card" style="margin: 0px 0px 2px 40px  ;">
                    <div class="text-center" style="background-color:#E0E0E0;">
                        <h4 class="card-title">Identificação: {{$p->identificacao}}</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="text-center">
                                    <?php 
                                    $filePath = 'storage/'.$p->image_url;
                                    $originalImage = asset($filePath);
                                    //if(pathinfo('storage/'.$p->image_url, PATHINFO_EXTENSION) != "png" || mime_content_type($filePath) != "image/png"){
                                    if(filesize($filePath) > 50000){
                                        $info = getimagesize($filePath);

                                        if ($info['mime'] == 'image/jpeg') 
                                            $image = @imagecreatefromjpeg($filePath);
                                    
                                        elseif ($info['mime'] == 'image/gif') 
                                            $image = @imagecreatefromgif($filePath);
                                    
                                        elseif ($info['mime'] == 'image/png') 
                                            $image = @imagecreatefrompng($filePath);
                                    
                                        imagejpeg($image, 'storage/outdoorImages/'.$p->id."/CompressedJpgImage.jpg", 5);
                                        $reportImage = asset('storage/outdoorImages/'.$p->id."/CompressedJpgImage.jpg");
                                    }
                                    //}
                                    /*else if(!file_exists(public_path('storage/outdoorImages/'.$p->id."/jpgImage.jpg"))){
                                        $image = @imagecreatefrompng($filePath);
                                        $newImage = imagejpeg($image, 'storage/outdoorImages/'.$p->id."/jpgImage.jpg", 70);
                                        $reportImage = asset('storage/outdoorImages/'.$p->id."/jpgImage.jpg");
                                    }
                                    else{
                                        $reportImage = asset('storage/outdoorImages/'.$p->id."/jpgImage.jpg");
                                    }*/
                                    ?>
                                    <img src="{{$reportImage}}" alt="" style="width:230px; height:130px;">
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <div>
                                    <p class="no-space"><b>Endereço:</b>  {{$p->logradouro}} nº{{$p->numero}}</p>
                                    <p class="no-space"><b>Bairro:</b>  {{$p->bairro->nome}} - {{$p->bairro->regiao->cidade->nome}} </p>
                                    <p class="no-space"><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
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
        {{--<p>{{$i}}</p>--}}

    <?php if ($i % 2 == 0) { ?>
    </tr>
    <?php } ?>

    <?php if ($i == 6) { ?>
        <div class="pagebreak"> </div>
    <?php } ?>
<?php $i++;
} ?>

</table>

<div class="pagebreak"> </div>

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

    .no-space{
        margin-top: 0px;
        margin-bottom:0px;
        padding-top:0px;
        padding-bottom:0px;
    }
</style>        