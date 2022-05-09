@extends('layouts.layout-2')

@section('content')

<div class="col-md-12 row">
    <div class="col-md-9">
        <h4 class="font-weight-bold py-3 mb-4">
            Lista de Regiões
        </h4>
    </div>

    <div class="col-md-3">
        <a href="{{url('enderecos/regiaoForm')}}" style="text-decoration: none"> 
            <button id="btn-add-edit"  class="btn btn-success float-right" >
                    <i class="fa fa-btn fa-plus"></i>
                    Novo Registro
            </button>
        </a>
    </div>
</div>

@foreach($regioes as $r)
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title">{{$r->nome}} - Cidade: {{$r->cidade->nome}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a role="button" href="{{url('enderecos/editRegiaoForm')}}/{{$r->id}}" type="button" class="btn btn-primary edit">Editar</a>
                        <button type="button" value="{{$r->id}}" class="btn btn-danger delete">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<br>

<div class="col-md-12">
{{$regioes->links()}}
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

            url =  "{{ route('deleta.regiao', ":id") }}"
            url = url.replace(':id', e.target.value)
            $.ajax({
                method: "POST",
                url: url,
                data:{},
                success: function(resposta){
                    if (resposta.success){
                        alert(JSON.stringify(resposta));
                        window.location.href = "{{url('enderecos/gridRegioes')}}";
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