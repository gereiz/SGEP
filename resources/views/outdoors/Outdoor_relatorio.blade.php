<link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/bootstrap.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/relatorios.css')}}"> 


<style>

.relatorio {
    margin-left: -30px; 
    margin-bottom: 10px!important; 
    width: 735px;
    height: 250px;
}

.no-space{
        margin-top: 0px;
        margin-bottom:0px;
        padding-top:0px;
        padding-bottom:0px;
}

#tabletitulo {
    text-align: center;
    max-width: 750px!important;
    margin-bottom: 2%;
    margin-top: -3%;
    background-color: #e4e4e4;
    border: 1px solid;
}

.relatorio-body {
    display: flex;
}

.img-relatorio {
    position: relative;
    top: -105px;
    left: 63%; 
    width:250px; 
    height:180px;3
    border: 1px solid!important;
}

.endereco-relatorio{
max-width: 390px;

}

</style>

<div id="tabletitulo">
    <h4>Painéis Disponíveis</h4>
    <h5>Bi-Semana: {{$data}}</h5>   
</div>

<table style="page-break-after:always;">

    <?php
    $i = 1;
    foreach ($paineis as $p) {
    ?>
    {{-- <?php if ($i % 2 != 0) { ?>
        <tr>
        <?php } ?> --}}
    <tr>
        <td >
            <div class="col-md-12">
                <div class="card relatorio">
                    <div class="text-center" style="background-color:#E0E0E0;">
                        <h4 class="card-title">Identificação: {{$p->identificacao}}</h4>
                    </div>
                    <div class="card-body relatorio-body">
                        <div class="row d-flex">
                            <div class="col-md-12">
                                <div class="d-inline col-md-6">
                                    <div class="endereco-relatorio">
                                        <p><b>Localização:</b>  {{$p->logradouro}}, nº{{$p->numero}} - {{$p->bairro->nome}} / {{$p->bairro->regiao->cidade->nome}}</p>
                                        <p><b>Coordenadas:</b> <a href="https://maps.google.com/?q={{$p->latitude}},{{$p->longitude}}" target="_blank">Ver localização no mapa</a> </p>
                                    </div>
                                </div>
                                <div class="d-inline col-md-6">
                                    <div >
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
                                        <img class="img-relatorio" src="{{$reportImage}}" alt="">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        {{-- <div class="d-inline row">
                            <p class="d-inline card-text">{{$p->localizacao}}</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </td>
    </tr>
    {{-- <?php if ($i % 2 == 0) { ?>
    </tr>
    <?php } ?> --}}

    <?php if ($i == 6) { ?>
        <div class="d-inline pagebreak"> </div>
    <?php } ?>
    <?php $i++;
    } ?>

</table>

<div class="d-inline pagebreak"> </div>

<div class="d-inline col-md-12">
    <div>
        <p style="margin : 0; padding-top:0;"><b>Filtros Utilizados:</b></p>
        <p style="margin : 0; padding-top:0;"><b>Bisemana: <i>{{$data}}</i></b></p>
        <p style="margin : 0; padding-top:0;"><b>Status: <i>{{$status}}</i></b></p>
    </div>
</div>

