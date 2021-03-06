@extends('layouts.layout-2')

<link rel="stylesheet" href="{{asset('assets/css/paineis.css')}}">  

@section('content') 
<header>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</header>

<div class="col-md-12 grid_paineis"> 
@foreach($paineis as $p)
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
                    <div class="col-md-6">
                        <img class="rounded float-left grid_painel_img" src="{{ asset('storage/'.$p->image_url)}}" alt="">
                    </div>
                </div>
                <div class="row">
                    <form action="{{route('reserva.outdoor')}}">
                        <input type="hidden" name="outId" value="{{$p->id}}">

                        <div class="col-md-12 text-right">
                            <button  type="submit" class="btn btn-success">Reservar</button>
                        </div>
                  </form>
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


<script>
    $(document).ready(function () 
    {
        $('.delete').on('click',function(e)
        {
            if (confirm("Deseja Mesmo Excluir o Registro?") == true) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('delete_outdoor', ":id") }}"
            url = url.replace(':id', e.target.value)

            $.ajax({
                method: "POST",
                url: url, 
                data:{},
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

            }
                
        });
            
    });

</script>
@endsection