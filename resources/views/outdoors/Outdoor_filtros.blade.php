@extends('layouts.layout-2')

<link rel="stylesheet" href="{{asset('assets/css/paineis.css')}}"> 

@section('content')

<header>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</header>
<div class="card">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card-body" id="dados_empresa">
                <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-label">Bisemana</label>
                    <select name="bisemana_id" id="bisemana_id" class="form-control">
                        @foreach($bisemanas as $b)
                            <option value="{{$b->id}}"> {{date('d/m/Y', strtotime($b->inicio))}} até {{date('d/m/Y', strtotime($b->fim))}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">,
                        <option value="0">Todos</option>
                        <option value="1">Disponível</option> 
                        <option value="2">Reservado</option>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button name="filtrar" id="filtrar" class="btn btn-primary request" style="margin-top:25px; margin-bottom:18px;">Filtrar</button>
                </div>
                <div class="form-group col-md-1">
                    <button name="pdf" id="pdf" class="btn btn-primary" style="margin-top:25px; margin-bottom:18px;">Relatório</button> 
                </div>
                <div class="form-group col-md-1">
                    <button name="enviar" id="enviar" class="btn btn-primary request" style="margin-top:25px; margin-bottom:18px;">Enviar</button> 
                </div>
                <div id="outdoors"></div>
                <div>
            </div>
        </div>
    </div>
</div>
<br>

<script>
    $(document).ready(function () 
    {
        $('#filtrar').on('click',function(e)
        {
            tipo = e.target.id;
            bisemana = $('#bisemana_id').val();
            status = $('#status').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('view_outdoor_filter') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    bisemana: bisemana,
                    status: status,
                    tipo: tipo
                },
                success: function(resposta){
                    $('#outdoors').html(resposta);  
                }
            });

        });

        $('#pdf').on('click',function(e)
        {
            tipo = e.target.id;
            bisemana = $('#bisemana_id').val();
            status = $('#status').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url =  "{{ route('view_outdoor_filter') }}"

            $.ajax({
                method: "POST",
                url: url, 
                data:{
                    bisemana: bisemana,
                    status: status,
                    tipo: tipo
                },
                xhrFields: { 
                responseType: 'blob' 
                }, 
                success: function(resposta){
                    var blob = new Blob([resposta]); 
                    var link = document.createElement('a'); 
                    link.href = window.URL.createObjectURL(blob); 
                    link.download = "Outdoors.pdf"; 
                    link.click();
                },
                error: function(error){
                    alert('Não há dados para os filtros informados');
                }
            });

        });
                
    });
            

</script>
@endsection