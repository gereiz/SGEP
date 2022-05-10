@extends('layouts.layout-2')

@section('content')

@foreach($paineis as $p)
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </header>
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title">{{$p->identificacao}}</h5>
                    
                </div>
                <div class="row">
                    <img src="{{ asset('storage/'.$p->image_url)}}" alt="" style="width:15%;">
                    <div class="col-md-12 text-right">
                        <a role="button" href="{{url('Outdoors/viewFormOutdoor')}}/{{$p->id}}" type="button" class="btn btn-secondary edit">Visualizar</a>
                        <a role="button" href="{{url('Outdoors/editFormOutdoor')}}/{{$p->id}}" type="button" class="btn btn-primary edit">Editar</a>
                        <button type="button" value="{{$p->id}}" class="btn btn-danger delete">Excluir</button>
                    </div>
                </div>
                <div class="row">
                    <p class="card-text">{{$p->localizacao}}</p>
                    
 
                </div>
            </div>
        </div>
    </div>
@endforeach
<br>

<div class="col-md-12">
{{$paineis->links()}}
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