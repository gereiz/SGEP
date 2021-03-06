@extends('layouts.layout-2')

@section('content')
 

    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <div class="col-md-12" style="display: flex;flex-wrap: wrap;">
        @foreach($clientes as $cli) 
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title">{{$cli->nome_fantasia}}</h4>                
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a role="button" href="{{url('pessoas/viewCliente/')}}/{{$cli->id}}" type="button" class="btn btn-secondary edit">Visualizar</a>
                            <a role="button" href="{{url('pessoas/editCliente/')}}/{{$cli->id}}" type="button" class="btn btn-primary edit">Editar</a>
                            <button type="button" value="{{$cli->id}}" class="btn btn-danger delete">Excluir</button>
                        </div>
                    </div>
                    <div class="row">
                    <h6>Razão Social: {{$cli->razao_social}}</h6> 
                    </div>
                </div>
            </div>   
        </div>
        @endforeach    
    </div>
<br>

<div class="col-md-12">

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

            url =  "{{ route('delete_cliente', ":id") }}"
            url = url.replace(':id', e.target.value)

            $.ajax({
                method: "POST",
                url: url, 
                data:{},
                success: function(resposta){
                    if (resposta.success){
                        alert(resposta.message, true);
                        window.location.href = "{{url('pessoas/listaClientes')}}";
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