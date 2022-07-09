@extends('layouts.layout-2')

@section('content')

<div class="col-md-12 row">
    <div class="col-md-9">
        <h4 class="font-weight-bold py-3 mb-4">
            Lista de Cidades 
        </h4>
    </div>

    <div class="col-md-3">
        <a href="{{url('enderecos/cidadeForm')}}" style="text-decoration: none"> 
            <button id="btn-add-edit"  class="btn btn-success float-right" >
                    <i class="fa fa-btn fa-plus"></i>
                    Novo Registro
            </button>
        </a>
    </div>
</div>


    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <div class="col-md-12" style="display: flex;flex-wrap: wrap;">
        @foreach($cidades as $c)
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title">{{$c->nome}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a role="button" href="{{url('enderecos/editCidadeForm')}}/{{$c->id}}" type="button" class="btn btn-primary edit">Editar</a>
                            <button type="button" value="{{$c->id}}" class="btn btn-danger delete">Excluir</button>
                        </div>
                    </div>
                    <div class="row"> 
                        <p class="card-text">{{$c->uf->sigla}}</p>
                    </div>
                </div>
            </div>   
        </div>
        
        @endforeach
    </div>

<br>

<div class="col-md-12">
{{$cidades->links()}}
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

            url =  "{{ route('deleta.cidade', ":id") }}"
            url = url.replace(':id', e.target.value)
            $.ajax({
                method: "POST",
                url: url,
                data:{},
                success: function(resposta){
                    if (resposta.success){
                        alert(JSON.stringify(resposta));
                        window.location.href = "{{url('enderecos/gridCidades')}}";
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